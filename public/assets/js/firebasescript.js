import { initializeApp } from "https://www.gstatic.com/firebasejs/9.8.3/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.8.3/firebase-analytics.js";
import { getDatabase, ref, get, set, onValue, child, remove, push, query, orderByChild, equalTo } from "https://www.gstatic.com/firebasejs/9.8.3/firebase-database.js";
import { ref as sref, getStorage, uploadBytes, uploadBytesResumable, getDownloadURL, deleteObject } from "https://www.gstatic.com/firebasejs/9.8.3/firebase-storage.js";

const firebaseConfig = {
			apiKey: "AIzaSyDETna2MrjHcJOW7vsq3KeMTTJ0hEoTCx8",
			authDomain: "restuarant-cys.firebaseapp.com",
			databaseURL: "https://restuarant-cys-default-rtdb.firebaseio.com",
			projectId: "restuarant-cys",
			storageBucket: "restuarant-cys.appspot.com",
			messagingSenderId: "501773222041",
			appId: "1:501773222041:web:89cf9158f091cb73a87808",
			measurementId: "G-TGKJPCXMGE"
		  };

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const database = getDatabase(app);
const databaseRef=ref(database);
const storage = getStorage();