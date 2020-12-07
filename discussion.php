<!--
参考資料
https://qiita.com/taketakekaho/items/52b7c196ddbd4cb3c968
-->
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>FireStore Chat</title>
	<style>
		#chatlog {
			width: 100%;
			height: 3000px;
			border: 1px solid gray;
		}

		#uname {
			width: 80px;
			float: left;
			margin-right: 10px;
			padding-top: 5px;
			text-align: center;
		}

		#msg {
			width: 330px;
			height: 30px;
			margin-right: 10px;
			font-size: 12pt;
		}

		#sbmt {
			width: 100px;
			height: 30px;
		}

		#form1 {
			width: 100%;
			display: flex;
			text-align: center;
			position: fixed;
			bottom: 0;
			background-color: gray;
		}

		/* テキストエリア、送信ボタン④ */
		#bms_send {

			display: flex;
			width: 100%;
			/*		background-color: #eee;*/
			/*タイムラインの色と同じにする*/
			/*
		border-right: 1px solid #ddd;
		border-left: 1px solid #ddd;
		border-bottom: 1px solid #ddd;
*/
			height: 48px;
			padding: 4px;
		}

		#bms_send_message {
			width: calc(100% - 125px);
			/*常に送信ボタンの横幅を引いたサイズに動的に計算*/
			line-height: 16px;
			height: 48px;
			padding: 14px 6px 0px 6px;
			/*文字がテキストエリアの中心になる様に隙間調整*/
			border: 1px solid #ccc;
			border-radius: 4px;
			/*角丸*/
			text-align: left;
			/*文字を左寄せ*/
			box-shadow: 2px 2px 4px 0px rgba(0, 0, 0, 0.2) inset;
			/*内側に影を入れてテキストエリアらしくした*/
			box-sizing: border-box;
			/*paddingとborderの要素の高さと幅の影響をなくす（要素に高さと幅を含める）*/

		}

		#bms_send_btn {
			width: 72px;
			height: 48px;
			font-size: 16px;
			line-height: 3em;
			margin-right: 10px;
			float: right;
			/*bms_sendに対して右寄せ*/
			color: #fff;
			font-weight: bold;
			background: #bcbcbc;
			text-align: center;
			/*文字をボタン中央に表示*/
			border: 1px solid #bbb;
			border-radius: 4px;
			/*角丸*/
			box-sizing: border-box;
			/*paddingとborderの要素の高さと幅の影響をなくす（要素に高さと幅を含める）*/
		}

		#bms_send_btn:hover {
			background: #13178E;
			/*マウスポインタを当てた時にアクティブな色になる*/
			cursor: pointer;
			/*マウスポインタを当てた時に、カーソルが指の形になる*/
		}

		#radio {
			width: 100px;
		}

		#your_container {
			/* 高さや幅など、好きな様に設定
    bms_messages_containerの方で、縦横いっぱいに広がってくれるので、
    ここで充てた高さと横幅がそのままスタイルになる仕組み */

			height: 1000px;
			/*ここはご自由に*/
			width: 70%;
			/*ここはご自由に*/
			
		}

		/* タイムライン部分③ */
		#bms_messages {
			overflow: auto;
			/* スクロールを効かせつつ、メッセージがタイムラインの外に出ないようにする */
			height: 100%;
			/*テキストエリアが下に張り付く様にする*/
			border-right: 1px solid #ddd;
			border-left: 1px solid #ddd;
			background-color: #eee;
			box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.2) inset;
			/*ヘッダーの下に影を入れる*/
		}

		/* メッセージ全般のスタイル */
		.bms_message {
			margin: 0px;
			padding: 0 14px;
			/*吹き出しがタイムラインの側面にひっつかない様に隙間を開ける*/
			font-size: 16px;
			word-wrap: break-word;
			/* 吹き出し内で自動で改行 */
			white-space: normal;
			/*指定widthに合わせて、文字を自動的に改行*/
		}

		.bms_message_box {
			margin-top: 20px;
			/*上下の吹き出しがひっつかない様に隙間を入れる*/
			max-width: 100%;
			/*文字が長くなった時に吹き出しがタイムラインからはみ出さない様にする*/
			font-size: 16px;
		}

		.bms_message_content {
			padding: 20px;
			/*文字や画像（コンテンツ）の外側に隙間を入れる*/
		}

		/* メッセージ１（左側） */
		.bms_left {
			float: left;
			/*吹き出しをbms_messagesに対して左寄せ*/
			line-height: 1.3em;
		}

		.bms_left .bms_message_box {
			color: #333;
			/*テキストを黒にする*/
			background: #eee;
			border: 2px solid #13178E;
			border-radius: 30px 30px 30px 0px;
			/*左下だけ尖らせて吹き出し感を出す*/
			margin-right: 50px;
			/*左側の発言だとわかる様に、吹き出し右側に隙間を入れる*/
		}

		/* メッセージ２（右側） */
		.bms_right {
			float: right;
			/*吹き出しをbms_messagesに対して右寄せ*/
			line-height: 1.3em;
		}

		.bms_right .bms_message_box {
			color: #fff;
			/*テキストを白にする*/
			background: #13178E;
			border: 2px solid #13178E;
			border-radius: 30px 30px 0px 30px;
			/*右下だけ尖らせて吹き出し感を出す*/
			margin-left: 50px;
			/*右側の発言だとわかる様に、吹き出し左側に隙間を入れる*/
		}

		/* 回り込みを解除 */
		.bms_clear {
			clear: both;
			/* 左メッセージと右メッセージの回り込み(float)の効果の干渉を防ぐために必要（これが無いと、自分より下のメッセージにfloatが影響する） */

		}
	</style>
</head>

<body>
	<h1>FireStore Chat</h1>

	<!-- 発言が表示される領域 -->
	<!--	<ul id="chatlog"></ul>-->
	<div id="your_container">
		<div id="bms_messages">
		</div>
	</div>

	<!-- 入力フォーム -->
	<form id="form1">
		<div id="uname"></div>
		<div id="bms_send">
			<textarea id="bms_send_message"></textarea>
			<div id="radio">
				<input type="radio" name="flag" value="0">賛成
				<br><input type="radio" name="flag" value="1">反対
			</div>
			<div id="bms_send_btn">送信</div>
		</div>
	</form>

	<!--	以下script	-->
	<script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-firestore.js"></script>
	<script>
		var firebaseConfig = { //	共有アカウント
			apiKey: "AIzaSyCKJKx0gUnD2qBB3cdyk_wZ8bJAwdeqFWw",
			authDomain: "touronnomori.firebaseapp.com",
			databaseURL: "https://touronnomori.firebaseio.com",
			projectId: "touronnomori",
			storageBucket: "touronnomori.appspot.com",
			messagingSenderId: "638781936294",
			appId: "1:638781936294:web:32215a2b2d87370fb5da67",
			measurementId: "G-F5WWPJ82Q4"
		};
		// Initialize Firebase
		firebase.initializeApp(firebaseConfig);
	</script>
	<script>
		//---------------------------------------
		// チャット初期処理
		//---------------------------------------
		// ユーザー名をランダムに決める
		//★ユーザー名を表示させる
		var uname = getUName();
		document.getElementById("uname").innerHTML = uname;

		// テキストボックスにfocus
		// document.getElementById("msg").focus();

		//---------------------------------------
		// Firestoreの準備
		//---------------------------------------
		// Firestoreのインスタンス作成
		var db = firebase.firestore();

		// チャットルームのリファレンス取得
		//				★home.phpで選択したルームIDを	ここ↓		に入れる
		var messagesRef = db.collection("chatroom").doc("room1").collection("messages");

		/**
		 * 同期処理
		 **/
		messagesRef.orderBy("date", "asc").limit(20).onSnapshot((snapshot) => {
			snapshot.docChanges().forEach((change) => {
				// 追加
				if (change.type === 'added') {
					addLog(change.doc.id, change.doc.data());
				}
				// 更新
				else if (change.type === 'modified') {
					modLog(change.doc.id, change.doc.data());
				}
				// 削除
				else if (change.type === 'removed') {
					removeLog(change.doc.id);
				}
			});
		});

		/**
		 * 送信ボタン押下
		 **/
		document.getElementById("bms_send_btn").addEventListener("click", () => {
			let msg = document.getElementById("bms_send_message").value;
			if (msg.length === 0) {
				return (false);
			}
			let flag = document.getElementById("form1").flag.value;
			if (flag.length === 0) {
				console.log(flag);
				return (false);
			}
			// メッセージをfirestoreへ送信
			messagesRef.add({
					name: uname,
					msg: msg,
					flag: flag,
					date: new Date().getTime()
				})
				.then(() => {
					let msg = document.getElementById("bms_send_message");
					msg.focus();
					msg.value = "";
				})
		});
		// submitイベントは（いったん）無視する
		document.getElementById("form1").addEventListener("submit", (e) => {
			e.preventDefault();
		});


		/**
		 * ログに追加
		 */
		function addLog(id, data) {
			// 追加するHTMLを作成
			
			if(data.flag == 0){
				var str = `<div class="bms_message bms_right"><div class="bms_message_box"><div class="bms_message_content"><div class="bms_message_text">${data.name}<br><br>${data.msg} </div></div></div></div><div class="bms_clear"></div>`;
			}else{
				var str = `<div class="bms_message bms_left"><div class="bms_message_box"><div class="bms_message_content"><div class="bms_message_text">${data.name}<br><br>${data.msg} </div></div></div></div><div class="bms_clear"></div>`;
			}
			document.getElementById("bms_messages").innerHTML += str;
		}

		/**
		 * ログを更新
		 */
		function modLog(id, data) {
			let log = document.getElementById(id);
			if (log !== null) {
				log.innerText = `${data.name}: ${data.msg} (${getStrTime(data.date)})`;
				
				if(data.flag == 0){
				var str = `<div class="bms_message bms_right"><div class="bms_message_box"><div class="bms_message_content"><div class="bms_message_text">${data.name}<br><br>${data.msg} </div></div></div></div><div class="bms_clear"></div>`;
			}else{
				var str = `<div class="bms_message bms_left"><div class="bms_message_box"><div class="bms_message_content"><div class="bms_message_text">${data.name}<br><br>${data.msg} </div></div></div></div><div class="bms_clear"></div>`;
			}
			}
		}

		/**
		 * ログを削除
		 **/
		function removeLog(id) {
			let log = document.getElementById(id);
			if (log !== null) {
				log.parentNode.removeChild(log);
			}
		}


		/**
		 * ユーザー名をランダムに決定
		 **/
		function getUName() {
			let master = ["user1", "user2", "user3", "user4", "user5", "user6", "user7", "user8", "user9", "user10"];
			let i = Math.floor(Math.random() * master.length);
			return (master[i]);
		}

		/**
		 * UNIX TIME => MM-DD hh:mm
		 **/
		function getStrTime(time) {
			let t = new Date(time);
			return (
				("0" + (t.getMonth() + 1)).slice(-2) + "-" +
				("0" + t.getDate()).slice(-2) + " " +
				("0" + t.getHours()).slice(-2) + ":" +
				("0" + t.getMinutes()).slice(-2)
			);
		}
	</script>
</body>

</html>