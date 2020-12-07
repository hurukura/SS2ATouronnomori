<html>

<head>
    <meta charset="utf-8">
    <title>討論の杜 | ユーザー設定</title>
</head>

<body>

    <!--    モジュール   -->

    <!--    firebase    -->
    <script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.8.1/firebase-auth.js"></script>
    <!--    firestoe    -->
    <script src="https://www.gstatic.com/firebasejs/6.5.0/firebase-firestore.js"></script>

    <!--    設定読み込み   -->
    <script src="./config.js"></script>

    <!--    モジュールここまで   -->

    <div class="acount_setting">
        <h1>ユーザーの設定</h1>

        <form id="set">

            <p>
                性別<br>
                <input type="radio" name="seibetu_q" value="男性" 　checked>男性<br>
                <input type="radio" name="seibetu_q" value="女性">女性<br>
                <input type="radio" name="seibetu_q" 　value="その他">その他<br>
            </p>

            <br>

            <p>
                年代<br>
                <select name="nendai_q">
                    <option>10代</option>
                    <option>20代</option>
                    <option>30代</option>
                    <option>40代</option>
                    <option>50代</option>
                    <option>60代</option>
                    <option>その他</option>
                </select>
            </p>
            <br>
            <button type="button" id="setting">設定する</button>
        </form>
    </div>

    <a href="home.php">トップページへ</a>
    <h2></h2>
    <form>
        <button type="button" id="logout" class="hide">ログアウト</button>
    </form>

</body>

<script>
    firebase.auth().onAuthStateChanged((user) => {
        let logout = document.getElementById("logout");
        let setting = document.getElementById("setting");

        //-----------------------------------
        // ログインチェック
        //-----------------------------------
        if (!user) {
            showMessage('Not Login', 'ログインしていません');
            logout.classList.add("hide");
            window.location.href = 'login.php';
            return (false);
        }

        //-----------------------------------
        // ログイン者への処理
        //-----------------------------------
        // ログインメッセージ

        console.log(user);

        // ログアウトボタンを表示
        logout.classList.remove("hide");

        // ---------------------------------
        // 設定するボタンを押下
        // ---------------------------------
        setting.addEventListener("click", () => {

            //formを取得
            var form = document.getElementById("set");

            //性別のラジオボタンを取得
            var radioNodeList = form.seibetu_q;
            var a = radioNodeList.value;
            window.console.log(a);
            
            var select = form.nendai_q;
            var b = select.value;
            window.console.log(b);
            

            var result = window.confirm(`${user.displayName}さん、この内容でよろしいですか？`);

            //アラートが「はい」のときの処理
            if (result) {
                db.collection("users").doc(user.uid).set({
                        //　ここにDBへの書き込みコード
                    seibetu: a,

                    })
                    .then(function() {
                        console.log("Document successfully written!");
                    })
                    .catch(function(error) {
                        console.error("Error writing document: ", error);
                    });
            }
        });

        // ------------------------
        // ログアウトボタンを押下
        // ------------------------
        logout.addEventListener("click", () => {
            firebase.auth().signOut().then(() => {
                    console.log("ログアウトしました");

                    //アラートを表示
                    window.alert('ログアウトしました。またきてね');
                    //OKでログイン画面へ遷移
                    window.location.href = 'login.php'
                })
                .catch((error) => {
                    console.log(`ログアウト時にエラーが発生しました (${error})`);
                });
        });
    });
    /**
     * メッセージ表示
     **/
    function showMessage(title, msg) {
        document.querySelector('h2').innerText = title;
        document.querySelector('#info').innerText = msg;
    }

</script>



</html>
