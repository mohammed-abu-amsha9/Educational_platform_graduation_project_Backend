const CACHE_NAME = "sumoud-cache-v2";

// الملفات الثابتة فقط
const STATIC_ASSETS = [
    "/offline.html",
];

// ======================
// Install
// ======================
self.addEventListener("install", (event) => {
    self.skipWaiting();

    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(STATIC_ASSETS);
        })
    );
});

// ======================
// Activate
// ======================
self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(
                keys.map((key) => {
                    if (key !== CACHE_NAME) {
                        return caches.delete(key);
                    }
                })
            );
        })
    );

    self.clients.claim();
});

// ======================
// Fetch
// ======================
self.addEventListener("fetch", (event) => {

    // نتعامل فقط مع GET
    if (event.request.method !== "GET") return;

    // تجاهل أي بروتوكول غير http/https
    if (!event.request.url.startsWith("http")) return;

    const url = new URL(event.request.url);

    // ======================
    // صفحات لا يتم عمل Cache لها إطلاقاً
    // ======================
    if (
        url.pathname.startsWith("/login") ||
        url.pathname.startsWith("/logout") ||
        url.pathname.startsWith("/admin") ||
        url.pathname.startsWith("/teacher") ||
        url.pathname.startsWith("/register") ||
        url.pathname.startsWith("/password") ||
        url.pathname.startsWith("/sanctum") ||
        url.pathname.startsWith("/csrf")
    ) {
        return;
    }

    // ======================
    // الملفات الثابتة فقط
    // ======================
    if (
        event.request.destination === "style" ||
        event.request.destination === "script" ||
        event.request.destination === "image" ||
        event.request.destination === "font"
    ) {

        event.respondWith(
            caches.match(event.request).then((response) => {

                if (response) {
                    return response;
                }

                return fetch(event.request).then((networkResponse) => {

                    if (networkResponse.ok) {
                        const clone = networkResponse.clone();

                        caches.open(CACHE_NAME).then((cache) => {
                            cache.put(event.request, clone);
                        });
                    }

                    return networkResponse;
                });

            })
        );

        return;
    }

    // ======================
    // صفحة المواد فقط (Network First)
    // ======================
    if (url.pathname.startsWith("/materials")) {

        event.respondWith(

            fetch(event.request)

                .then((networkResponse) => {

                    const clone = networkResponse.clone();

                    caches.open(CACHE_NAME).then((cache) => {
                        cache.put(event.request, clone);
                    });

                    return networkResponse;

                })

                .catch(() => {

                    return caches.match(event.request)
                        .then((cached) => {
                            return cached || caches.match("/offline.html");
                        });

                })

        );

    }

});
