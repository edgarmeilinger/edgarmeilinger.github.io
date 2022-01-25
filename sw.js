const pwachat = "pwachat-v1";
const assets = [
  "/",
  "/fonts/icomoon/demo-files/demo.js",
  "/fonts/icomoon/demo-files/demo.css",
  "/fonts/icomoon/demo.html",
  "/fonts/icomoon/selection.json",
  "/fonts/icomoon/style.css",
  "/images/file/default_file_icon.jpg",
  "/images/file/default-file-icon.jpg",
  "/images/file/default-link-icon.jpg",
  "/images/profile/default-group-icon.jpg",
  "/images/profile/default-profile-icon.jpg",
  "/images/blank-white.jpg",
  "/images/mesibo-bg-white.png",
  "/images/mesibo-logo.png",
  "/images/paper-plane.png",
  "/login/login.css",
  "/login/login.js",
  "/mesibo/calls.js",
  "/mesibo/config.js",
  "/mesibo/files.js",
  "/mesibo/recorder.js",
  "/mesibo/utils.js",
  "/scripts/controller.js",
  "/scripts/mesibo-shared.js",
  "/scripts/mesibo-worker.js",
  "/scripts/nfc.js,"
  "/scripts/ui.js",
  "/styles/messenger.css",
  "/styles/popup.css",
  "/styles/popupdesign.css",
  "/demos.html",
  "/index.html",
  "/messenger.html",
  "/multitab-popup.html",
  "/nfc.html",
  "/popup.html"
  ];

self.addEventListener("install", installEvent => {
  console.log(installEvent);
  installEvent.waitUntil(
    caches
      .open(pwachat)
      .then(cache => {
        cache.addAll(assets);
      })
      .catch(console.log)
  );
});

self.addEventListener("fetch", event => {
  // console.log(event.request);
  event.respondWith(
    caches
      .match(event.request)
      .then(res => {
        return res || fetch(event.request);
      })
      .catch(console.log)
  );
});
