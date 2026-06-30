<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>منصة صمود التعليمية - تسجيل الدخول</title>
    <link rel="icon" type="image/png" href="{{ secure_asset('assets/img/Logo.png') }}" />
    <link rel="stylesheet" href="{{ secure_asset('assets/css/output.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('assets/fontawesome-free-7.2.0-web/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('assets/css/join_style.css') }}" />
    <style>
        .gradient-panel {
            background: linear-gradient(135deg,
                    #18a792 0%,
                    #067f6d 60%,
                    #045649 100%);
        }

        /* ستايل مخصص للوحة الجراديانت في الوضع الداكن لتصبح أعمق وأجمل */
        .dark .gradient-panel {
            background: linear-gradient(135deg);
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            pointer-events: none;
        }

        @media (max-width: 480px) {
            .gradient-panel h3 {
                font-size: 1.5rem;
            }
        }
    </style>
    <script>
        // كود فحص الثيم المحفوظ مسبقاً لمنع وميض الشاشة البيضاء عند التحميل
        // يعني لما اكون في الموقع والوضع ليلي واعمل تسجيل خروج يبقلى محافظ على الثيم والعكس كذلك
        if (
            localStorage.getItem("theme") === "dark" ||
            (!("theme" in localStorage) &&
                window.matchMedia("(prefers-color-scheme: dark)").matches)
        ) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    </script>
</head>

<body
    class="min-h-screen flex items-center justify-center bg-slate-100 dark:bg-slate-950 p-4 transition-colors duration-200 relative">
    <div class="w-full max-w-5xl bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-transparent dark:border-slate-800/60 overflow-hidden grid md:grid-cols-2 min-h-[640px] transition-colors duration-200"
        dir="ltr">
        <div class="gradient-panel relative text-white p-6 sm:p-8 md:p-12 hidden md:flex flex-col order-2 md:order-2 overflow-hidden min-h-[360px] md:min-h-0 transition-colors duration-200"
            dir="rtl">
            <div class="blob w-72 h-72 -top-20 -right-20"></div>
            <div class="blob w-96 h-96 bottom-0 -left-32"></div>

            <div class="relative z-10 flex items-center mb-10">
                <div class="w-12 h-12 flex items-center justify-center font-extrabold text-xl overflow-hidden p-0.5">
                    <img src="{{asset('assets/img/Logo.png')}}" alt="لوجو منصة صمود"
                        class="w-full h-full object-cover rounded-xl" />
                </div>
                <div class="mx-5">
                    <h2 class="text-xl font-extrabold">منصة صمود</h2>
                    <p class="text-xs text-emerald-100/80">
                        Sumoud Educational Platform
                    </p>
                </div>
            </div>

            <div class="relative z-10 text-right mb-4">
                <h3 class="text-3xl sm:text-3xl font-extrabold leading-tight mb-4">
                    تعلّم بلا انقطاع<br />حتى في أحلك الظروف
                </h3>
                <p class="text-emerald-50/80 text-md leading-relaxed">
                    منصة تعليمية هجينة تجمع بين إدارة المدرسة وبيئة تعلم إلكترونية
                    متكاملة. مصممة خصيصاً للعمل في بيئات الأزمات وضعف الإنترنت.
                </p>
            </div>

            <div class="relative z-10 grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 gap-3 mt-auto"
                dir="rtl">
                <div class="bg-white/10 backdrop-blur rounded-xl p-4 flex items-center justify-start gap-4">
                    <span
                        class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-lg text-white shrink-0">
                        <i class="fa-solid fa-book-open"></i>
                    </span>
                    <div class="text-right">
                        <p class="font-bold text-sm text-white">إدارة كاملة</p>
                        <p class="text-xs text-emerald-100/70">للمدارس والصفوف والطلاب</p>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-xl p-4 flex items-center justify-start gap-4">
                    <span
                        class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-lg text-white shrink-0">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </span>
                    <div class="text-right">
                        <p class="font-bold text-sm text-white">يعمل بلا إنترنت</p>
                        <p class="text-xs text-emerald-100/70">
                            بكفاءة عالية Offline First
                        </p>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-xl p-4 flex items-center justify-start gap-4">
                    <span
                        class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-lg text-white shrink-0">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </span>
                    <div class="text-right">
                        <p class="font-bold text-sm text-white">مزامنة ذكية</p>
                        <p class="text-xs text-emerald-100/70">
                            تلقائية عند توفر الإنترنت
                        </p>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-xl p-4 flex items-center justify-start gap-4">
                    <span
                        class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-lg text-white shrink-0">
                        <i class="fa-solid fa-shield"></i>
                    </span>
                    <div class="text-right">
                        <p class="font-bold text-sm text-white">آمن وموثوق</p>
                        <p class="text-xs text-emerald-100/70">لجميع الطلاب والمعلمين</p>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-xl p-4 flex items-center justify-start gap-4">
                    <span
                        class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-lg text-white shrink-0">
                        <i class="fa-solid fa-chart-simple"></i>
                    </span>
                    <div class="text-right">
                        <p class="font-bold text-sm text-white">تحليلات ذكية</p>
                        <p class="text-xs text-emerald-100/70">لوحة متابعة شاملة</p>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-xl p-4 flex items-center justify-start gap-4">
                    <span
                        class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center text-lg text-white shrink-0">
                        <i class="fa-solid fa-users"></i>
                    </span>
                    <div class="text-right">
                        <p class="font-bold text-sm text-white">تعدد الأدوار</p>
                        <p class="text-xs text-emerald-100/70">مدير - معلم - طالب</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-8 md:p-12 flex flex-col justify-center order-1 md:order-1 bg-white dark:bg-slate-800 transition-colors duration-200"
            dir="rtl">
            <div class="mb-8">
                <h1
                    class="text-3xl font-extrabold text-gray-800 dark:text-zinc-100 flex items-center justify-start gap-2">
                    بالعلم نصمد ونرتقي <span>📚</span>
                </h1>
                <p class="text-gray-400 dark:text-zinc-400 mt-2">
                    سجّل دخولك للمتابعة إلى المنصة
                </p>
            </div>

            <form class="space-y-5" action="{{route('admin_control_panel')}}">
                <div>
                    <label class="block text-md font-bold text-gray-700 dark:text-zinc-300 mb-2">اسم المستخدم</label>
                    <div class="relative">
                        <input type="text" placeholder="أدخل اسم المستخدم"
                            class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-600/40 text-gray-400 dark:text-zinc-400 rounded-xl py-3 pr-4 pl-10 text-right focus:outline-none focus:ring-2 focus:ring-emerald-600 dark:focus:ring-teal-500 focus:border-transparent text-sm transition-colors" />
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-zinc-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div>
                    <label class="block text-md font-bold text-gray-700 dark:text-zinc-300 mb-2">كلمة المرور</label>
                    <div class="relative">
                        <input id="password" type="password" placeholder="........."
                            class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-600/40 text-slate-800 dark:text-zinc-100 rounded-xl py-3 pr-4 pl-10 text-right focus:outline-none focus:ring-2 focus:ring-emerald-600 dark:focus:ring-teal-500 focus:border-transparent text-sm transition-colors" />

                        <button id="toggle-password" type="button"
                            onclick="
                  const input = document.getElementById('password');
                  const icon = document.getElementById('eye-icon');
                  if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'fa-solid fa-eye-slash text-base';
                  } else {
                    input.type = 'password';
                    icon.className = 'fa-solid fa-eye text-base';
                  }
                "
                            class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-zinc-500 hover:text-slate-600 dark:hover:text-zinc-300">
                            <i id="eye-icon" class="fa-solid fa-eye text-base"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-gradient-to-l from-emerald-700 to-teal-600 hover:from-emerald-800 hover:to-teal-700 text-white font-bold py-3 rounded-xl flex items-center justify-center gap-2 transition shadow-lg shadow-emerald-700/20">
                    <span>تسجيل الدخول</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18m0 0l-6-6m6 6l-6 6" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <script>
        // كود تشغيل إظهار وإخفاء كلمة المرور
        // الحصول على العناصر باستخدام الـ id الخاص بها
        const passwordInput = document.getElementById("password");
        const togglePasswordBtn = document.getElementById("toggle-password");
        const eyeIcon = document.getElementById("eye-icon");

        // إضافة حدث الضغط (Click) على الزر
        togglePasswordBtn.addEventListener("click", () => {
            // إذا كانت الكلمة مخفية (password)، نقوم بإظهارها (text)
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                // تغيير الأيقونة إلى العين المشطوبة (مفتوحة/كاشفة)
                eyeIcon.className = "fa-solid fa-eye-slash text-base";
            } else {
                // إذا كانت ظاهرة، نعيد إخفاءها
                passwordInput.type = "password";
                // إعادة الأيقونة إلى العين الطبيعية
                eyeIcon.className = "fa-solid fa-eye text-base";
            }
        });
    </script>
</body>

</html>
