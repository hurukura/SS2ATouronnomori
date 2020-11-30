// ログイン画面
<?php

session_start();

$error_message = "";

if(isset($_POST["login"])) {

	if($_POST["user_name"] == "webtan" && $_POST["password"] == "webtan_pass") {
		$_SESSION["user_name"] = $_POST["user_name"];
		$login_success_url = "login_success.php";
		header("Location: {$login_success_url}");
		exit;
	}
$error_message = "※ID、もしくはパスワードが間違っています。<br>　もう一度入力して下さい。";
}

?>

<head>
<meta charset="UTF-8">
    <h1>討論の杜</h1>
</head>
<body>
<h2>ログイン</h2>
<!--   ここにログイン機能-->



<p>アカウントをお持ちでない方は<a href="acount_create.php">コチラ</a></p>
</body>
