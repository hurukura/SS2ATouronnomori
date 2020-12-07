<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>討論の杜｜ホーム</title>
    
    <style>
        button{
            display: inline-block;
            border-style: solid;
            background-color: lightgray;
            border-width:1px;
            border-color: darkgray;
            color: black;
            font-size: 1.4em;
            text-align: left;
            -moz-border-radius: 5px;
   　       -webkit-border-radius: 5px;
            border-radius: 5px;

            }
    </style>
    
    <h1><img src="images/touron.png" width="400" height="130"></h1>
    
    <h1>現在行われている討論</h1>
    
    
    <link rel="stylesheet" href="style.css">

</head>
<body>
    

    
   <button class="button1" onclick="touron()"style="width:50%">１．お題：<br>　　参加者：</button><br><br>
        
   <button class="button2" onclick="touron2()" style="width:50%">２．お題：<br>　　参加者：</button><br><br>
    
   <button class="button3" onclick="touron3()" style="width:50%">３．お題：<br>　　参加者：</button><br><br>
    
   <button class="button4" onclick="touron4()" style="width:50%">４．お題：<br>　　参加者：</button><br><br>
    
   <button class="button5" onclick="touron5()" style="width:50%">５．お題：<br>　　参加者：</button><br><br>
    
    <header>
        
        
    </header>
</body>
</html>

<script>

function touron(){
  ret = confirm("ルーム１に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
}
  function touron2(){
  ret = confirm("ルーム２に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
  }

  function touron3(){
  ret = confirm("ルーム３に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
  }
  function touron4(){
  ret = confirm("ルーム４に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
  }
  function touron5(){
  ret = confirm("ルーム５に移動します");
  if (ret == true){
    location.href = "http://localhost/discussion.php";
  }
  }
}

</script>




// ホーム画面

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Room Sample</title>
</head>

<body>

  <h1>討論の杜</h1>
    <h3>現在行われている討論</h3>
  
	<script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-firestore.js"></script>
	<script>
		var firebaseConfig = {
			apiKey: "AIzaSyCceLxC6u7UkH5PNXtP57trfJYU-XB-NS8",
			authDomain: "touronnpmori-sample.firebaseapp.com",
			databaseURL: "https://touronnpmori-sample.firebaseio.com",
			projectId: "touronnpmori-sample",
			storageBucket: "touronnpmori-sample.appspot.com",
			messagingSenderId: "13166144664",
			appId: "1:13166144664:web:6980840758f51f4336f4ed",
			measurementId: "G-6NMEDD12HJ"
		};
		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);
	</script>

	<h1>ルームサンプル</h1>
	<!--	<div id="maintable"></div>-->
	<table id="roomtable" border="1">
		

		<!--FireStoreからルーム情報を取得-->
		<script>
			var db = firebase.firestore();
			var room = [];
			var docRef = db.collection("chatroom");
			docRef.get().then((query) => {
					query.forEach((doc) => {

						var data = doc.data();
						room.push(doc.id);
					});
					console.log(room);


					//以下ルーム一覧表示
					var str = "<tr><th>No.</th><th>お題</th><th>参加人数</th><th>参加/観戦</th></tr>";
					// tr部分のループ
					for (var i = 0; i < room.length; i++) {
						str += "<tr>";
						// th・td部分のループ
						for (var j = 0; j < 4; j++) {
							switch (j) {
								case 0:	//	No.
									str += "<td>";
									str += i + 1;
									str += "</td>";
									break;
								case 1:	//	お題
									str += "<td>";
									str += room[i];
									str += "</td>";
									break;
								case 2:	//	参加人数
									str += "<td>";
									str += j;
									str += "</td>";
									break;
								case 3:	//	参加/観戦
									str += "<td>";
									str += "<input type='button' value='参加' /><input type='button' value='観戦' />";
									str += "</td>";
									break;
							}
						}
						// tr要素をtable要素の子要素に追加
						str += "</tr>";
					}
					// 生成したtable要素を追加する
					document.getElementById('roomtable').innerHTML = str;


				})
				.catch((error) => {
					console.log(`データの取得に失敗しました (${error})`);
				});
		</script>
	</table>
    <a href="">サインアウトする</a>
    <a href="acount_setting">アカウントの設定</a>

</body>
