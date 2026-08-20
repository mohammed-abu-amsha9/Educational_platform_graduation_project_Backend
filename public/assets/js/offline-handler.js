// تغليف الملف بالكامل لحمايته ومنع تداخل المتغيرات مع أي سكربت آخر
(function () {
    var dbName = "StudentOfflineDB"; // اسم قاعدة البيانات المحلية

    // 1. تهيئة قاعدة البيانات المحلية فوراً
    const request = indexedDB.open(dbName, 1); //

    request.onerror = function (event) {
        console.error(
            "خطأ في فتح قاعدة البيانات المحلية:",
            event.target.errorCode, // كود الخطا المتعلق في الخطا
        );
    };

    request.onsuccess = function (event) {
        // جعل المتغير متاحاً بشكل عام لكل الصفحات ودالة renderSyncPage
        window.localDB = event.target.result;
        console.log("تم تفعيل قاعدة البيانات المحلية بنجاح وهي جاهزة للعمل.");

        //
        if (typeof window.renderSyncPage === "function") {
            window.renderSyncPage();
        }
    };

    request.onupgradeneeded = function (event) { // ينفذ عند اول انشاء قاعدة البيانات
        let dbInstance = event.target.result;
        if (!dbInstance.objectStoreNames.contains("pending_actions")) {
            dbInstance.createObjectStore("pending_actions", { // العمليات المعلقة قيد الانتظار
                keyPath: "id",
                autoIncrement: true,
            });
        }
        if (!dbInstance.objectStoreNames.contains("sync_logs")) {
            dbInstance.createObjectStore("sync_logs", { // سجل عمليات المزامنة الناجحة
                keyPath: "id",
                autoIncrement: true,
            });
        }
    };

    // 2. دالة فحص الإنترنت الذكية (تدعم المحاكاة والشبكة الحقيقية)
    window.isOnline = function () {
        if (sessionStorage.getItem("simulation_offline") === "true") { // تفحص النت من الموقع مش من الجهاز
            return false;
        }
        return navigator.onLine; //
    };

    // 3. دالة حفظ العمليات محلياً
    window.saveActionLocally = function (type, data) {
        if (!window.localDB) {
            console.error("قاعدة البيانات المحلية غير مهيأة بعد!");
            return;
        }
        const transaction = window.localDB.transaction( //ويعطيها صلاحية القراءة والكتابة pending_actions على مخزن localDB يفتح جلسة مؤقتة للتعامل مع قاعدة البيانات المحلية
            ["pending_actions"],
            "readwrite", // قراءة وكتابة
        );
        const store = transaction.objectStore("pending_actions"); // بيأخد مخزن البيانات

        const action = { // كائن يجمع معلومات العملية اللي بدنا نحفظها محلياً
            type: type, // النوع
            payload: data, // البيانات
            created_at: new Date().toISOString(), // الوقت
            status: "معلقة (في الانتظار)", // الحالة
        };

        store.add(action); // يضيف سجل جديد إلى مخزن البيانات
        console.log("تم حفظ العملية محلياً بنجاح:", action);

        if (typeof window.renderSyncPage === "function") { // لتحديث صفحة المزامنة بعد الحفظ
            window.renderSyncPage();
        }
    };
})();
