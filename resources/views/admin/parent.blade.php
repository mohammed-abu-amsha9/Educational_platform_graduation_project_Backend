<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>منصة صمود - لوحة تحكم الإدارة - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-7.2.0-web/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/join_style.css') }}" />

    @yield('styles')
</head>

<body class="bg-gray-50 text-gray-850 dark:bg-slate-950 dark:text-zinc-100">
    <header class="bg-white border-b-1 border-gray-100 sticky top-0 z-50 shadow-sm dark:bg-slate-950 dark:text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="w-11 h-11 bg-teal-700 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-md shadow-teal-700/10 overflow-hidden">
                    <img src="{{ asset('assets/img/Logo.png') }}" alt="لوجو منصة صمود"
                        class="w-full h-full object-cover rounded-full" />
                </div>
                <div class="">
                    <h1 class="font-bold text-base text-gray-900 leading-tight dark:bg-slate-950 dark:text-zinc-100">
                        منصة صمود
                    </h1>
                    <p class="text-xs text-gray-500 dark:bg-slate-950 dark:text-zinc-100">
                        نظام التعلم الهجين
                    </p>
                </div>
            </div>

            <nav class="hidden md:flex items-center gap-1 bg-slate-100 dark:bg-slate-700 p-1.5 rounded-xl">
                <a href="{{ route('admin_control_panel') }}"
                    class="px-5 py-2 rounded-lg text-sm font-semibold bg-teal-700 text-white shadow-sm dark:text-zinc-100">لوحة
                    الإدارة</a>
                <a href="{{ route('teacher_control_panel') }}"
                    class="px-5 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:text-teal-700 dark:text-zinc-100">بوابة
                    المعلم</a>
                <a href="{{ route('student_control_panel') }}"
                    class="px-5 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:text-teal-700 dark:text-zinc-100">بوابة
                    الطالب</a>
            </nav>

            <div class="hidden md:flex items-center gap-4">
                <div class="relative inline-block text-right">
                    <button id="notification-btn"
                        class="relative p-2 text-slate-600 dark:text-zinc-300 hover:bg-gray-100 dark:hover:bg-slate-800 rounded-xl transition-colors cursor-pointer">
                        <i class="fa-regular fa-bell text-lg"></i>
                        <span class="absolute top-1.5 left-1.5 flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-rose-500"></span>
                        </span>
                    </button>

                    <div id="notification-dropdown"
                        class="hidden absolute left-0 mt-2 w-72 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 rounded-2xl shadow-xl z-50 overflow-hidden animate-scale-up"
                        dir="rtl">
                        <div
                            class="p-3 bg-gray-50/50 dark:bg-slate-950/40 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between">
                            <span class="font-black text-slate-800 dark:text-zinc-100 text-xs">🔔 الإشعارات
                                الحديثة</span>
                            <span
                                class="bg-indigo-50 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 text-[9px] px-2 py-0.5 rounded-md font-bold">5
                                جديدة</span>
                        </div>

                        <div
                            class="divide-y divide-gray-50 dark:divide-slate-800/60 max-h-[225px] overflow-y-auto scrollbar-thin">
                            <a href="#"
                                class="block p-3 hover:bg-gray-50 dark:hover:bg-slate-950/40 transition-colors">
                                <div class="flex gap-2">
                                    <div class="w-2 h-2 rounded-full bg-indigo-600 mt-1.5 shrink-0"></div>
                                    <div class="space-y-0.5">
                                        <p class="font-bold text-slate-800 dark:text-zinc-200 text-[11px]">
                                            تم إضافة واجب جديد في اللغة العربية
                                        </p>
                                        <p class="text-gray-400 text-[9px]">
                                            منذ 10 دقائق • الأستاذة سارة
                                        </p>
                                    </div>
                                </div>
                            </a>

                            <a href="#"
                                class="block p-3 hover:bg-gray-50 dark:hover:bg-slate-950/40 transition-colors">
                                <div class="flex gap-2">
                                    <div class="w-2 h-2 rounded-full bg-emerald-500 mt-1.5 shrink-0"></div>
                                    <div class="space-y-0.5">
                                        <p class="font-bold text-slate-800 dark:text-zinc-200 text-[11px]">
                                            رصد درجة اختبار الكيمياء: حصلتِ على 4/4
                                        </p>
                                        <p class="text-gray-400 text-[9px]">
                                            منذ ساعتين • الإدارة المدرسية
                                        </p>
                                    </div>
                                </div>
                            </a>

                            <a href="#"
                                class="block p-3 hover:bg-gray-50 dark:hover:bg-slate-950/40 transition-colors">
                                <div class="flex gap-2">
                                    <div class="w-2 h-2 rounded-full bg-amber-500 mt-1.5 shrink-0"></div>
                                    <div class="space-y-0.5">
                                        <p class="font-bold text-slate-800 dark:text-zinc-200 text-[11px]">
                                            تعديل موعد اختبار الرياضيات القادم
                                        </p>
                                        <p class="text-gray-400 text-[9px]">اليوم، 10:30 ص</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#"
                                class="block p-3 hover:bg-gray-50 dark:hover:bg-slate-950/40 transition-colors">
                                <div class="flex gap-2">
                                    <div class="w-2 h-2 rounded-full bg-slate-400 mt-1.5 shrink-0"></div>
                                    <div class="space-y-0.5">
                                        <p class="font-bold text-slate-800 dark:text-zinc-200 text-[11px]">
                                            تم قبول عذر الغياب ليوم الخميس الماضي
                                        </p>
                                        <p class="text-gray-400 text-[9px]">أمس، 4:15 م</p>
                                    </div>
                                </div>
                            </a>

                            <a href="#"
                                class="block p-3 hover:bg-gray-50 dark:hover:bg-slate-950/40 transition-colors">
                                <div class="flex gap-2">
                                    <div class="w-2 h-2 rounded-full bg-indigo-600 mt-1.5 shrink-0"></div>
                                    <div class="space-y-0.5">
                                        <p class="font-bold text-slate-800 dark:text-zinc-200 text-[11px]">
                                            نشاط صفي جديد: مسابقة الخط العربي السنوية
                                        </p>
                                        <p class="text-gray-400 text-[9px]">قبل يومين</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <button
                    class="theme-toggle w-9 h-9 rounded-xl bg-gray-50 flex items-center justify-center text-gray-500 hover:text-teal-700 hover:bg-gray-200 dark:bg-slate-950 dark:text-zinc-100 dark:hover:text-amber-400 dark:hover:bg-slate-800 -colors">
                    <i class="theme-icon fa-regular fa-moon text-lg"></i>
                </button>

                <div class="h-8 w-px bg-gray-200"></div>

                <div class="relative inline-block text-right">
                    <button id="user-menu-btn"
                        class="flex items-center gap-3 p-1.5 rounded-xl cursor-pointer focus:outline-none hover:bg-gray-50 dark:hover:bg-slate-700">
                        <div
                            class="w-10 h-10 bg-teal-700 rounded-3xl flex items-center justify-center text-zinc-100 font-bold text-lg shrink-0 dark:text-zinc-100 dark:bg-teal-700">
                            د
                        </div>
                        <div class="text-right hidden sm:block">
                            <p class="font-bold text-sm text-gray-900 leading-tight dark:text-zinc-100">
                                د. أحمد الصبور
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5 dark:text-zinc-100">
                                مدير النظام
                            </p>
                        </div>
                    </button>

                    <div id="user-dropdown"
                        class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-50 py-1 origin-top-left duration-200 dark:bg-slate-950 dark:text-zinc-100">
                        <a style="color: #dc2626" href="{{ route('login') }}"
                            class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-bold">
                            <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                            <span>تسجيل الخروج</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn"
                    class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-600">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu"
            class="hidden md:hidden border-t border-gray-100 bg-slate-100 dark:bg-slate-800 px-4 pt-2 pb-4 space-y-2 shadow-inner">
            <a href="{{ route('admin_control_panel') }}"
                class="block px-4 py-2.5 rounded-xl text-sm font-bold bg-teal-700 text-white shadow-sm dark:text-zinc-100">لوحة
                الإدارة</a>
            <a href="{{ route('teacher_control_panel') }}"
                class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400">بوابة
                المعلم</a>
            <a href="{{ route('student_control_panel') }}"
                class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400">بوابة
                الطالب</a>

            <div class="border-t border-gray-200 dark:border-slate-700 my-2 pt-2">
                <button id="mobile-user-menu-btn"
                    class="w-full flex justify-between items-center px-4 py-2 rounded-xl hover:bg-gray-50 dark:hover:bg-slate-700 cursor-pointer focus:outline-none">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 bg-teal-600/10 rounded-xl flex items-center justify-center text-teal-700 dark:text-teal-400 font-bold">
                            د
                        </div>
                        <span class="text-sm font-bold text-gray-800 dark:text-zinc-200">د. أحمد الصبور</span>
                    </div>
                </button>

                <div id="mobile-user-dropdown"
                    class="hidden bg-gray-50/60 dark:bg-slate-900/40 rounded-2xl mt-1 mx-2 border border-gray-100 overflow-hidden">
                    <a style="color: #dc2626" href="{{ route('login') }}"
                        class="flex items-center gap-2.5 px-6 py-2.5 text-sm text-red-600 dark:bg-slate-950 dark:text-zinc-100">
                        <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                        <span>تسجيل الخروج</span>
                    </a>
                </div>

                <div class="flex justify-end gap-2 mt-3 px-4">
                    <button
                        class="w-9 h-9 rounded-xl bg-gray-50 dark:bg-slate-950 flex items-center justify-center text-gray-500 dark:text-zinc-400 hover:bg-gray-100 dark:hover:bg-slate-900">
                        <i class="fa-regular fa-bell"></i>
                    </button>

                    <button
                        class="theme-toggle w-9 h-9 rounded-xl bg-gray-50 flex items-center justify-center text-gray-500 hover:text-teal-700 hover:bg-gray-200 dark:bg-slate-950 dark:text-zinc-100 dark:hover:text-amber-400 dark:hover:bg-slate-800 -colors">
                        <i class="theme-icon fa-regular fa-moon text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <div class="">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-zinc-100">
                    لوحة تحكم الإدارة
                </h2>
                <p class="text-sm text-gray-500 dark:text-zinc-100 mt-1">
                    إدارة شاملة للطلاب والمعلمين والرسوم والصلاحيات
                </p>
            </div>
            <div class="self-start sm:self-center">
                <span
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    النظام يعمل
                </span>
            </div>
        </div>

        <div
            class="bg-white border border-gray-200/60 rounded-2xl p-2.5 shadow-sm dark:bg-slate-800 dark:border-slate-800">
            <div class="flex flex-row items-center gap-2 overflow-x-auto custom-scrollbar">

                <a href="{{ route('admin_control_panel') }}"
                    class="flex items-center justify-center sm:justify-start gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('admin_control_panel') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-100' }}">
                    <i class="fa-solid fa-chart-pie text-base"></i>
                    <span>نظرة عامة</span>
                </a>

                <a href="{{ route('students.index') }}"
                    class="flex items-center justify-center sm:justify-start gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('students.index') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-100' }}">
                    <i class="fa-solid fa-graduation-cap text-base"></i>
                    <span>الطلاب</span>
                </a>

                <a href="{{ route('teachers.index') }}"
                    class="flex items-center justify-center sm:justify-start gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('teachers.index') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-100' }}">
                    <i class="fa-solid fa-chalkboard-user text-base"></i>
                    <span>المعلمون</span>
                </a>

                <a href="{{ route('fees.index') }}"
                    class="flex items-center justify-center sm:justify-start gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('fees.index') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-100' }}">
                    <i class="fa-solid fa-wallet text-base"></i>
                    <span>الرسوم</span>
                </a>

                <a href="{{ route('roles.index') }}"
                    class="flex items-center justify-center sm:justify-start gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('roles.index') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-100' }}">
                    <i class="fa-solid fa-shield-halved text-base"></i>
                    <span>الأدوار والصلاحيات</span>
                </a>
            </div>
        </div>
        @yield('content')
    </main>


    <footer class="w-full bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800/80 py-5">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-center dir-rtl">
            <p class="text-xs sm:text-sm font-medium text-slate-500 dark:text-zinc-400 text-center tracking-wide">
                منصة صمود التعليمية - نظام التعلم الهجين - © 2026 جميع الحقوق محفوظة
            </p>
        </div>
    </footer>

    <script>
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
        const menuBtn = document.getElementById("mobile-menu-btn");
        const mobileMenu = document.getElementById("mobile-menu");

        menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    </script>
    <script>
        const userMenuBtn = document.getElementById("user-menu-btn");
        const userDropdown = document.getElementById("user-dropdown");

        // عند الضغط على الزر: اظهر أو اخفي القائمة
        userMenuBtn.addEventListener("click", (e) => {
            e.stopPropagation(); // يمنع انتشار الضغطة حتى لا يتنفذ أمر الإغلاق فوراً
            userDropdown.classList.toggle("hidden");
        });

        // إغلاق القائمة تلقائياً إذا ضغط المستخدم في أي مكان خارجها
        document.addEventListener("click", (e) => {
            if (
                !userDropdown.contains(e.target) &&
                !userMenuBtn.contains(e.target)
            ) {
                userDropdown.classList.add("hidden");
            }
        });
    </script>
    <script>
        const mobileUserMenuBtn = document.getElementById("mobile-user-menu-btn");
        const mobileUserDropdown = document.getElementById(
            "mobile-user-dropdown",
        );
        const mobileArrow = document.getElementById("mobile-arrow");

        mobileUserMenuBtn.addEventListener("click", () => {
            // إظهار أو إخفاء القائمة المنسدلة
            mobileUserDropdown.classList.toggle("hidden");

            // تدوير السهم الصغير بزاوية 180 درجة لإعطاء حركة تفاعلية
            mobileArrow.classList.toggle("rotate-180");
        });
    </script>
    <script>
        // ==========================================
        // إدارة قائمة الإشعارات المنسدلة
        // ==========================================
        const notifBtn = document.getElementById("notification-btn");
        const notifDropdown = document.getElementById("notification-dropdown");

        if (notifBtn && notifDropdown) {
            // عند الضغط على الجرس: اظهر أو اخفي القائمة
            notifBtn.addEventListener("click", (e) => {
                e.stopPropagation(); // يمنع انتشار الضغطة
                notifDropdown.classList.toggle("hidden");

                // إخفاء قائمة المستخدم إذا كانت مفتوحة لعدم التداخل
                document.getElementById("user-dropdown")?.classList.add("hidden");
            });

            // إغلاق قائمة الإشعارات تلقائياً إذا ضغط المستخدم في أي مكان خارجها
            document.addEventListener("click", (e) => {
                if (
                    !notifDropdown.contains(e.target) &&
                    !notifBtn.contains(e.target)
                ) {
                    notifDropdown.classList.add("hidden");
                }
            });
        }
    </script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // 1. حالة النجاح (Success Toast)
            @if (session('success'))
                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    customClass: {
                        popup: 'dark:bg-slate-800 dark:text-white'
                    }
                }).fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            @endif

            // 2. حالة وجود أخطاء في المدخلات (Validation Errors Toast)
            @if ($errors->any())
                // تجميع كافة الأخطاء في نص واحد مفصول بأسطر
                let errorMessages = "";
                @foreach ($errors->all() as $error)
                    errorMessages += "• {{ $error }}\n";
                @endforeach

                Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000, // زيادة الوقت قليلاً ليتمكن المستخدم من قراءة الأخطاء
                    timerProgressBar: true,
                    customClass: {
                        popup: 'dark:bg-slate-800 dark:text-white text-right'
                    }
                }).fire({
                    icon: 'error',
                    title: 'يرجى تصحيح الأخطاء التالية:',
                    html: '<pre style="font-family: inherit; text-align: right; direction: rtl; white-space: pre-line;" class="text-xs text-red-500 font-bold">' +
                        errorMessages + '</pre>'
                });
            @endif

        });
    </script>
    @yield('scripts')
</body>

</html>
