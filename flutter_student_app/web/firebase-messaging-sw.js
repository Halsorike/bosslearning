importScripts("https://www.gstatic.com/firebasejs/9.10.0/firebase-app-compat.js");
importScripts("https://www.gstatic.com/firebasejs/9.10.0/firebase-messaging-compat.js");

firebase.initializeApp({
  apiKey: "AIzaSyCpb7FV7ftE4RUASyGgoQVoi4I_AAcntcc",
  appId: "1:539033120705:web:10f3b01274c5d641d8c940",
  messagingSenderId: "539033120705",
  projectId: "e-school-saas",
  storageBucket: "e-school-saas.appspot.com",
});

const messaging = firebase.messaging();
