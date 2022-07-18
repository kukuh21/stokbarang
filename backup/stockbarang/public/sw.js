// Install service worker
// Fungsi js
self.addEventListener('install', evt => {
  console.log('service worker has been installed');
});

// Activate sercive worker
self.addEventListener('activate', evt => {
  console.log('service worker has been activated');
});

// Fetch even = untuk mengambil file asset yang di akses untuk dijadikan offline
self.addEventListener('fetch', evt => {
  // console.log('fetch event', evt);
});