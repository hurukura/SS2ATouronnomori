var username;
var userid;
firebase.auth().onAuthStateChanged((user) => {
	let logout = document.getElementById("logout");
    
    //「ようこそ！」ってでるやつのやつ。
	var wel = document.getElementById('welcom');
	
	//-----------------------------------
	// ログインチェック
	//-----------------------------------
	if (!user) {
		
		if(wel){
			//welcomがある
			showMessage('Not Login', 'ログインしていません');
			
		}else{
			//welcom がない（infoだけ）
			showMessage_2('ログインしていません');
			
		}
		
		logout.classList.add("hide");
		window.location.href = 'login.html';
		return (false);
	}

	//-----------------------------------
	// ログイン者への処理
	//-----------------------------------
	var nameurl = `<a href='acount_info.html?uid=${user.uid}'>${user.displayName}</a>`;
	username = user.displayName;
	
	// ログインメッセージ
	if(wel){
		//welcomがある''
		showMessage('ようこそ！', `ログイン中 : ${nameurl}さん`);

	}else{
		//welcomがない（infoだけ）
		showMessage_2(`ログイン中 : ${nameurl}さん`);
	}
	
	console.log(user);

	userid = user.uid;
	console.log(userid);

	// ログアウトボタンを表示
	logout.classList.remove("hide");

	// ログアウトボタンを押下
	logout.addEventListener("click", () => {
		firebase.auth().signOut().then(() => {
			console.log("ログアウトしました");

			//アラートを表示
			window.alert('ログアウトしました。またきてね');
			//OKでログイン画面へ遷移
			window.location.href = 'login.html'
		})
			.catch((error) => {
			console.log(`ログアウト時にエラーが発生しました (${error})`);
		});
	});
});
/**
		 * メッセージ表示
		 **/
//welcomがある
function showMessage(title, msg) {
	console.log("welocom有");
	document.querySelector('#welcom').innerText = title;
	document.querySelector('#info').innerHTML = msg;
}
//welcomがない（infoだけ）
function showMessage_2(msg){
	console.log("welocom無");
	document.querySelector('#info').innerHTML = msg;
}

function getUserName(){
	return username;
}
function getUserId(){
	return userid;
}