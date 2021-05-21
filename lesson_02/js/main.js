let sec;
let min;
let hour;
let timer;

let countable;

//-------------------------
//  メイン
//-------------------------
//起動時処理
$(document).ready(function() {
    initForm();
    initTimer();
    setToday();
    load();
});

// STARTボタン
$("#button-start").on("click", function() {
    if (countable) {
        timerStart();
        //ボタンの見た目
        document.getElementById("image-start").src = "img/button-start_off.png";
        document.getElementById("image-stop").src = "img/button-stop.png";

    }
});

// STOPボタン
$("#button-stop").on("click", function() {
    if (!countable) {
        timerStop();
        //ボタンの見た目
        document.getElementById("image-start").src = "img/button-start.png";
        document.getElementById("image-stop").src = "img/button-stop_off.png";
    }
});

// SAVEボタン
$("#button-save").on("click", function() {
    const date = $("#date").val();
    const timer = $("#timer").html();
    const text = $("#text").val();
    const key = date + timer + text;
    save(date, timer, text, key);
    //ボタンの見た目
    document.getElementById("image-start").src = "img/button-start.png";
    document.getElementById("image-stop").src = "img/button-stop.png";
});

// 削除ボタン
$("#list").on("click", "#button-erase", function() {
    let key = this.title;
    localStorage.removeItem(key);
    load();
});

// 編集ボタン
$("#list").on("click", "#button-edit", function() {
    openModal();
    let key = this.title;
    edit(key);
});


// 編集保存
$(document).on("click", "#edit-save", function() {
    let key = this.title;
    const localStorageData = JSON.parse(localStorage.getItem(key));
    const date = $("#edit-date").val();
    const timer = localStorageData.timer;
    const text = $("#edit-text").val();

    save(date, timer, text, key);
    closeModal();
    load();

});

// 編集モーダルを閉じる
$('.js-close , #overlay').click(function() {
    closeModal();
});

//-------------------------
//  関数
//-------------------------
//初期化処理
//  00:00:00から開始
function initTimer() {
    sec = 0;
    min = 0;
    hour = 0;
    countable = true;
    $("#timer").html("00:00:00");

}
//  フォームは空に
function initForm() {

    var textForm = document.getElementById("text");
    textForm.value = '';
}

//タイマー開始
function timerStart() {
    initTimer();
    timer = setInterval(countup, 1000);
    countable = false;
}

//タイマー停止
function timerStop() {
    clearInterval(timer);
    countable = true;
}

//セーブ
function save(date, timer, text, key) {

    if (countable) {
        if (key && timer) {
            //オブジェクトの配列としてJSONデータを用意
            var valueObj = {
                date: date,
                timer: timer,
                text: text,
            };

            //オブジェクトデータをJSON（文字列データ）に変換する
            var json = JSON.stringify(valueObj);
            //JSONデータをローカルストレージに保存する（key（箱）ごとにjson（箱の中身）を保存）
            const json_text = localStorage.setItem(key, json);

            //テンプレートリテラル
            const html = `
            <tr>
                <th>${date}</th>
                <td align=left>${timer}</td>
                <td >${text}</td>
                <td align=right><button type="button" id="button-erase" title=${key}>削除</button>
                <button type="button" id="button-edit" title=${key}>変更</button></td>
            </tr>
            `;

            //const htmlをappendで埋め込み
            $("#list").append(html);

            //初期化
            initTimer();
            initForm();

        } else {
            alert("日付を入力してね");
        }
    } else {
        alert("時間をとめてね");
    }
}


//ロード
function load() {

    $("#list").empty();

    for (let i = 0; i < localStorage.length; i++) {
        //localstorageのkeyを取得
        const key = localStorage.key(i);

        // JSONデータをオブジェクト化する
        const localStorageData = JSON.parse(localStorage.getItem(key));

        // オブジェクトのデータを変数に入れる
        const date = localStorageData.date;
        const text = localStorageData.text;
        const timer = localStorageData.timer;

        //テンプレートリテラルで埋め込み
        const html = `
            <tr>
                <th>${date}</th>
                <td align=left>${timer}</td>
                <td >${text}</td>
                <td align=right><button type="button" id="button-erase" title=${key}>削除</button>
                <button type="button" id="button-edit" title=${key}>変更</button></td>
            </tr>
            `;

        $("#list").prepend(html);
    }
}


//編集
function edit(key) {

    // JSONデータをオブジェクト化する
    const localStorageData = JSON.parse(localStorage.getItem(key));

    // オブジェクトのデータを変数に入れる
    const date = localStorageData.date;
    const text = localStorageData.text;

    // 編集用のフォームに編集前のデータをいれる
    document.getElementById("edit-date").value = date;
    document.getElementById("edit-text").value = text;

    //テンプレートリテラルで埋め込み
    const html = `
     <button class="button-close" id="edit-save" title=${key}>SAVE</button>
     `;

    $("#edit-list").append(html);


}



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
    sec_number = ("0" + sec).slice(-2);
    min_number = ("0" + min).slice(-2);
    hour_number = ("0" + hour).slice(-2);

    $("#timer").html(hour_number + ":" + min_number + ":" + sec_number);
}

//今日の日付を取得する
function setToday() {
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth() + 1;
    const day = date.getDate();

    const toTwoDigits = function(num, digit) {
        num += "";
        if (num.length < digit) {
            num = "0" + num;
        }
        return num;
    };

    const yyyy = toTwoDigits(year, 4);
    const mm = toTwoDigits(month, 2);
    const dd = toTwoDigits(day, 2);
    const ymd = yyyy + "-" + mm + "-" + dd;

    document.getElementById("date").value = ymd;
}

//モーダルウィンドウ
function openModal() {
    $('#overlay, .modal-window').fadeIn();
    $("body").addClass("no_scroll");
}

function closeModal() {
    $("body").removeClass("no_scroll");
    $('#overlay, .modal-window').fadeOut();
}