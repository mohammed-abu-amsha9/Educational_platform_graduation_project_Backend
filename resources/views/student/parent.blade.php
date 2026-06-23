<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>منصة صمود - لوحة بوابة الطالب - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/Logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/output.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/fontawesome-free-7.2.0-web/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/join_style.css') }}" />

    @yield('styles')
</head>

<body class="bg-gray-50 text-gray-800 dark:bg-slate-950 dark:text-zinc-100 min-h-screen font-['Cairo']">
    <header
        class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-sm dark:bg-slate-900 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div
                    class="w-11 h-11 bg-teal-700 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-md shadow-teal-700/10 overflow-hidden">
                    <img src="{{ asset('assets/img/Logo.png') }}" alt="لوجو منصة صمود"
                        class="w-full h-full object-cover rounded-full" />
                </div>
                <div>
                    <h1 class="font-bold text-base text-gray-900 leading-tight dark:text-zinc-100">
                        منصة صمود
                    </h1>
                    <p class="text-xs text-gray-500 dark:text-zinc-400">
                        نظام التعلم الهجين
                    </p>
                </div>
            </div>

            <nav class="hidden md:flex items-center gap-1 bg-gray-100 dark:bg-slate-800 p-1.5 rounded-xl">
                <a href="{{route('admin_control_panel')}}"
                    class="px-5 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400">لوحة
                    الإدارة</a>
                <a href="{{route('teacher_control_panel')}}"
                    class="px-5 py-2 rounded-lg text-sm font-semibold text-gray-600 hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400">بوابة
                    المعلم</a>
                <a href="{{route('student_control_panel')}}"
                    class="px-5 py-2 rounded-lg text-sm font-semibold bg-teal-700 text-white shadow-sm">بوابة الطالب</a>
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
                                            تم إضافة واجب جديد في اللغة
                                            العربية
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
                                            رصد درجة اختبار الكيمياء: حصلتِ
                                            على 4/4
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
                                            تعديل موعد اختبار الرياضيات
                                            القادم
                                        </p>
                                        <p class="text-gray-400 text-[9px]">
                                            اليوم، 10:30 ص
                                        </p>
                                    </div>
                                </div>
                            </a>

                            <a href="#"
                                class="block p-3 hover:bg-gray-50 dark:hover:bg-slate-950/40 transition-colors">
                                <div class="flex gap-2">
                                    <div class="w-2 h-2 rounded-full bg-slate-400 mt-1.5 shrink-0"></div>
                                    <div class="space-y-0.5">
                                        <p class="font-bold text-slate-800 dark:text-zinc-200 text-[11px]">
                                            تم قبول عذر الغياب ليوم الخميس
                                            الماضي
                                        </p>
                                        <p class="text-gray-400 text-[9px]">
                                            أمس، 4:15 م
                                        </p>
                                    </div>
                                </div>
                            </a>

                            <a href="#"
                                class="block p-3 hover:bg-gray-50 dark:hover:bg-slate-950/40 transition-colors">
                                <div class="flex gap-2">
                                    <div class="w-2 h-2 rounded-full bg-indigo-600 mt-1.5 shrink-0"></div>
                                    <div class="space-y-0.5">
                                        <p class="font-bold text-slate-800 dark:text-zinc-200 text-[11px]">
                                            نشاط صفي جديد: مسابقة الخط
                                            العربي السنوية
                                        </p>
                                        <p class="text-gray-400 text-[9px]">
                                            قبل يومين
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <button
                    class="theme-toggle w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-500 hover:text-teal-700 hover:bg-gray-100 dark:bg-slate-800 dark:text-zinc-300 dark:hover:bg-slate-700">
                    <i class="theme-icon fa-regular fa-moon text-lg"></i>
                </button>

                <div class="h-8 w-px bg-gray-200 dark:bg-slate-700"></div>

                <div class="relative inline-block text-right">
                    <button id="user-menu-btn"
                        class="flex items-center gap-3 p-1.5 rounded-xl cursor-pointer focus:outline-none hover:bg-gray-50 dark:hover:bg-slate-800">
                        <div
                            class="w-10 h-10 bg-teal-700 rounded-full flex items-center justify-center text-zinc-100 font-bold text-lg shrink-0">
                            م
                        </div>
                        <div class="text-right hidden sm:block">
                            <p class="font-bold text-sm text-gray-900 leading-tight dark:text-zinc-100">
                                مريم أحمد يوسف
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5 dark:text-zinc-400">
                                طالب
                            </p>
                        </div>
                    </button>

                    <div id="user-dropdown"
                        class="hidden absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-50 py-1 dark:bg-slate-900 dark:border-slate-800 text-right">
                        <a href="{{route('login')}}"
                            class="flex items-center gap-2.5 px-4 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 dark:hover:bg-red-950/3">
                            <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                            <span>تسجيل الخروج</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-menu-btn"
                    class="w-10 h-10 rounded-xl bg-gray-50 flex items-center justify-center text-gray-600 dark:bg-slate-800 dark:text-zinc-300">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu"
            class="hidden md:hidden border-t border-gray-100 bg-gray-50 dark:bg-slate-900 dark:border-slate-800 px-4 pt-2 pb-4 space-y-2 shadow-inner">
            <a href="{{route('admin_control_panel')}}"
                class="block px-4 py-2.5 rounded-xl text-sm font-bold text-gray-600 hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400">لوحة
                الإدارة</a>
            <a href="{{route('teacher_control_panel')}}"
                class="block px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-600 hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400">بوابة
                المعلم</a>
            <a href="{{route('student_control_panel')}}"
                class="block px-4 py-2.5 rounded-xl text-sm font-semibold bg-teal-700 text-white shadow-sm">بوابة
                الطالب</a>

            <div class="border-t border-gray-200 dark:border-slate-800 my-2 pt-2">
                <button id="mobile-user-menu-btn"
                    class="w-full flex justify-between items-center px-4 py-2 rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800 cursor-pointer focus:outline-none">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 bg-teal-600/10 rounded-xl flex items-center justify-center text-teal-700 dark:text-teal-400 font-bold">
                            د
                        </div>
                        <span class="text-sm font-bold text-gray-800 dark:text-zinc-200">د. أحمد الصبور</span>
                    </div>
                    <i id="mobile-arrow"
                        class="fa-solid fa-chevron-down text-xs text-gray-400 -transform duration-200"></i>
                </button>

                <div id="mobile-user-dropdown"
                    class="hidden bg-white dark:bg-slate-950 rounded-xl mt-1 mx-2 border border-gray-100 dark:border-slate-800 overflow-hidden shadow-inner">
                    <a href="{{route('login')}}"
                        class="flex items-center gap-2.5 px-6 py-2.5 text-sm text-red-600 font-medium hover:bg-red-50 dark:hover:bg-red-950/20">
                        <i class="fa-solid fa-arrow-right-from-bracket text-base"></i>
                        <span>تسجيل الخروج</span>
                    </a>
                </div>

                <div class="flex justify-end gap-2 mt-3 px-4">
                    <button
                        class="w-9 h-9 rounded-xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-gray-500 dark:text-zinc-400 hover:bg-gray-200">
                        <i class="fa-regular fa-bell"></i>
                    </button>
                    <button
                        class="theme-toggle w-9 h-9 rounded-xl bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-gray-500 dark:text-zinc-400 hover:bg-gray-200">
                        <i class="theme-icon fa-regular fa-moon"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col gap-6">
        <div id="status-bar"
            class="w-full bg-white border border-emerald-400 rounded-2xl p-4 flex flex-wrap items-center justify-between gap-4 shadow-sm dark:bg-slate-900 dark:border-emerald-500/40">
            <div class="flex items-center gap-4">
                <div id="status-badge"
                    class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-1.5 rounded-full text-sm font-semibold flex items-center gap-2 dark:bg-emerald-950/30 dark:text-emerald-400 dark:border-emerald-800/50">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span id="badge-text">متصل</span>
                </div>
                <div id="status-details"
                    class="text-gray-500 text-sm font-medium flex items-center gap-1 dark:text-zinc-400">
                    <span class="text-gray-700 dark:text-zinc-200">✓ متزامن</span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <button id="toggle-connection-btn" onclick="toggleConnection()"
                    class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 font-medium text-sm px-3.5 py-2 rounded-xl flex items-center gap-2 shadow-sm active:scale-95 dark:bg-slate-800 dark:border-slate-700 dark:text-zinc-200 dark:hover:bg-slate-700">
                    <i id="toggle-icon" class="fa-solid fa-toggle-off text-orange-500 text-base"></i>
                    <span id="toggle-text">محاكاة عدم الاتصال</span>
                </button>

                <button onclick="triggerSync()"
                    class="bg-teal-700 hover:bg-teal-800 text-white font-medium text-sm px-3.5 py-2 rounded-xl flex items-center gap-2 shadow-sm active:scale-95">
                    <i class="fa-solid fa-arrows-rotate text-xs"></i>
                    <span>المزامنة الآن</span>
                </button>
            </div>
        </div>

        <div
            class="bg-white border border-gray-200/60 rounded-2xl p-2.5 shadow-sm dark:bg-slate-900 dark:border-slate-800">
            <div class="flex flex-row items-center gap-2 overflow-x-auto custom-scrollbar">

                <a href="{{ route('student_control_panel') }}"
                    class="flex items-center gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('student_control_panel') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400' }}">
                    <i class="fa-solid fa-gauge-high text-base"></i>
                    <span>الرئيسية</span>
                </a>

                <a href="{{ route('student_materials') }}"
                    class="flex items-center gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('student_materials') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400' }}">
                    <i class="fa-solid fa-book-open text-base"></i>
                    <span>المواد</span>
                </a>

                <a href="{{ route('student_tests') }}"
                    class="flex items-center gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('student_tests') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400' }}">
                    <i class="fa-solid fa-clipboard-question text-base"></i>
                    <span>الإختبارات</span>
                </a>

                <a href="{{ route('student_tasks_and_duties') }}"
                    class="flex items-center gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('student_tasks_and_duties') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400' }}">
                    <i class="fa-solid fa-chalkboard-user text-base"></i>
                    <span>المهام والواجبات</span>
                </a>

                <a href="{{ route('student_chats') }}"
                    class="flex items-center gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('student_chats') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400' }}">
                    <i class="fa-solid fa-comments text-base"></i>
                    <span>الدردشة</span>
                </a>

                <a href="{{ route('student_sync') }}"
                    class="flex items-center gap-2.5 px-6 py-3 rounded-xl text-sm whitespace-nowrap
            {{ request()->routeIs('student_sync') ? 'bg-teal-700 text-white font-bold shadow-md shadow-teal-700/10' : 'text-gray-600 font-semibold hover:text-teal-700 dark:text-zinc-300 dark:hover:text-teal-400' }}">
                    <i class="fa-solid fa-cloud-arrow-up text-base"></i>
                    <span>المزامنة</span>
                </a>

            </div>
        </div>

        @yield('content')
    </main>

    <div id="toast-container" class="fixed bottom-5 left-5 z-50 flex flex-col gap-3 pointer-events-none"></div>
    <footer class="w-full bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800/80 py-5">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-center dir-rtl">
            <p class="text-xs sm:text-sm font-medium text-slate-500 dark:text-zinc-400 text-center tracking-wide">
                منصة صمود التعليمية - نظام التعلم الهجين - © 2026 جميع
                الحقوق محفوظة
            </p>
        </div>
    </footer>
    <script>
        // 1. منطق تبديل الوضع الليلي والنهاري (Dark/Light Mode)
        const themeToggleBtns = document.querySelectorAll(".theme-toggle");
        const htmlElement = document.documentElement;

        function updateThemeUI(isDark) {
            themeToggleBtns.forEach((btn) => {
                const icon = btn.querySelector(".theme-icon");
                if (icon) {
                    if (isDark) {
                        icon.className =
                            "theme-icon fa-solid fa-sun text-amber-400 text-lg";
                    } else {
                        icon.className =
                            "theme-icon fa-regular fa-moon text-lg";
                    }
                }
            });
        }

        const currentTheme = localStorage.getItem("theme");
        if (currentTheme === "dark") {
            htmlElement.classList.add("dark");
            updateThemeUI(true);
        } else {
            htmlElement.classList.remove("dark");
            updateThemeUI(false);
        }

        themeToggleBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
                const isDark = htmlElement.classList.toggle("dark");
                localStorage.setItem("theme", isDark ? "dark" : "light");
                updateThemeUI(isDark);
            });
        });

        // 2. تفعيل القائمة الجانبية للموبايل
        const menuBtn = document.getElementById("mobile-menu-btn");
        const mobileMenu = document.getElementById("mobile-menu");

        menuBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });

        // 3. التحكم بقائمة المستخدم المنسدلة (Desktop Dropdown)
        const userMenuBtn = document.getElementById("user-menu-btn");
        const userDropdown = document.getElementById("user-dropdown");

        userMenuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            userDropdown.classList.toggle("hidden");
        });

        document.addEventListener("click", (e) => {
            if (
                !userDropdown.contains(e.target) &&
                !userMenuBtn.contains(e.target)
            ) {
                userDropdown.classList.add("hidden");
            }
        });

        // 4. التحكم بقائمة المستخدم للموبايل (Mobile User Dropdown)
        const mobileUserMenuBtn = document.getElementById(
            "mobile-user-menu-btn",
        );
        const mobileUserDropdown = document.getElementById(
            "mobile-user-dropdown",
        );
        const mobileArrow = document.getElementById("mobile-arrow");

        mobileUserMenuBtn.addEventListener("click", () => {
            mobileUserDropdown.classList.toggle("hidden");
            mobileArrow.classList.toggle("rotate-180");
        });

        function showToast(message, type = "success") {
            const container = document.getElementById("toast-container");
            if (!container) return;
            const toast = document.createElement("div");
            toast.className = `p-4 rounded-xl text-xs font-bold text-white shadow-lg   transform translate-y-2 opacity-0 flex items-center gap-2 ${
                    type === "success"
                        ? "bg-emerald-600"
                        : type === "error"
                          ? "bg-rose-600"
                          : "bg-amber-500"
                }`;
            toast.innerHTML =
                `<i class="fa-solid ${type === "success" ? "fa-circle-check" : "fa-circle-xmark"}"></i> <span>${message}</span>`;
            container.appendChild(toast);
            setTimeout(
                () => toast.classList.remove("translate-y-2", "opacity-0"),
                10,
            );
            setTimeout(() => {
                toast.classList.add("opacity-0", "translate-y-2");
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }

        // --- 4. منطق المحاكاة والمزامنة الفعلي في صفحة المزامنة ---
        let isOnline = true;
        let pendingCount = 1; // نفترض وجود عملية واحدة معلقة بالصفحة

        function toggleConnection() {
            isOnline = !isOnline;
            const statusBar = document.getElementById("status-bar");
            const statusBadge = document.getElementById("status-badge");
            const badgeText = document.getElementById("badge-text");
            const toggleIcon = document.getElementById("toggle-icon");
            const toggleText = document.getElementById("toggle-text");
            const syncDetails = document.getElementById("status-details");

            if (!statusBar) return;

            if (isOnline) {
                statusBar.className =
                    "w-full bg-white border border-emerald-400 rounded-2xl p-4 flex flex-wrap items-center justify-between gap-4 shadow-sm   dark:bg-slate-900 dark:border-emerald-500/40";
                statusBadge.className =
                    "bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-1.5 rounded-full text-sm font-semibold flex items-center gap-2  dark:bg-emerald-950/30 dark:text-emerald-400 dark:border-emerald-800/50";
                badgeText.innerText = "متصل";
                toggleIcon.className =
                    "fa-solid fa-toggle-off text-orange-500 text-base";
                toggleText.innerText = "محاكاة عدم الاتصال";
                if (syncDetails)
                    syncDetails.innerHTML = `<span class="text-gray-700 dark:text-zinc-200">✓ متزامن</span>`;
                showToast("تم إعادة الاتصال بالخادم بنجاح.", "success");
            } else {
                statusBar.className =
                    "w-full bg-white border border-rose-400 rounded-2xl p-4 flex flex-wrap items-center justify-between gap-4 shadow-sm   dark:bg-slate-900 dark:border-rose-500/40";
                statusBadge.className =
                    "bg-rose-50 text-rose-700 border border-rose-200 px-4 py-1.5 rounded-full text-sm font-semibold flex items-center gap-2  dark:bg-rose-950/30 dark:text-rose-400 dark:border-rose-800/50";
                badgeText.innerText = "غير متصل";
                toggleIcon.className =
                    "fa-solid fa-toggle-on text-emerald-500 text-base";
                toggleText.innerText = "محاكاة الاتصال";
                if (syncDetails)
                    syncDetails.innerHTML = `<span class="text-amber-600 dark:text-amber-400 font-bold">⚠ معلق</span>`;
                showToast(
                    "تم قطع الاتصال محاكاةً. البيانات ستحفظ محلياً.",
                    "error",
                );
            }
        }

        function triggerSync() {
            if (!isOnline) {
                showToast(
                    "فشلت المزامنة! يرجى تفعيل الاتصال بالإنترنت أولاً.",
                    "error",
                );
                return;
            }

            showToast(
                "جاري إرسال البيانات المعلقة وتحديث السجلات...",
                "amber",
            );

            // عمل تأثير تحميل بسيط لمدة ثانية
            setTimeout(() => {
                // 1. تحديث العدادات الرقمية بالصفحة (إذا كانت موجودة)
                const pendingCounterEl =
                    document.getElementById("pending-count"); // استهداف العداد المعلق
                const successCounterEl =
                    document.getElementById("success-count"); // استهداف عداد الناجح

                if (pendingCounterEl) pendingCounterEl.innerText = "0";
                if (successCounterEl) successCounterEl.innerText = "1";

                // 2. تحديث حالة كروت المزامنة (تغيير الأيقونة من ساعة انتظار إلى صح أخضر)
                const syncStatusBadge =
                    document.getElementById("sync-status-badge");
                if (syncStatusBadge) {
                    syncStatusBadge.className =
                        "bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 rounded-full flex items-center gap-1.5 dark:bg-emerald-950/40 dark:text-emerald-400 dark:border-emerald-800/60";
                    syncStatusBadge.innerHTML =
                        `<i class="fa-solid fa-circle-check text-xs"></i> <span>مكتملة</span>`;
                }

                showToast(
                    "تمت المزامنة بنجاح وتحديث كافة البيانات المدرسية!",
                    "success",
                );
            }, 1200);
        }
    </script>
    <script>
        // ==========================================
        // إدارة قائمة الإشعارات المنسدلة
        // ==========================================
        const notifBtn = document.getElementById("notification-btn");
        const notifDropdown = document.getElementById(
            "notification-dropdown",
        );

        if (notifBtn && notifDropdown) {
            // عند الضغط على الجرس: اظهر أو اخفي القائمة
            notifBtn.addEventListener("click", (e) => {
                e.stopPropagation(); // يمنع انتشار الضغطة
                notifDropdown.classList.toggle("hidden");

                // إخفاء قائمة المستخدم إذا كانت مفتوحة لعدم التداخل
                document
                    .getElementById("user-dropdown")
                    ?.classList.add("hidden");
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
    @yield('scripts')
</body>

</html>
