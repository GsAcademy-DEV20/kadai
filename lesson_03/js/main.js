//firebaseのデーターベースを使う
const newPostRef = firebase.database().ref();
let username;

// ================================================
//  メイン
// ================================================
//  ==入口========================
$("#enter").on("click", function() {
    enter();
});

//  ==ヘッダー====================

$("#clear").on("click", function() {
    clear();
});



//  ==チャット====================
$("#send").on("click", function() {
    send();
});

//キー入力取得
$("#text").on("keydown", function(e) {
    if (e.keyCode === 13) {
        send();
    }
})

$("#username").on("keydown", function(e) {
    console.log(e);
    if (e.keyCode === 13) {
        enter();
    }
})

// ================================================
//  処理
// ================================================
//  ==入口========================
//入室
function enter() {

    username = $("#username").val();

    //ローカルストレージに名前を保存
    localStorage.setItem('username', username);

    //名前をFirebaseに送る
    newPostRef.push({
        username: username, //名前
        text: "", //テキストエリア
    })

    if (username !== "") {
        //ボードに遷移
        location.href = "bord.html";
    } else {
        alert("名前を入力してください");
    }
}

//  ==ヘッダー========================
//クリア
function clear() {

    // データをクリア
    newPostRef.remove();
    // 名前だけ入れて再度データ作成
    newPostRef.push({
        username: username, //名前
        text: "", //テキストエリア
    })
    location.reload();

}

//  ==チャット====================
// 受信
newPostRef.on("child_added", function(data) {
    //ここにFirebaseに保存されたデータを取得
    let v = data.val();
    console.log(v);

    username = v.username;
    text = v.text;

    if (username && text) {
        let str = `<p>${username}<br>${text}</p>`;
        // ここでデータをhtmlに埋め込む
        $("#output").prepend(str);
    }
    console.log(username);

})

//送信
function send() {
    //ローカルストレージに保存してある名前をFirebaseに送る
    var data = localStorage.getItem('username');

    newPostRef.push({
        username: data, //名前
        text: $("#text").val(), //テキストエリア
    })
    console.log(data);
    $("#text").val(""); //空にする
}


// ========================
//  汎用関数
// ========================