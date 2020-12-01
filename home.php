// ホーム画面

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Room Sample</title>
</head>

<body>

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
			var docRef = db.collection("chatroom");
			docRef.get().then((query) => {
					var room = [];
					query.forEach((doc) => {
						var data = doc.data();
						room.push([doc.id /*,data.name, data.age*/ ]);
					});
					console.log(room);
				})
				.catch((error) => {
					console.log(`データの取得に失敗しました (${error})`);
				});
		</script>

		<script>
			var room = new Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
				var str = "<tr><th>No.</th><th>お題</th><th>参加人数</th><th>参加/観戦</th></tr>";
					// tr部分のループ
					for (var i = 0; i < room.length; i++) {
						// tr要素を生成
						str += "<tr>";
						// th・td部分のループ
						for (var j = 0; j < 4; j++) {
							switch (j) {
								case 0:
									// td要素を生成
									str += "<td>"; 
									// td要素内にテキストを追加
									str += i;
									// td要素をtr要素の子要素に追加
									str += "</td>";
									break;
								case 1:
									// td要素を生成
									str += "<td>"; 
									// td要素内にテキストを追加
									str += room[i];
									// td要素をtr要素の子要素に追加
									str += "</td>";
									break;
								case 2:
									// td要素を生成
									str += "<td>"; 
									// td要素内にテキストを追加
									str += j;
									// td要素をtr要素の子要素に追加
									str += "</td>";
									break;
								case 3:
									// td要素を生成
									str += "<td>"; 
									// td要素内にテキストを追加
									str += "<input type='button' value='参加' /><input type='button' value='観戦' />";
									// td要素をtr要素の子要素に追加
									str += "</td>";
									break;
							}
						}
						// tr要素をtable要素の子要素に追加
						str += "</tr>";
					}
					// 生成したtable要素を追加する
					document.getElementById('roomtable').innerHTML = str;

		</script>
	</table>
</body>