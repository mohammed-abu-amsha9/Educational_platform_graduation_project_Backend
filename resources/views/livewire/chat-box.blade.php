<div wire:poll.2s
    class="w-full mt-6 bg-white dark:bg-slate-900 border border-gray-100 hover:border-teal-400 dark:border-slate-800/80 rounded-3xl shadow-md overflow-hidden text-xs mx-auto relative"
    dir="rtl">
    <div class="relative flex min-h-[650px] lg:min-h-[700px]">

        <!-- القائمة الجانبية -->
        <div id="teachersDrawer"
            class="absolute md:static inset-y-0 right-0 z-40 w-72 md:w-80 bg-white dark:bg-slate-900 border-l border-gray-200 dark:border-slate-800 flex flex-col shadow-xl md:shadow-none">
            <div
                class="p-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between bg-gray-50/50 dark:bg-slate-950/20">
                <h3 class="font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                    <i class="fa-solid fa-graduation-cap text-teal-600"></i> مراسلة معلمي المواد
                </h3>
                <button onclick="document.getElementById('teachersDrawer').classList.add('hidden')"
                    class="text-gray-400 hover:text-slate-600 dark:hover:text-zinc-200 p-1 cursor-pointer md:hidden">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
            </div>

            <div class="flex-1 overflow-y-auto divide-y divide-gray-100 dark:divide-slate-800/40">
                <!-- في القائمة الجانبية -->
                <!-- استبدل هذا السطر -->
                @foreach ($usersList as $user)
                    @php
                        // نحتاج لتمييز المستخدم النشط
                        // سنفترض أننا نمرر ID المستخدم المختار في variable إضافي أو نقارنه بالـ roomId
                        $isActive = $recipient && $recipient->id == $user->id;
                    @endphp

                    <div wire:click="selectPerson({{ $user->id }})"
                        class="p-4 flex items-start gap-3 cursor-pointer  border-r-4
                        {{ $isActive
                            ? 'bg-teal-50/40 dark:bg-slate-900/40 border-teal-600'
                            : 'bg-white dark:bg-slate-900 border-transparent hover:bg-gray-50 dark:hover:bg-slate-800/30' }}">

                        <div
                            class="w-8 h-8 rounded-xl bg-teal-600 text-white font-black flex items-center justify-center text-xs shrink-0">
                            {{ mb_substr($user->full_name, 0, 1) }}
                        </div>

                        <div class="flex-1 mt-2 min-w-0 space-y-0.5">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-slate-800 dark:text-zinc-100">
                                    {{ $user->full_name }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- منطقة المحادثة -->
        <div class="flex-1 flex flex-col bg-white dark:bg-slate-900 w-full">
            @if ($roomId && $recipient)
                <!-- Header المحادثة -->
                <div
                    class="p-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between bg-gray-50/30 dark:bg-slate-950/10">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2">
                            <!-- الدائرة التي تحتوي الحرف الأول -->
                            <div
                                class="w-8 h-8 rounded-xl bg-teal-600 text-white font-black flex items-center justify-center text-xs">
                                {{ mb_substr($recipient->full_name ?? 'م', 0, 1) }}
                            </div>

                            <!-- الاسم وحالة الاتصال -->
                            <div>
                                <h4 class="font-bold text-slate-800 dark:text-zinc-100">
                                    {{ $recipient->full_name ?? '...' }}
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- الرسائل -->
                <div class="flex-1 p-5 overflow-y-auto space-y-4">
                    @foreach ($messages as $msg)
                        @php
                            // تحديد من هو المرسل لعرض اسمه وحرفه الأول بشكل صحيح
                            $isMe = $msg->sender_type == $userType;
                        @endphp

                        <div class="flex items-start gap-2.5 {{ $isMe ? 'flex-row-reverse' : '' }}">

                            <!-- الحرف الأول: يظهر حرف المعلم إذا كان المعلم هو المرسل، وحرف الطالب إذا كان الطالب -->
                            <div
                                class="w-8 h-8 rounded-full bg-slate-700 text-white flex items-center justify-center text-xs">
                                {{ mb_substr($isMe ? 'أنا' : $recipient->full_name ?? 'م', 0, 1) }}
                            </div>

                            <!-- الرسالة -->
                            <div
                                class="p-3 rounded-2xl shadow-sm text-sm {{ $isMe ? 'bg-teal-600 text-white' : 'bg-white dark:bg-slate-800 text-slate-800 dark:text-zinc-100' }}">
                                {{ $msg->message_text }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- الإرسال -->
                <div class="p-4 border-t border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900">
                    <form wire:submit.prevent="sendMessage" class="flex items-center gap-2">
                        <input wire:model="messageText" type="text" placeholder="اكتب رسالتك..."
                            class="flex-1 bg-gray-50 dark:bg-slate-950 border border-gray-200 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 text-xs" />
                        <button type="submit"
                            class="bg-teal-600 text-white w-9 h-9 rounded-xl flex items-center justify-center cursor-pointer">
                            <i class="fa-solid fa-paper-plane text-xs"></i>
                        </button>
                    </form>
                </div>
            @else
                <!-- حالة عدم اختيار غرفة -->
                <div class="flex-1 flex flex-col items-center justify-center text-gray-400">
                    <i class="fa-solid fa-comments text-5xl mb-4"></i>
                    <p>اختر معلماً من القائمة لبدء المحادثة</p>
                </div>
            @endif
        </div>
    </div>
</div>
