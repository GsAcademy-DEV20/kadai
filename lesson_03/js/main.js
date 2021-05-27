//firebaseのデーターベースを使う
const newPostRef = firebase.database().ref();
let myName;
let myChara = 0;
const charaImage = ["chara0.png", "chara1.png", "chara2.png", "chara3.png"];
//canvas使う
var canvas = document.getElementById("room");
let myCharaX;
let myCharaY;
//時間
const nowDate = new Date()
let hour;
let minutes;
let nowTime;

// ================================================
//  メイン
// ================================================
// ====================
//  入口
// ====================
$("#enter").on("click", function() {
    enter();
});

$(".chara").on("click", function() {
    myChara = $(this).attr("data-image");
    console.log("myChara:" + myChara);

    document.getElementById("selected-avator").src = "img/" + charaImage[myChara];
});
// ====================
//  ボード
// ====================
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
// ====================
//  入口
// ====================
//入室
function enter() {
    //ボードに使う変数を初期化
    myName = $("#username").val();


    // 配列からランダムで値を選択
    const min = 100;
    const max = 700;
    myCharaX = Math.floor(Math.random() * (max + 1 - min)) + min;
    myCharaY = Math.floor(Math.random() * (max + 1 - min)) + min;
    //時間を取得
    nowTime = getNowTime();
    console.log("nowTime" + nowTime);

    //ローカルストレージに保存
    localStorage.setItem('username', myName);
    localStorage.setItem('chara', myChara);
    localStorage.setItem('charaX', myCharaX);
    localStorage.setItem('charaY', myCharaY);

    //Firebaseに送る
    newPostRef.push({
        username: myName, //名前
        text: "＞入室しました", //テキストエリア
        chara: myChara,
        charaX: myCharaX,
        charaY: myCharaY,
        date: nowTime,
    })

    if (myName !== "") {
        //ボードに遷移
        location.href = "bord.html";
    } else {
        alert("名前を入力してください");
    }
}
// ====================
//  ボード
// ====================
// ＊ヘッダー
//クリア（forDebug）
function clear() {
    // データをクリア
    newPostRef.remove();
    //時間は今の時間を取得
    nowTime = getNowTime();
    // 名前だけ入れて再度データ作成
    newPostRef.push({
        username: username, //名前
        text: "", //テキストエリア
        chara: 0,
        charaX: 0,
        charaY: 0,
        date: nowTime,
    })
    location.reload();
}

//  ＊チャット
//受信
function get(data) {
    //Firebaseに保存されたデータを取得
    let v = data.val();
    console.log(v);

    username = v.username;
    text = v.text;
    chara = v.chara;
    date = v.date;

    console.log("charaImage[chara]" + charaImage[chara]);
    debugger;
    if (username && text) {
        //データを埋め込む
        let str = `<img src='img/${charaImage[chara]}'>${date}<p>${username}：<br>${text}</p>`;
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
    charaX = v.charaX;
    charaY = v.charaY;
    console.log(v);
    console.log("charaX:" + charaX);
    console.log("charaY:" + charaY);


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
            charaImgSrc[chara],
            "img/studyroom_desk.png",
        ];
        console.log(imgSrc);
        // 描画順を考慮して描画
        drawOrder(imgSrc, charaX, charaY);
    }
}

//送信
function send() {
    //テキスト以外はローカルストレージに保存してある名前をFirebaseに送る
    myName = localStorage.getItem('username');
    myChara = localStorage.getItem('chara');
    myCharaX = localStorage.getItem('charaX');
    myCharaY = localStorage.getItem('charaY');
    //時間は今の時間を取得
    nowTime = getNowTime();

    newPostRef.push({
        username: myName, //名前
        text: $("#text").val(), //テキストエリア
        chara: myChara,
        charaX: myCharaX,
        charaY: myCharaY,
        date: nowTime,
    })
    $("#text").val(""); //空にする
}

// ================================================
//  汎用関数
// ================================================

//描画順を考慮して描画
function drawOrder(imgSrc, charaX, charaY) {
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
                        if (j === "0") {
                            //キャラ
                            x = charaX;
                            y = charaY;
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

function getNowTime() {
    hour = (nowDate.getHours() >= 10) ? nowDate.getHours() : '0' + nowDate.getHours();
    minutes = (nowDate.getMinutes() >= 10) ? nowDate.getMinutes() : '0' + nowDate.getMinutes();
    nowTime = hour + ':' + minutes;
    console.log(nowTime);
    return nowTime;
}