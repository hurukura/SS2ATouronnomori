//アカウント情報画面
<?php
session_start();

//データベースとの連携
//アカウントの情報を持ってくる
//ユーザー名、アイコンの画像、性別、年代、過去に参加した討論
$username;
$seibetsu;
$nendai;
$icon;

?>

<head>
<h1>討論の杜</h1>
    <h2>アカウントプロフィール</h2>
</head>

<body>
<img src="" id="icon">
<p id="username">アカウント名</p>
<p id="seibetsu">性別:</p>
<p id="nendai">年代:</p>
    
    <h2>過去に参加した討論</h2>
    
</body>