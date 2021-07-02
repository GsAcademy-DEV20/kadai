// headerのmenuの開閉（ハンバーガーメニュー）
let menuClose = true;
$("#btn-trigger").on("click", function() {

    if (menuClose) {
        document.querySelector('.btn-trigger').classList.add("active");
        $("#navigation-index").css({ 'display': 'block' });
        menuClose = false;
    } else {
        document.querySelector('.btn-trigger').classList.remove("active");
        $("#navigation-index").css({ 'display': 'none' });
        menuClose = true;

    }
});

// ----------------------------------------------------------------
// 画像サムネイル表示
// ----------------------------------------------------------------
// アップロードするファイルを選択
$('input[type=file]').change(function() {
    console.log("file読み込み");
    //選択したファイルを取得し、file変数に格納
    var file = $(this).prop('files')[0];
    //画像以外は処理を停止
    if (!file.type.match('image.*')) {
        //クリア
        $(this).val('');
        $('.cms-thumb>img').html('');
        return;
    }
    //画像表示
    var render = new FileReader();
    render.onload = function() {
        $('.cms-thumb>img').attr('src', render.result);
    }
    render.readAsDataURL(file);
});