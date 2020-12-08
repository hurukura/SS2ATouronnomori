<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Room Sample</title>
</head>
    <style>
        
        .discussion_table tr:hover td {
	     background-color: #d9efff;
           border-spacing: 8px 0px;
             
         }
        
        body{
            background-image: url(images/background.jfif);
        }
        
        
        h1{
            text-align: center;
            font-family: "Century";
        }
        
        table {
            margin: 5px auto;    /* 上下3px 左右auto */
            padding: 15px;
            border-collapse:separate;
            border-spacing: 0;
             border-radius: 5px;
        }
        
        th{
            color: #fff;
            background: #008000;
            border-radius: 5px;
            padding: 5px;
            
        
        }
        td{
             padding: 20px;
             border-radius: 5px;
             background: white;
        }
        
    
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
    
    <script type="text/javascript"><!--
/*=============================================================
マウスストーカー　
===============================================================*/
(function (){  //

//★ハートの色指定。色を順番に"●",と区切って、いくつでも並べる。最後の]の前には,(カンマ)無し
var cl=["#f0f","#f00","#e0f","#d07","#fff"];
var n=20;           //ハートの数
var msec=100;       //追従速度
var hs=18;          //小さいハートの大きさ。単位px
var wh=10;          //大きなハートの大きさ。原本10
var af=0.5;         //ハートの透過度。原本0.8。0で完全透明なので0は指定しない

/*★↓文字の影指定をCSS形式で記述。見本は赤のボカシ指定。好みで変更可。指定不要ならvar fcss="";で*/
var fcss="text-shadow:0px 0px 10px #f00;";
//指定ここまで----------------------------------------------
function $(id){return document.getElementById(id);}/*document.getElementByIdを簡略化*/
var i=0, xh, yh, mx=[],my=[];
var len=cl.length;//追加

var sss='';
for(i=0;i<n;i++){
var randomCl=cl[Math.floor(Math.random()*len)];//追加

sss +="<span style='position:absolute; z_index:1; top:0;left:0;opacity:"+af+"; font-size:"+hs+"px;color:"+randomCl+"; "+fcss+"'id='Hearts"+i+"'>&hearts;</span>";} /*★&hearts;が特殊文字ハート*/
document.write(sss);
for (i=0; i<=n; i++) {mx[i]=-100; my[i]=-100; }
document.onmousemove= function (e){mx[0]=e.pageX; my[0]=e.pageY;}
function H_run(){
for (i=n-1; i>=0; i--){
if(i){mx[i] = mx[i-1];my[i] = my[i-1];}
if(i<(n/2)){
xh=mx[i]+wh*i*Math.cos(i*2*3.14/n+3.14/2);
yh=my[i]-wh*i*Math.sin(i*2*3.14/n+3.14/2);
}else{
xh=mx[i]+wh*(n-i)*Math.cos(i*2*3.14/n+3.14/2);
yh=my[i]-wh*(n-i)*Math.sin(i*2*3.14/n+3.14/2);
}
$("Hearts"+i).style.top=-(hs*2)+yh+"px"; $("Hearts"+i).style.left=-10+xh+"px";
}
}
setInterval(H_run,msec);
}());//即時関数終了
// --></script>
    
    <h1><img src="images/touron.png" width="550" height="300"style="display: block; margin: auto;"></h1>
    <h1>現在行われている討論</h1>
    <!-- <div id="maintable"></div>-->
    <table class="discussion_table" id="roomtable" border="1" frame="void" width="400" height="250">
        
        


        <!--FireStoreからルーム情報を取得-->
        <script>
             
            
            //参加ボタンでトークに参加
            function discussion(id) {
                var a = 1; 
                ret = confirm("ルーム" + id + "に移動します");
                if (ret == true) {
                    location.href = "http://localhost/discussion.php/?room" + id;
                }
            }
            //観戦ボタンでトークを見る
            function participation(id) {
                var a = 1;
                ret = confirm("ルーム" + id + "に移動します");
                if (ret == true) {
                    location.href = "http://localhost/discussion.php/?room" + id + "par";
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
                                    str += "<input type='button' ' name='chatroom' onclick='discussion(";
                                    str += i + 1;
                                    str += ")' value='参加' /><input type='button' 'name='kansenroom' onclick='participation(";
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