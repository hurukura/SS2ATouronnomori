
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