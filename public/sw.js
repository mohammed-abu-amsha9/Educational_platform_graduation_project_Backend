const CACHE_NAME = "materials-cache-v1";

// سنكتفي بصفحة المواد والصفحة الاحتياطية لضمان عمل الكاش فوراً
const urlsToCache = ["/materials", "/offline.html"];

// 1. مرحلة التثبيت المرنة
self.addEventListener("install", (event) => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log("جاري تخزين الملفات المتاحة...");
            return Promise.all(
                urlsToCache.map((url) => {
                    return cache
                        .add(url)
                        .catch((err) =>
                            console.warn(`تنبيه: تعذر كشّ ${url} حالياً.`),
                        );
                }),
            );
        }),
    );
});

// التنشيط الفوري
self.addEventListener("activate", (event) => {
    event.waitUntil(self.clients.claim());
});

// 2. مرحلة جلب البيانات أوفلاين
// مرحلة جلب البيانات أوفلاين (المحدثة لتصفية طلبات الـ Extensions)
self.addEventListener("fetch", (event) => {
    // 1. نطبق الكاش فقط على طلبات القراءة (GET)
    if (event.request.method !== "GET") return;

    // 2. [الحل الحاسم]: تجاهل أي طلبات قادمة من إضافات كروم أو بروتوكولات خارجية
    if (
        !event.request.url.startsWith("http://") &&
        !event.request.url.startsWith("https://")
    ) {
        return;
    }

    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            if (cachedResponse) {
                return cachedResponse;
            }

            return fetch(event.request)
                .then((networkResponse) => {
                    if (networkResponse && networkResponse.status === 200) {
                        let responseToCache = networkResponse.clone();
                        caches.open(CACHE_NAME).then((cache) => {
                            cache.put(event.request, responseToCache);
                        });
                    }
                    return networkResponse;
                })
                .catch(() => {
                    return caches.match("/offline.html");
                });
        }),
    );
});
