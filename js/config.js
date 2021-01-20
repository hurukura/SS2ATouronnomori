var firebaseConfig = {
  apiKey: "AIzaSyCKJKx0gUnD2qBB3cdyk_wZ8bJAwdeqFWw",
  authDomain: "touronnomori.firebaseapp.com",
  databaseURL: "https://touronnomori.firebaseio.com",
  projectId: "touronnomori",
  storageBucket: "touronnomori.appspot.com",
  messagingSenderId: "638781936294",
  appId: "1:638781936294:web:32215a2b2d87370fb5da67",
  measurementId: "G-F5WWPJ82Q4"
};
// Initialize Firebase

firebase.initializeApp(firebaseConfig);

//----------------------------------------------
// ドメインとポート番号
//----------------------------------------------
let domain = document.domain;
let port = (domain === 'localhost') ? 5000 : 80;
