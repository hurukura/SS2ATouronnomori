//疑似cron（lolipop cron でFireStoreへアクセスできないため日付(Fire Storeのdate)で疑似的に実装）

var LIST = [];
var odaiLIST = [];
var usersLIST = [];
var count;
var str = window.location.href.split('/').pop();
var today = new Date();
var year = String(today.getFullYear()).slice(-2);
var month = String(("0" + (today.getMonth() + 1)).slice(-2));
var day = String(("0" + today.getDate()).slice(-2));
var date = year + month + day;
console.log(date);

console.log(date);
//chatroom/dateの日付が違うときデータ移行&削除
var dateRef = db.collection("chatroom").doc("date");

cron();

function cron() {
	count = 0;
	dateRef.get().then(function (doc) {
		if (doc.exists) {
			if (doc.data()["date"] == date) { //当日
				console.log("On the day");
				if (str == "home.html") {
					displayRoom(); //ルーム表示
				}

			} else { //前日
				screenLock();
				console.log("The day before");
				setDate();
				for (var i = 1; i <= 10; i++) {
					result(i); //データ移行&削除
					moveUsers(i);
					newRoom(i); //ルーム新規作成

				}

				if (str == "home.html") {
					displayRoom(); //ルーム表示
				}
				// ロック画面の削除

			}
		} else {
			console.log("chatroom/dateがありません");
		}
	}).catch(function (error) {
		console.log("chatroom/dateがありません", error);
	});
}



//疑似cron実行用のdate
function setDate() {
	db.collection("chatroom").doc("date").set({
			date: date
		})
		.then(function (doc11) {
			console.log("日付が変わりました");
		})
		.catch(function (error) {
			console.error("Error adding document: ", error);
		});
}

//投稿データ移行(chatroom → result)
function result(i) {
	db.collection("chatroom").doc("room" + i).collection("messages").get().then(function (querySnapshot) {
		var buff = []; //データ削除に必要
		querySnapshot.forEach(function (doc) { //データ移行
			db.collection("results").doc(date + "room" + i).collection("messages").add({
					date: doc.data()["date"],
					flag: doc.data()["flag"],
					id: doc.data()["id"],
					msg: doc.data()["msg"],
					name: doc.data()["name"]
				})
				.then(function (docRef) {
					console.log("Document written with ID: ", docRef.id);
				})
				.catch(function (error) {
					console.error("Error adding document: ", error);
				});
			buff.push(doc.id); //buff[]にmessagesのidを入れる
		});
		LIST = buff;
		console.log("LIST : " + LIST);
		//移行したmessagesを削除
		while (LIST.length != 0) {
			deleteMessages(i, LIST.pop());
		}

	});
}

//messages削除
function deleteMessages(i, list) {
	db.collection("chatroom").doc("room" + i).collection("messages").doc(list).delete().then(function () {
			console.log(list);
			console.log("room" + i + "のmessagesを削除しました");
		})
		.catch((error) => {
			console.log(`room${i}のmessages削除に失敗しました (${error})`);
		});
}
//usersを移行&討論履歴
function moveUsers(i) {
	db.collection("chatroom").doc("room" + i).collection("users").get().then(function (querySnapshot) {
		var buffUsers = []; //データ削除に必要
		querySnapshot.forEach(function (doc) { //データ移行
			db.collection("users").doc(doc.id).update({
					history: firebase.firestore.FieldValue.arrayUnion(date + "room" + i)
				})
				.then(function () {
					console.log("Document successfully written!");
				})
				.catch(function (error) {
					console.error("Error writing document: ", error);
				});
			db.collection("results").doc(date + "room" + i).collection("users").doc(doc.id).set({
					flag: doc.data()["flag"]
				})
				.then(function (docRef) {
					console.log("Document written with ID: ");
				})
				.catch(function (error) {
					console.error("Error adding document: ", error);
				});
			buffUsers.push(doc.id); //buffUsers[]にusersのidを入れる
		});
		usersLIST = buffUsers;
		console.log("usersLIST : " + usersLIST);
		//移行したusersを削除
		while (usersLIST.length != 0) {
			deleteUsers(i, usersLIST.pop());
		}

	});
}
//users削除
function deleteUsers(i, usersList) {
	db.collection("chatroom").doc("room" + i).collection("users").doc(usersList).delete().then(function () {
			console.log(usersList);
			console.log("room" + i + "のusersを削除しました");
		})
		.catch((error) => {
			console.log(`room${i}のmessages削除に失敗しました (${error})`);
		});
}
//roominfoを移行
function newRoom(i) {
	db.collection("chatroom").doc("room" + i).get().then(function (doc) {

		var buffUsers = doc.data()["users"];
		console.log(typeof Object.entries(buffUsers));
		db.collection("results").doc(date + "room" + i).set({
				theme: doc.data()["theme"],
				users: buffUsers
			})
			.then(function (doc) {
				console.log("Document written");
			})
			.catch(function (error) {
				console.error("Error adding document: ", error);
			});
		//移行したroominfoを削除
		deleteRoominfo(i);

	}).catch(function (error) {
		console.log("roominfoがありません", error);
	});

	//新規ルーム作成（新しくroominfoをセット）
	db.collection("odai").get().then(function (querySnapshot) {
		var buff2 = [];
		querySnapshot.forEach(function (doc) {
			buff2.push(doc.id);
		});
		odaiLIST = buff2;
		//新規ルーム作成（新しくroominfoをセット）
		set(i, odaiLIST);
	});
}



//roominfoを削除
function deleteRoominfo(i) {
	db.collection("chatroom").doc("room" + i).delete().then(function () {
			console.log("roominfoを削除しました");
		})
		.catch((error) => {
			console.log(`room${i}のroominfoの削除に失敗しました (${error})`);
		});
}

function set(i, odaiLIST) {
	var kimeta = Math.floor(Math.random() * odaiLIST.length);
	var odaiGet = db.collection("odai").doc(odaiLIST[kimeta]);
	var themeSet = db.collection("chatroom").doc("room" + i);
	var odaistr;

	console.log("odaikimeta" + i + " " + odaiLIST[kimeta]);
	odaiGet.get().then(function (doc) {
		if (doc.exists) {
			console.log("Document data:", doc.data());

			odaistr = doc.id;

			var users = []; //フィールドのusers配列作成用
			console.log(users);
			themeSet.set({
					theme: odaistr,
					users: users
				})
				.then(function () {
					console.log("Document successfully written!");

					count++;
					if (count == 10) {
						delete_dom_obj('screenLock');
						delete_dom_obj('screenLock_text');
						goHome();
					}
				})
				.catch(function (error) {
					console.error("Error writing document: ", error);
				});
		} else {
			// doc.data() will be undefined in this case
			console.log("No such document!");
		}
	}).catch(function (error) {
		console.log("Error getting document:", error);
	});

}

// ロック用関数
function screenLock() {
	// ロック用のdivを生成
	var element = document.createElement('div');
	element.id = "screenLock";
	// ロック用のスタイル
	element.style.height = '100%';
	element.style.left = '0px';
	element.style.position = 'fixed';
	element.style.top = '0px';
	element.style.width = '100%';
	element.style.zIndex = '9999';
	element.style.opacity = '0.5';
	element.style.backgroundColor = '888';
	element.style.textAlign = 'center';

	var test_p = document.createElement("p");
	test_p.id = "screenLock_text";
	// ロック用のスタイル
	test_p.style.height = '100%';
	test_p.style.left = '0px';
	test_p.style.position = 'fixed';
	test_p.style.top = '0px';
	test_p.style.width = '100%';
	test_p.style.textAlign = 'center';
	test_p.style.color = '000';
	// ロック時のテキスト
	const text1 = document.createTextNode("日付変更処理中…");
	test_p.appendChild(text1);

	var objBody = document.getElementsByTagName("body").item(0);
	objBody.appendChild(element);
	objBody.appendChild(test_p);

}

// div削除関数
function delete_dom_obj(id_name) {
	var dom_obj = document.getElementById(id_name);
	var dom_obj_parent = dom_obj.parentNode;
	dom_obj_parent.removeChild(dom_obj);
}

function goHome() {
	
	if (str.slice(0, 15) == "discussion.html") {
		window.alert('日付変更処理が終わりました。結果画面を表示します。');
		location.href = "http://tri-s-web.catfood.jp/touronnomori/discussion_result.html?joind=" + date + str.substr(18);
	} else if (str != "home.html") {
		window.alert('日付変更処理が終わりました。ホーム画面に戻ります。');
		location.href = "http://tri-s-web.catfood.jp/touronnomori/home.html";
	}
}






//開発用　終わったら消す
function cron_run() {
	count = 0;
	dateRef.get().then(function (doc) {
		if (doc.exists) {
			if (doc.data()["date"] != date) { //当日
				console.log("On the day");
				if (str == "home.html") {
					displayRoom(); //ルーム表示
				}
			} else { //前日
				screenLock();
				console.log("The day before");
				setDate();
				for (var i = 1; i <= 10; i++) {
					result(i); //データ移行&削除
					moveUsers(i);
					newRoom(i); //ルーム新規作成

				}
				if (str == "home.html") {
					displayRoom(); //ルーム表示
				}

			}
		} else {
			console.log("chatroom/dateがありません");
		}
	}).catch(function (error) {
		console.log("chatroom/dateがありません", error);
	});
}
