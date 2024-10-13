import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";

const firebaseConfig = {
    apiKey: "AIzaSyAB_I7doubocT-utA3J1NXXgazi78JKrDY",
    authDomain: "product-catalog-humic.firebaseapp.com",
    projectId: "product-catalog-humic",
    storageBucket: "product-catalog-humic.appspot.com",
    messagingSenderId: "58277553386",
    appId: "1:58277553386:web:bbec13e42186f04a1c2393",
    measurementId: "G-LW02YZKBHJ"
};

const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
