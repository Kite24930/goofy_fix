// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyApdlkvbL5e3GeRiBRcdaQU3VsBpgHWClw",
    authDomain: "goofy-skate-park.firebaseapp.com",
    projectId: "goofy-skate-park",
    storageBucket: "goofy-skate-park.appspot.com",
    messagingSenderId: "686195341158",
    appId: "1:686195341158:web:bd4117a233040d7247faa7",
    measurementId: "G-PQTXKXEEQC"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

export {app, analytics}
