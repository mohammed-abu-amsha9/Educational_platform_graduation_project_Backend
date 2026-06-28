<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory, SoftDeletes;
    protected $appends = [
        'total_required_fees',
        'total_paid_amount',
        'remaining_fees',
        'financial_status'
    ];

    // علاقة الطالب مع جدول الحضور
    public function attendances()
    {
        return $this->hasMany(AttendanceLog::class, 'student_id');
    }

    // دالة حساب نسبة الحضور
    public function getAttendancePercentageAttribute()
    {
        // 1. جلب إجمالي الأيام المسجلة لهذا الطالب
        $totalDays = $this->attendances()->count();

        // إذا لم يتم تسجيل حضور له بعد، تكون النسبة 100% تلقائياً كبداية
        if ($totalDays == 0) {
            return 100;
        }

        // 2. جلب جميع الايام اللي اتى فيها الطالب اما حاضر او متاخر لعمل الحسبة
        $presentDays = $this->attendances()->whereIn('status', ['present', 'late'])->count();

        /**
         *  presentDays  قسم هذه الـ
         *  totalDays  على إجمالي الأيام كلها
         *   ونضربها في 100
         *   فتطلع نسبة حضور الطالب
         *   والتقريب لأقرب رقمين عشريين
         */
        return round(($presentDays / $totalDays) * 100, 2);
    }

    // العلاقة: واحد لمتعدد لجدول الرسوم
    public function monthlyFees()
    {
        return $this->hasMany(StudentMonthlyFee::class, 'student_id');
    }

    // 1. إجمالي المدفوع الحقيقي للطالب في هذا الشهر
    public function getTotalPaidAmountAttribute()
    {
        return (float) $this->monthlyFees()->where('billing_month', date('m-Y'))->sum('paid_amount');
    }

    // 2. إجمالي المطلوب: يقرأ من جدول الرسوم، وإذا لم يجد (طالب جديد) يقرأ الرسوم الحقيقية المخزنة في جدول الطلاب
    // 2. إجمالي المطلوب الحقيقي والذكي للطالب
    public function getTotalRequiredFeesAttribute()
    {
        // 1. نجلب القيمة الأساسية المحدثة من جدول الطلاب أولاً (الـ 1500 أو الـ 1000 الحالية)
        $studentAmount = (float) ($this->attributes['total_paid_amount'] ?? 0);

        // 2. نتحقق من وجود السجل المالي للشهر الحالي في جدول المدفوعات
        $currentMonthFee = $this->monthlyFees()->where('billing_month', date('m-Y'))->first();

        if ($currentMonthFee) {
            // 🔥 حركة ذكية: إذا تم تعديل رسوم الطالب الأساسية لتصبح مختلفة عن فاتورة الشهر، نقوم بتحديث الفاتورة فوراً خلف الكواليس
            if ((float)$currentMonthFee->monthly_amount !== $studentAmount) {
                $currentMonthFee->monthly_amount = $studentAmount;
                // إعادة حساب المتبقي داخل الجدول إذا كان الحقل موجوداً
                if (Schema::hasColumn('student_monthly_fees', 'remaining_amount')) {
                    $currentMonthFee->remaining_amount = $studentAmount - $currentMonthFee->paid_amount;
                }
                $currentMonthFee->save();
            }

            return (float) $currentMonthFee->monthly_amount;
        }

        // 3. إذا لم يكن له سجل دفع أصلاً (طالب جديد)، نرجع القيمة من جدول الطالب مباشرة
        return $studentAmount;
    }
    // 3. الحسبة الذهبية للمبلغ المتبقي: (المطلوب للشهر الحالي - المدفوع للشهر الحالي)
    public function getRemainingFeesAttribute()
    {
        // لمنع قراءة الحقل الثابت المخزن بالخطأ في الـ attributes
        $remaining = $this->total_required_fees - $this->total_paid_amount;
        return $remaining > 0 ? $remaining : 0;
    }

    // 4. الحالات المرتبطة بـ ألوان الـ Blade (paid, partial, unpaid)
    public function getFinancialStatusAttribute()
    {
        $totalRequired = $this->total_required_fees;
        $totalPaid     = $this->total_paid_amount;

        // إذا دفع كامل المطلوب أو أكثر، فهو مسدد بالكامل (Remaining = 0)
        if ($totalRequired > 0 && $totalPaid >= $totalRequired) {
            return 'paid';
        }

        // إذا دفع جزء وبقي جزء
        if ($totalPaid > 0 && $totalPaid < $totalRequired) {
            return 'partial';
        }

        // إذا لم يدفع أي شيء نهائياً من قسط هذا الشهر
        return 'unpaid';
    }
    // للبحث عند الفلترة
    public function scopeFilter($query, array $filters)
    {
        // 1. فلترة البحث (اسم الطالب أو رقم الهوية) - مدمج ذكياً
        $query->when($filters['search'] ?? null, function ($q, $search) {
            $q->where(function ($subQuery) use ($search) {
                $subQuery->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('id', 'like', '%' . $search . '%');
            });
        });

        // 2. فلترة الصف الدراسي
        $query->when($filters['academic_level'] ?? null, function ($q, $level) {
            if ($level !== 'all') {
                $q->where('academic_level', $level);
            }
        });

        // 3. فلترة الحالة المادية
        /**
         *  student_monthly_fees هذا الجزء يبحث في جدول الرسوم الدراسية
         *  ويقارن مجموع المبالغ المطلوبة بـ مجموع المبالغ المدفوعة الفردية لكل طالب بناءً على خياره
         */
        $query->when($filters['financial_status'] ?? null, function ($q, $status) {
            if ($status === 'all') return;

            $q->where(function ($subQuery) use ($status) {
                if ($status == 'paid') {
                    $subQuery->whereHas('monthlyFees', function ($f) {})
                        ->whereRaw('(SELECT SUM(paid_amount) FROM student_monthly_fees WHERE student_monthly_fees.student_id = students.id) >= (SELECT SUM(monthly_amount) FROM student_monthly_fees WHERE student_monthly_fees.student_id = students.id)');
                } elseif ($status == 'partial') {
                    $subQuery->whereHas('monthlyFees', function ($f) {})
                        ->whereRaw('(SELECT SUM(paid_amount) FROM student_monthly_fees WHERE student_monthly_fees.student_id = students.id) > 0')
                        ->whereRaw('(SELECT SUM(paid_amount) FROM student_monthly_fees WHERE student_monthly_fees.student_id = students.id) < (SELECT SUM(monthly_amount) FROM student_monthly_fees WHERE student_monthly_fees.student_id = students.id)');
                } elseif ($status == 'unpaid') {
                    $subQuery->whereRaw('(SELECT COALESCE(SUM(paid_amount), 0) FROM student_monthly_fees WHERE student_monthly_fees.student_id = students.id) = 0');
                }
            });
        });
    }
}
