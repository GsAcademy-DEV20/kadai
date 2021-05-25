//firebaseのデーターベースを使う
const newPostRef = firebase.database().ref();
let myName;
let myChara = 0;
const charaImage = ["chara0.png", "chara1.png", "chara2.png", "chara3.png"];
// ================================================
//  メイン
// ================================================
var canvas = document.getElementById("room");


//  入口
$("#enter").on("click", function() {
    enter();
});

$(".chara").on("click", function() {
    myChara = $(this).attr("data-image");
    console.log("myChara:" + myChara);

    document.getElementById("selected-avator").src = "img/" + charaImage[myChara];

});


//  ボード
newPostRef.on("child_added", function(data) {
    get(data);
    draw(data);
});


//  ヘッダー
$("#clear").on("click", function() {
    clear();
});


// チャット
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
        text: "＞入室しました", //テキストエリア
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

//受信
function get(data) {
    //Firebaseに保存されたデータを取得
    let v = data.val();
    console.log(v);

    username = v.username;
    text = v.text;
    chara = v.chara;


    console.log("charaImage[chara]" + charaImage[chara]);

    if (username && text) {
        //データを埋め込む
        let str = `<img src='img/${charaImage[chara]}'><p>${username}：<br>${text}</p>`;
        $("#output").prepend(str);

        //自分の時と相手の時で見た目を変える
        //表示するメッセージの名前とローカルサーバの自分の名前を比較
        myName = localStorage.getItem('username');

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
}

function draw(data) {
    //Firebaseに保存されたデータを取得
    let v = data.val();
    chara = v.chara;

    if (username && text) {
        //データを埋め込む
        // 画像リソース
        var charaImgSrc = [
            "img/chara0.png",
            "img/chara1.png",
            "img/chara2.png",
            "img/chara3.png",
        ];

        var imgSrc = [
            "img/studyroom_bg.png",
            charaImgSrc[chara],
            "img/studyroom_desk.png",
        ];

        // Canvas準備
        drawOrder(imgSrc);
    }

}


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

//描画
function drawOrder() {


    if (canvas) {


        var ctx = canvas.getContext("2d");

        //描画順整えるため読み込んでから描画する
        var images = [];
        for (var i in imgSrc) {
            images[i] = new Image();
            images[i].src = imgSrc[i];
        }
        console.log(images);

        var loadedCount = 1;
        for (var i in images) {
            images[i].addEventListener('load', function() {
                //全部画像を読み込んだら
                if (loadedCount == images.length) {
                    var x;
                    var y;
                    for (var j in images) {

                        if (j === "1") {
                            //キャラ
                            x = Math.random() * 900;
                            y = Math.random() * 700;
                            ctx.drawImage(images[j], x, y, 48, 96);
                        } else {
                            //ステージ
                            x = 0;
                            y = 0;
                            ctx.drawImage(images[j], x, y, 960, 720);
                        }
                    }
                }
                loadedCount++;
            }, false);
        }
    }
}