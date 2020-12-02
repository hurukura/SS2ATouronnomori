 <!-- ログイン画面 -->
<?php

session_start();
?>

<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Firebase Web Quickstart</title>
        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
             https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
    </head>       
    <body>
	<h1>討論の杜</h1>
	<h2>ログイン</h2>
        <div class="container">
            <input id="txtEmail" type="email" placeholder="Email">
            <input id="txtPassword" type="password" placeholder="Password">
            <button id="btnLogin" class="btn btn-action">
            log in
            </button>
            <button id="btnSignUp" class="btn btn-secondary">
            Sign Up
            </button>
            <button id="btnLogout" class="btn btn-action hide">
            Lod out
            </button>
        </div>
        <script src="./firebaseauth.js"></script>
		<p>アカウントをお持ちでない方は<a href="acount_create.php">コチラ</a></p>
    </body>
</html>


