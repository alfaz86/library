const preLoad = function () {
    return caches.open("offline").then(function (cache) {
        // caching index and important routes
        return cache.addAll(filesToCache);
    });
};

self.addEventListener("install", function (event) {
    event.waitUntil(preLoad());
});

const filesToCache = [
    '/',
    '/offline',
    '/internal-server-error',
    '/images/book.png',
    '/images/no-internet.png',
    '/images/internal-server-error.png',
];

const checkResponse = function (request) {
    return new Promise(function (fulfill, reject) {
        fetch(request).then(function (response) {
            if (response.status !== 404) {
                fulfill(response);
            } else {
                reject();
            }
        }, reject);
    });
};

const addToCache = function (request) {
    // Only cache http(s) requests
    if (!request.url.startsWith('http')) {
        return Promise.resolve();
    }
    return caches.open("offline").then(function (cache) {
        return fetch(request).then(function (response) {
            return cache.put(request, response);
        });
    });
};

self.addEventListener("fetch", function (event) {
    event.respondWith(
        fetch(event.request)
            .then(function (response) {
                return response;
            })
            .catch((error) => {
                if (!navigator.onLine) {
                    return caches.match('/offline');
                } else {
                    return caches.match('/internal-server-error');
                }
            })
    );

    if (!event.request.url.startsWith('http')) {
        event.waitUntil(addToCache(event.request));
    }
});
