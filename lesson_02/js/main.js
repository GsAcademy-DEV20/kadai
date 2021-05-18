let sec;
let min;
let hour;
let timer;

let countable;

//-------------------------
//  メイン
//-------------------------

$(document).ready(function() {
    init();
});

// スタートボタン
$("#button-start").on("click", function() {
    if (countable) {
        timerStart();
    }
});
// 停止ボタン
$("#button-stop").on("click", function() {
    if (!countable) {
        timerStop();
    }
});
// セーブボタン
$("#button-save").on("click", function() {
    timerSave();
});

// 消去ボタン
$("#button-erase").on("click", function() {
    console.log("erase");
});

//-------------------------
//  関数
//-------------------------


//初期化処理
function init() {
    // 00:00:00から開始
    sec = 0;
    min = 0;
    hour = 0;
    countable = true;
    $('#timer').html('00:00:00');
    //日付は今日の日付
    setToday();
}

for (let i = 0; i < localStorage.length; i++) {
    //keyの0番目は[test]というデータの塊のことなのでそのkeyをもとにlocalStorage.getItem()
    //を使って取得している
    const key = localStorage.key(i);
    const value = localStorage.getItem(key);

    const html = `
    <tr>
        <th>${key}</th>
        <td align=left>${value}</td>
        <td align=right><button type="button" id="button-erase">削除</button>
        <button type="button">変更</button></td>
     </tr>
    `
    $("#list").append(html);

}


//タイマー開始
function timerStart() {
    console.log("start");
    init();
    timer = setInterval(countup, 1000);
    countable = false;
};

//タイマー停止
function timerStop() {
    console.log("stop");
    // 一時停止
    clearInterval(timer);
    countable = true;
};

//セーブ
function timerSave() {
    const key = $("#date").val();
    const value = $("#timer").html();

    if (countable) {
        if (key && value) {

            localStorage.setItem(key, value);
            //テンプレートリテラル
            const html = `
            <tr>
                <th>${key}</th>
                <td align=left>${value}</td>
                <td align=right><button type="button" id="button-erase">削除</button>
                <button type="button">変更</button></td>
             </tr>
            `

            //const html という変数をjqueryのおまじないを使って埋める
            $("#list").append(html);

            //初期化
            init();

        } else {
            alert("日付を入力してね");
        }
    } else {
        alert("時間をとめてね");
    }

};


//-------------------------
//  汎用関数
//-------------------------

//カウントアップ
function countup() {
    sec += 1;

    if (sec > 59) {
        sec = 0;
        min += 1;
    }

    if (min > 59) {
        min = 0;
        hour += 1;
    }

    // 0埋め
    sec_number = ('0' + sec).slice(-2);
    min_number = ('0' + min).slice(-2);
    hour_number = ('0' + hour).slice(-2);

    $('#timer').html(hour_number + ':' + min_number + ':' + sec_number);
}


//今日の日付を取得する
function setToday() {
    const date = new Date()
    const year = date.getFullYear()
    const month = date.getMonth() + 1
    const day = date.getDate()

    const toTwoDigits = function(num, digit) {
        num += ''
        if (num.length < digit) {
            num = '0' + num
        }
        return num
    }

    const yyyy = toTwoDigits(year, 4)
    const mm = toTwoDigits(month, 2)
    const dd = toTwoDigits(day, 2)
    const ymd = yyyy + "-" + mm + "-" + dd;

    document.getElementById("date").value = ymd;
}