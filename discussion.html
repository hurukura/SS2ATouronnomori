<!--
参考資料
https://qiita.com/taketakekaho/items/52b7c196ddbd4cb3c968
-->
<!DOCTYPE html>
<html>

<head>
 <meta charset="utf-8">
	<link rel="stylesheet" href="css/c_discussion.css">
 <title>FireStore Chat</title>
 
</head>

<body>
 <h1>FireStore Chat</h1>

 <!-- 発言が表示される領域 -->
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

 <!-- 以下script -->
 <script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-app.js"></script>
 <script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-firestore.js"></script>
 <script>
  var firebaseConfig = { // 共有アカウント
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

  var del = location.search.split('&&');
		console.log(del);


		// 要素を取得
		if (del[2] == 'par') {
			let id1 = document.getElementById('form1');
			// 現在の display プロパティの値を保持
			const displayOriginal = id1.style.display;
			// none に設定して非表示
			id1.style.display = 'none';
    }
    
  //---------------------------------------
  // Firestoreの準備
  //---------------------------------------
  // Firestoreのインスタンス作成
  var db = firebase.firestore();

  // チャットルームのリファレンス取得
  //    ★home.phpで選択したルームIDを ここ↓  に入れる
  console.log(del[1]);
	var messagesRef = db.collection("chatroom").doc(del[1]).collection("messages");
     
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

   if(data.name == uname){
    if (data.flag == 0) {
     var str = `<div class="bms_message bms_right bms_mine"><div class="bms_message_box"><div class="bms_message_content"><div class="bms_message_name">${data.name}</div><div class="bms_message_text">${data.msg} </div></div></div></div><div class="bms_clear"></div>`;
    } else {
     var str = `<div class="bms_message bms_left bms_mine"><div class="bms_message_box"><div class="bms_message_content"><div class="bms_message_name">${data.name}</div><div class="bms_message_text">${data.msg} </div></div></div></div><div class="bms_clear"></div>`;
    }
   }else{
    if (data.flag == 0) {
     var str = `<div class="bms_message bms_right"><div class="bms_message_box"><div class="bms_message_content"><div class="bms_message_name">${data.name}</div><div class="bms_message_text">${data.msg} </div></div></div></div><div class="bms_clear"></div>`;
    } else {
     var str = `<div class="bms_message bms_left"><div class="bms_message_box"><div class="bms_message_content"><div class="bms_message_name">${data.name}</div><div class="bms_message_text">${data.msg} </div></div></div></div><div class="bms_clear"></div>`;
    }
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

    if (data.flag == 0) {
     var str = `<div class="bms_message bms_right"><div class="bms_message_box"><div class="bms_message_content"><div class="bms_message_text">${data.name}<br><br>${data.msg} </div></div></div></div><div class="bms_clear"></div>`;
    } else {
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