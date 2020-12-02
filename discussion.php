//討論画面

<!--
参考資料
https://blog.katsubemakito.net/firebase/firestore_realtime_1
-->
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <title>FireStore Chat</title>
            <style>
            #chatlog{ width:500px; height:300px; border:1px solid gray; overflow-y:scroll; }
            #uname{ width:80px; float:left; margin-right:10px; padding-top:5px; text-align:center}
            #msg{ width:330px; height:30px; margin-right:10px; font-size:12pt;}
            #sbmt{ width:100px; height:30px; }
        </style>
</head>
<body>
  <h1>FireStore Chat</h1>

  <!-- 発言が表示される領域 -->
  <ul id="chatlog"></ul>

  <!-- 入力フォーム -->
  <form id="form1">
    <div id="uname"></div>
    <input type="text" id="msg"><button type="button" id="sbmt">送信</button>
  </form>

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
  <script>
    //---------------------------------------
    // チャット初期処理
    //---------------------------------------
    // ユーザー名をランダムに決める
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
    var messagesRef = db.collection("chatroom").doc("room1").collection("messages");

    /**
     * 同期処理
     **/
    messagesRef.orderBy("date", "asc").limit(20).onSnapshot( (snapshot) => {
      snapshot.docChanges().forEach((change) => {
        // 追加
        if ( change.type === 'added' ) {
          addLog(change.doc.id, change.doc.data());
        }
        // 更新
        else if( change.type === 'modified' ){
          modLog(change.doc.id, change.doc.data());
        }
        // 削除
        else if ( change.type === 'removed' ) {
          removeLog(change.doc.id);
        }
      });
    });

    /**
     * 送信ボタン押下
     **/
    document.getElementById("sbmt").addEventListener("click", ()=>{
      let msg = document.getElementById("msg").value;
      if( msg.length === 0 ){
        return(false);
      }
      // メッセージをfirestoreへ送信
      messagesRef.add({
        name: uname,
        msg: msg,
        date: new Date().getTime()
      })
      .then(()=>{
        let msg = document.getElementById("msg");
        msg.focus();
        msg.value = "";
      })
    });
    // submitイベントは（いったん）無視する
    document.getElementById("form1").addEventListener("submit", (e)=>{
      e.preventDefault();
    });


    /**
     * ログに追加
     */
    function addLog(id, data){
      // 追加するHTMLを作成
      let log = `${data.name}: ${data.msg} (${getStrTime(data.date)})`;
      let li  = document.createElement('li');
      li.id   = id;
      li.appendChild(document.createTextNode(log));

      // 表示エリアへ追加
      let chatlog = document.getElementById("chatlog");
      chatlog.insertBefore(li, chatlog.firstChild);
    }

    /**
     * ログを更新
     */
    function modLog(id, data){
      let log = document.getElementById(id);
      if( log !== null ){
        log.innerText = `${data.name}: ${data.msg} (${getStrTime(data.date)})`;
      }
    }

    /**
     * ログを削除
     **/
    function removeLog(id){
      let log = document.getElementById(id);
      if( log !== null ){
        log.parentNode.removeChild(log);
      }
    }


    /**
     * ユーザー名をランダムに決定
     **/
     function getUName(){
      let master = ["user1", "user2", "user3", "user4", "user5", "user6", "user7", "user8", "user9", "user10"];
      let i      = Math.floor( Math.random() * master.length );
      return( master[i] );
    }

    /**
     * UNIX TIME => MM-DD hh:mm
     **/
    function getStrTime(time){
      let t = new Date(time);
      return(
        ("0" + (t.getMonth() + 1)).slice(-2) + "-" +
        ("0" + t.getDate()       ).slice(-2) + " " +
        ("0" + t.getHours()      ).slice(-2) + ":" +
        ("0" + t.getMinutes()    ).slice(-2)
      );
    }
  </script>
</body>
</html>