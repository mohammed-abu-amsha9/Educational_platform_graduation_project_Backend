@extends('admin.parent')
@section('title', 'الرسوم')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6 items-start">
        <div class="lg:col-span-4 order-1 lg:sticky lg:top-6 z-10">
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 p-6 rounded-3xl shadow-sm">
                <div class="flex items-center gap-2 mb-6">
                    <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                    <h3 class="text-sm font-black text-slate-800 dark:text-zinc-100">
                        تسجيل دفعة
                    </h3>
                </div>

                <form action="{{ route('fees.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <input type="hidden" id="student_id_hidden" name="student_id">
                    <input type="hidden" id="academic_level_hidden" name="academic_level">
                    <input type="hidden" name="billing_month" value="{{ date('m-Y') }}">

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1.5">
                            اسم أو رقم الطالب
                        </label>
                        <input list="studentsList" id="studentInput" type="text"
                            placeholder="ابحث باسم الطالب أو رقمه..."
                            class="w-full border border-gray-200 dark:border-slate-800 focus:ring-2 focus:ring-teal-600 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-xs outline-none dark:text-zinc-200" />

                        <datalist id="studentsList">
                            @foreach ($students as $student)
                                <option value="{{ $student->student_code }} - {{ $student->full_name }}"
                                    data-id="{{ $student->id }}" data-level="{{ $student->academic_level }}"
                                    data-total="{{ $student->total_required_fees }}"
                                    data-paid="{{ $student->total_paid_amount }}">
                                </option>
                            @endforeach
                        </datalist>
                    </div>

                    <div id="studentInfoCard"
                        class="hidden bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800 p-3 rounded-xl space-y-2 text-xs">
                        <div class="flex justify-between">
                            <span class="text-slate-500">المرحلة الدراسية:</span>
                            <span id="infoLevel" class="font-bold text-slate-800 dark:text-zinc-200"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">القسط الشهري المطلوب للمرحلة:</span>
                            <span id="infoTotal" class="font-bold text-slate-800 dark:text-zinc-200"></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">المدفوع سابقاً هذا الشهر:</span>
                            <span id="infoPaid" class="font-bold text-blue-600"></span>
                        </div>
                        <div
                            class="flex justify-between border-t border-dashed border-slate-200 dark:border-slate-700 pt-2 font-bold">
                            <span class="text-slate-700 dark:text-zinc-300">المبلغ المتبقي عليه حالياً:</span>
                            <span id="infoRemaining" class="text-rose-600"></span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1.5">
                            المبلغ المراد دفعه الآن (₪)
                        </label>
                        <input type="number" step="0.01" id="amountInput" name="paid_amount"
                            placeholder="أدخل المبلغ المسدّد حالياً..."
                            class="w-full border border-gray-200 dark:border-slate-800 focus:ring-2 focus:ring-teal-600 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-xs outline-none dark:text-zinc-200" />
                        <input type="hidden" id="monthlyAmountInput" name="monthly_amount">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1.5">طريقة الدفع</label>
                        <select name="payment_method"
                            class="w-full border border-gray-200 dark:border-slate-800 focus:ring-2 focus:ring-teal-600 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-xs outline-none pointer dark:text-zinc-200">
                            <option value="نقداً">نقداً 💵</option>
                            <option value="تحويل بنكي">تحويل بنكي 🏦</option>
                            <option value="محفظة إلكترونية">محفظة إلكترونية 📱</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1.5">ملاحظات</label>
                        <textarea name="notes"
                            class="w-full border border-gray-200 dark:border-slate-800 focus:ring-2 focus:ring-teal-600 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-xs outline-none h-16 resize-none dark:text-zinc-200"></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 text-xs rounded-xl shadow-md shadow-teal-600/10 flex items-center justify-center gap-2">
                        <span>💾 تسجيل الدفعة</span>
                    </button>
                </form>


            </div>
        </div>

        <div class="lg:col-span-8 space-y-6 order-2">
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 p-6 rounded-3xl shadow-sm">
                <h3 class="text-sm font-black text-slate-800 dark:text-zinc-100 mb-4">
                    آخر المعاملات المالية
                </h3>

                <div class="space-y-3">
                    <div
                        class="flex items-center justify-between p-4 bg-slate-100/75 dark:bg-slate-800/40 rounded-2xl text-xs">
                        <div>
                            <p class="font-bold text-slate-800 dark:text-zinc-200">
                                فاطمة زياد طليمات
                            </p>
                            <p class="text-[10px] text-gray-400 mt-1">
                                2024-09-12 - تحويل بنكي
                            </p>
                        </div>
                        <span class="font-bold text-teal-600">₪ 800</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 p-6 rounded-3xl shadow-sm">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-sm font-black text-slate-800 dark:text-zinc-100">
                        توزيع طرق الدفع
                    </h3>
                    <span class="text-xs text-slate-400 font-bold">الإجمالي: ₪3,200</span>
                </div>

                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-slate-700 dark:text-zinc-300 flex items-center gap-1.5">💵
                                نقداً</span>
                            <span class="text-teal-600">₪1,600 (50%)</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-teal-500 h-full rounded-full" style="width: 50%"></div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-slate-700 dark:text-zinc-300 flex items-center gap-1.5">🏦 تحويل
                                بنكي</span>
                            <span class="text-blue-600">₪1,300 (40%)</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-blue-500 h-full rounded-full" style="width: 40%"></div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-slate-700 dark:text-zinc-300 flex items-center gap-1.5">📱 محفظة
                                إلكترونية</span>
                            <span class="text-purple-600">₪300 (10%)</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-purple-500 h-full rounded-full" style="width: 10%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var options = {
                // القيم المأخوذة من تصميمك الحالي (1600، 1300، 300)
                series: [1600, 1300, 300],
                chart: {
                    type: "donut",
                    width: "100%",
                    height: 280,
                    fontFamily: "Cairo, sans-serif",
                },
                // المسميات المتوافقة مع ألوانك
                labels: ["نقداً", "تحويل بنكي", "محفظة إلكترونية"],
                colors: ["#0d9488", "#3b82f6", "#a855f7"], // تيل، أزرق، بنفسجي متناسق مع التيلوند
                stroke: {
                    show: true,
                    colors: document.documentElement.classList.contains("dark") ? ["#0f172a"] : ["#ffffff"],
                    width: 2,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: "75%",
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: "الإجمالي",
                                    formatter: function(w) {
                                        return "₪3,200"; // مجموع القيم الكلي
                                    },
                                    style: {
                                        fontSize: "14px",
                                        fontWeight: "bold",
                                        color: "#64748b",
                                    },
                                },
                            },
                        },
                    },
                },
                legend: {
                    position: "bottom",
                    fontSize: "12px",
                    labels: {
                        colors: document.documentElement.classList.contains("dark") ?
                            "#94a3b8" : "#64748b",
                    },
                    markers: {
                        offsetX: -5,
                    },
                },
                dataLabels: {
                    enabled: false, // إخفاء الأرقام من فوق الدائرة مباشرة لتبدو أنظف
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "₪" + val;
                        },
                    },
                },
            };

            var chart = new ApexCharts(
                document.querySelector("#paymentMethodsChart"),
                options,
            );
            chart.render();
        });
        // استهداف كل الأزرار التي تحمل كلاس theme-toggle
        const themeToggleBtns = document.querySelectorAll(".theme-toggle");
        const htmlElement = document.documentElement;

        // دالة موحدة لتحديث الأيقونات في شاشة الكمبيوتر وشاشة الموبايل معاً
        function updateThemeUI(isDark) {
            themeToggleBtns.forEach((btn) => {
                const icon = btn.querySelector(".theme-icon");
                if (icon) {
                    if (isDark) {
                        icon.classList.remove("fa-regular", "fa-moon");
                        icon.classList.add("fa-solid", "fa-sun", "text-amber-400");
                    } else {
                        icon.classList.remove("fa-solid", "fa-sun", "text-amber-400");
                        icon.classList.add("fa-regular", "fa-moon");
                    }
                }
            });
        }

        // 1. فحص الـ LocalStorage عند تحميل الصفحة
        const currentTheme = localStorage.getItem("theme");
        if (currentTheme === "dark") {
            htmlElement.classList.add("dark");
            updateThemeUI(true);
        } else {
            htmlElement.classList.remove("dark");
            updateThemeUI(false);
        }

        // 2. تفعيل التبديل عند الضغط على أي زر (سواءً بالكمبيوتر أو بالموبايل)
        themeToggleBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                const isDark = htmlElement.classList.toggle("dark");

                // حفظ الخيار وتحديث واجهة الأزرار فوراً
                localStorage.setItem("theme", isDark ? "dark" : "light");
                updateThemeUI(isDark);
            });
        });
    </script>
    <script>
        document.getElementById('studentInput').addEventListener('input', function() {
            var val = this.value;
            var opts = document.getElementById('studentsList').childNodes;

            var card = document.getElementById('studentInfoCard');
            var levelSpan = document.getElementById('infoLevel');
            var totalSpan = document.getElementById('infoTotal');
            var paidSpan = document.getElementById('infoPaid');
            var remainingSpan = document.getElementById('infoRemaining');
            var amountInput = document.getElementById('amountInput'); // حقل إدخال المبلغ الجديد بالنموذج

            // الحقول المخفية المجهزة للإرسال للـ Controller
            var studentIdHidden = document.getElementById('student_id_hidden');
            var academicLevelHidden = document.getElementById('academic_level_hidden');
            var monthlyAmountHidden = document.getElementById('monthlyAmountInput');

            var found = false;

            for (var i = 0; i < opts.length; i++) {
                if (opts[i].nodeName === "OPTION" && opts[i].value === val) {
                    var id = opts[i].getAttribute('data-id');
                    var level = opts[i].getAttribute('data-level');
                    var total = parseFloat(opts[i].getAttribute('data-total'));
                    var paid = parseFloat(opts[i].getAttribute('data-paid'));

                    var remaining = total - paid;

                    // تحديث نصوص البطاقة لتظهر كما في لقطة الشاشة تماماً بقيمها الحقيقية
                    levelSpan.textContent = level;
                    totalSpan.textContent = total + " ₪";
                    paidSpan.textContent = paid + " ₪";
                    remainingSpan.textContent = remaining + " ₪";

                    // تعبئة البيانات المخفية للـ Controller
                    if (studentIdHidden) studentIdHidden.value = id;
                    if (academicLevelHidden) academicLevelHidden.value = level;
                    if (monthlyAmountHidden) monthlyAmountHidden.value = total;

                    // إدارة حقل الدفع بناءً على المتبقي
                    if (amountInput) {
                        amountInput.max = remaining;
                        if (remaining <= 0) {
                            remainingSpan.className = "text-green-600 font-bold";
                            remainingSpan.innerHTML = "مسدّد بالكامل 👍";
                            amountInput.disabled = true;
                        } else {
                            remainingSpan.className = "text-rose-600 font-bold";
                            amountInput.disabled = false;
                        }
                    }

                    card.classList.remove('hidden');
                    found = true;
                    break;
                }
            }

            if (!found) {
                card.classList.add('hidden');
                if (studentIdHidden) studentIdHidden.value = "";
            }
        });
    </script>
@endsection
