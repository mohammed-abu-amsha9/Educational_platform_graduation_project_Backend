// تغليف الملف بالكامل لحمايته ومنع تداخل المتغيرات مع أي سكربت آخر
(function () {
    var dbName = "StudentOfflineDB";

    // 1. تهيئة قاعدة البيانات المحلية فوراً
    const request = indexedDB.open(dbName, 1);

    request.onerror = function (event) {
        console.error(
            "خطأ في فتح قاعدة البيانات المحلية:",
            event.target.errorCode,
        );
    };

    request.onsuccess = function (event) {
        // جعل المتغير متاحاً بشكل عام لكل الصفحات ودالة renderSyncPage
        window.localDB = event.target.result;
        console.log("تم تفعيل قاعدة البيانات المحلية بنجاح وهي جاهزة للعمل.");

        if (typeof window.renderSyncPage === "function") {
            window.renderSyncPage();
        }
    };

    request.onupgradeneeded = function (event) {
        let dbInstance = event.target.result;
        if (!dbInstance.objectStoreNames.contains("pending_actions")) {
            dbInstance.createObjectStore("pending_actions", {
                keyPath: "id",
                autoIncrement: true,
            });
        }
        if (!dbInstance.objectStoreNames.contains("sync_logs")) {
            dbInstance.createObjectStore("sync_logs", {
                keyPath: "id",
                autoIncrement: true,
            });
        }
    };

    // 2. دالة فحص الإنترنت الذكية (تدعم المحاكاة والشبكة الحقيقية)
    window.isOnline = function () {
        if (sessionStorage.getItem("simulation_offline") === "true") {
            return false;
        }
        return navigator.onLine;
    };

    // 3. دالة حفظ العمليات محلياً
    window.saveActionLocally = function (type, data) {
        if (!window.localDB) {
            console.error("قاعدة البيانات المحلية غير مهيأة بعد!");
            return;
        }
        const transaction = window.localDB.transaction(
            ["pending_actions"],
            "readwrite",
        );
        const store = transaction.objectStore("pending_actions");

        const action = {
            type: type,
            payload: data,
            created_at: new Date().toISOString(),
            status: "معلقة (في الانتظار)",
        };

        store.add(action);
        console.log("تم حفظ العملية محلياً بنجاح:", action);

        if (typeof window.renderSyncPage === "function") {
            window.renderSyncPage();
        }
    };
})();
