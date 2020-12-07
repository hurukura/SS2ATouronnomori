<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Room Sample</title>
</head>
    <style>
        
        h1{
            text-align: center;
        }
        
        table {
            margin: 5px auto;    /* 上下3px 左右auto */
            padding: 15px;
            border-collapse:separate;
            border-spacing: 0;
        }
        
        th{
            color: #fff;
            background: #008000;
            border-radius: 5px;
            
        
    
    </style>

<body>

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


        //  var firebaseConfig = { // 個人アカウント
        //   apiKey: "AIzaSyCceLxC6u7UkH5PNXtP57trfJYU-XB-NS8",
        //   authDomain: "touronnpmori-sample.firebaseapp.com",
        //   databaseURL: "https://touronnpmori-sample.firebaseio.com",
        //   projectId: "touronnpmori-sample",
        //   storageBucket: "touronnpmori-sample.appspot.com",
        //   messagingSenderId: "13166144664",
        //   appId: "1:13166144664:web:6980840758f51f4336f4ed",
        //   measurementId: "G-6NMEDD12HJ"
        //  };
        //  // Initialize Firebase
        //  firebase.initializeApp(firebaseConfig);
    </script>
    
    <h1><img src="images/touron.png" width="550" height="300"style="display: block; margin: auto;"></h1>
    <h1>現在行われている討論</h1>
    <!-- <div id="maintable"></div>-->
    <table id="roomtable" border="1" width="350" height="200">


        <!--FireStoreからルーム情報を取得-->
        <script>
            
            
            //参加ボタンでトークに参加
            function discussion(id) {
                var a = 1; 
                ret = confirm("ルーム" + id + "に移動します");
                if (ret == true) {
                    location.href = "http://localhost/discussion.php";
                }
            }
            //観戦ボタンでトークを見る
            function participation(id) {
                var a = 1;
                ret = confirm("ルーム" + id + "に移動します");
                if (ret == true) {
                    location.href = "http://localhost/discussion.php";
                }
            }


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
                                case 0: // No.
                                    str += "<td align='center'>";
                                    str += i + 1;
                                    str += "</td>";
                                    break;
                                case 1: // お題
                                    str += "<td align='center'>";
                                    str += room[i]; 
                                    str += "</td>";
                                    break;
                                case 2: // 参加人数
                                    str += "<td align='center'>";
                                    str += j;
                                    str += "</td>";
                                    break;
                                case 3: // 参加/観戦
                                    str += "<td align='center'>";
                                    str += "<input type='button' ' name='button1' onclick='discussion(";
                                    str += i + 1;
                                    str += ")' value='参加' /><input type='button' 'name='button2' onclick='participation(";
                                    str += i + 1;
                                    str += ")' value='観戦' />";
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