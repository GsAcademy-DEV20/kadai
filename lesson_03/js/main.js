//firebaseのデーターベースを使う
const newPostRef = firebase.database().ref();
let myName;
let myChara = 0;
const charaImage = ["chara0.png", "chara1.png", "chara2.png", "chara3.png"];
// ================================================
//  メイン
// ================================================
//  ==入口========================
$("#enter").on("click", function() {
    enter();
});

$(".chara").on("click", function() {
    myChara = $(this).attr("data-image");
    console.log("myChara:" + myChara);
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
        return false; //キー解除
    }
})

$("#username").on("keydown", function(e) {
    console.log(e);
    if (e.keyCode === 13) {
        enter();
        return false; //キー解除
    }
})

// ================================================
//  処理
// ================================================
//  ==入口========================
//入室
function enter() {

    myName = $("#username").val();

    //ローカルストレージに名前を保存
    localStorage.setItem('username', myName);
    localStorage.setItem('chara', myChara);


    //名前をFirebaseに送る
    newPostRef.push({
        username: myName, //名前
        text: "", //テキストエリア
        chara: myChara,
    })

    if (myName !== "") {
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
        chara: 0,
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
    chara = v.chara;

    myName = localStorage.getItem('username');

    console.log("charaImage[chara]" + charaImage[chara]);

    if (username && text) {
        let str = `<img src='img/${charaImage[chara]}'><p>${username}：<br>${text}</p>`;

        // ここでデータをhtmlに埋め込む
        $("#output").prepend(str);

        // 自分の時と相手の時で見た目を変える
        //同じ
        if (username === myName) {
            console.log(document.querySelector('.output p'));
            if (document.querySelector('.output p')) {
                document.querySelector('.output p').classList.add("chat-myMessage");
            }
        } else {
            if (document.querySelector('.output p')) {
                document.querySelector('.output p').classList.add("chat-otherMessage");
            }

        }
    }
})

//送信
function send() {
    //ローカルストレージに保存してある名前をFirebaseに送る
    myName = localStorage.getItem('username');
    myChara = localStorage.getItem('chara');

    newPostRef.push({
        username: myName, //名前
        text: $("#text").val(), //テキストエリア
        chara: myChara,
    })
    $("#text").val(""); //空にする
}


// ========================
//  汎用関数
// ========================