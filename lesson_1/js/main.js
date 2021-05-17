/*---------------------
    メイン処理
---------------------*/
var isPlayable;

//起動時処理
$(document).ready(function() {
    Init();
});



//ボタンを押す処理はjsにまとめる（htmlに書くとデバッグしづらくなるため）
$("#init_btn").on("click", function() {
    Init();
});

$("#gu_btn").on("click", function() {
    Janken_btn(1);
});

$("#cho_btn").on("click", function() {
    Janken_btn(2);
});
$("#pa_btn").on("click", function() {
    Janken_btn(3);
});



//初期化
function Init() {
    Change_npc_hand(0);
    Change_npc_face(0);
    Change_call(0);
    Btn_visible(false);
    isPlayable = true;
    confetti.reset();
}

//ボタンの表示非表示
function Btn_visible(visible) {
    //比較は厳密比較で
    if (visible === true) {
        document.getElementById("init_btn").style.visibility = "visible";
        isPlayable = false;
    } else {
        document.getElementById("init_btn").style.visibility = "hidden";
    }
}

// 自分のじゃんけんの手を出す
// 関数名の大文字は共通化
function Janken_btn(pc_hand) {
    if (isPlayable) {
        // 敵のじゃんけんの手を決める
        var npc_hand = Decide_npc_hand();
        console.log("pcHand:" + pc_hand);
        console.log("npcHand:" + npc_hand);
        // じゃんけんの勝敗を判定する
        var result = Judge(pc_hand, npc_hand);
        console.log("result(win: 1, lose: 2, aiko: 3 ):" + result);
        // 勝敗に応じて猫の顔を変える
        Change_npc_face(result);
        Change_call(result);

    }
}


// 敵のじゃんけんの手を決める
//画像のパスはhtmlから見た相対パスを入れる（htmlのsrcを書き換えるため。画像パスはjsからみた相対パスではないので注意）
var npc_hand_pics_src = new Array("", "img/janken_gu.png", "img/janken_choki.png", "img/janken_pa.png");

function Decide_npc_hand() {
    var npc_hand_num = rand(3) + 1;
    Change_npc_hand(npc_hand_num);
    return npc_hand_num;
}
// 敵のじゃんけんの手を変える
function Change_npc_hand(npc_hand_num) {
    document.getElementById("npc_hand").src = npc_hand_pics_src[npc_hand_num];
}

// じゃんけんの勝敗を判定する
function Judge(pcHand, npcHand) {
    var result = { none: 0, win: 1, lose: 2, aiko: 3 };
    switch (pcHand) {
        case 1:
            if (npcHand === 1) rResult = result.aiko;
            else if (npcHand === 2) rResult = result.win;
            else if (npcHand === 3) rResult = result.lose;
            break;
        case 2:
            if (npcHand === 1) rResult = result.lose;
            else if (npcHand === 2) rResult = result.aiko;
            else if (npcHand === 3) rResult = result.win;
            break;
        case 3:
            if (npcHand === 1) rResult = result.win;
            else if (npcHand === 2) rResult = result.lose;
            else if (npcHand === 3) rResult = result.aiko;
            break;
        default:
            rResult = result.none;
            break;
    }
    return rResult;
}

// 勝敗に応じて猫の顔を変える
function Change_npc_face(result_num) {
    var result_pics_src = new Array("img/cat/cat0_smile.png", "img/cat/cat1_cry.png", "img/cat/cat2_laugh.png", "img/cat/cat3_angry.png");
    document.getElementById("npc_face").src = result_pics_src[result_num];
    console.log("npc_face:" + result_num);
}

// コール表示を変える
function Change_call(result_num) {
    var result_call = new Array("手をえらぶニャ", "きみのかち", "ネコのかち", "あいこ");
    document.getElementById("call").textContent = result_call[result_num];
    console.log("result_call:" + result_num);
    if (result_num == 1) {
        //勝ち
        //単一責任の原則にのっとって外に出す
        Hanahubuki();

    } else if (result_num == 2) {
        //負け
        Btn_visible(true);
    }
}


function Hanahubuki() {

    //勝ち
    //紙吹雪演出
    var count = 200;
    var defaults = {
        origin: { y: 0.7 }
    };

    function fire(particleRatio, opts) {
        confetti(Object.assign({}, defaults, opts, {
            particleCount: Math.floor(count * particleRatio)
        }));
    }

    fire(0.25, {
        spread: 26,
        startVelocity: 55,
    });
    fire(0.2, {
        spread: 60,
    });
    fire(0.35, {
        spread: 100,
        decay: 0.91,
        scalar: 0.8
    });
    fire(0.1, {
        spread: 120,
        startVelocity: 25,
        decay: 0.92,
        scalar: 1.2
    });
    fire(0.1, {
        spread: 120,
        startVelocity: 45,
    });
    Btn_visible(true);
}




/*---------------------
    汎用関数
---------------------*/

function rand(n) {
    var num = Math.floor(Math.random() * n);
    return num;
}