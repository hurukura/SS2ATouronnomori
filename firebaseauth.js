(function(){
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyBOCi7jqiBdBpTG3OT0DriI5K7BB7ktRkQ",
            authDomain: "s192298auth.firebaseapp.com",
            databaseURL: "https://s192298auth.firebaseio.com",
            projectId: "s192298auth",
            storageBucket: "s192298auth.appspot.com",
            messagingSenderId: "465689428961",
            appId: "1:465689428961:web:c3916e42b875ab4f1bc8a0"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
     
    const txtEmail = document.getElementById('txtEmail');
    const txtPassword = document.getElementById('txtPassword');
    const btnLogin = document.getElementById('btnLogin');
    const btnSignUp = document.getElementById('btnSignUp');
    const btnLogout = document.getElementById('btnLogout');

    btnLogin.addEventListener('click', e => {
        const email = txtEmail.value;
        const pass = txtPassword.value;
        const auth = firebase.auth();
        const promise = auth.signInWithEmailAndPassword(email,pass);
        promise.catch(e => console.log(e.message));
        
        window.location.href = 'http://localhost/201020_FirebaseAuthentication/login.html';
        
    });
    
    btnSignUp.addEventListener('click', e => {
        const email = txtEmail.value;
        const pass = txtPassword.value;
        const auth = firebase.auth();
        const promise = auth.createUserWithEmailAndPassword(email,pass);
        promise.catch(e => console.log(e.message));
    });
   
    btnLogout.addEventListener('click', e=>{
       firebase.auth().signOut(); 
    });
    
    firebase.auth().onAuthStateChanged(firbaseUser => {
        if(firbaseUser){
            console.log(firbaseUser);
            btnLogout.classList.remove('hide');
        }else{
            console.log('not logged in');
            btnLogout.classList.add('hide');
        };
    });
}());