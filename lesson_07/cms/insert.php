<?php
// ----------------------------------------------------------------
// 1. 入力チェック
// ----------------------------------------------------------------
//商品名 受信チェック:item
//金額 受信チェック:value
//商品紹介文 受信チェック:description
//ファイル受信チェック※S_FILES["*"]["name"]の場合

if (!isset($_POST["item"]) || $_POST["item"] == "") {
    exit("ParamError!item!");
}
if (!isset($_POST["value"]) || $_POST["value"] == "") {
    exit("ParamError!value!");
}
if (!isset($_POST["description"]) || $_POST["description"] == "") {
    exit("ParamError!description!");
}
if (!isset($_FILES["fname"]["name"]) || $_FILES["fname"]["name"] == "") {
    exit("ParamError!Files!");
}


// ----------------------------------------------------------------
// 2. POSTデータ取得
// ----------------------------------------------------------------

$fname = $_FILES["fname"]["name"];
$item = $_POST["item"];
$value = $_POST["value"];
$description = $_POST["description"];

//FileUpload処理
$upload = "../img/"; //画像アップロードフォルダへのパス
//アップロードした画像を../img/へ移動させる記述
if (move_uploaded_file($_FILES['fname']['tmp_name'], $upload . $fname)) {
    //FileUpload:OK
} else {
    //FileUpload:NG
    echo "Upload failed";
    echo $_FILES['fname']['error'];
}

// ----------------------------------------------------------------
// 3. DB接続
// ----------------------------------------------------------------

try {
    //サーバーの情報
    $pdo = new PDO('mysql:dbname=gs_kadai_07;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

// ----------------------------------------------------------------
// 4. データ登録SQL作成
// ----------------------------------------------------------------
$stmt = $pdo->prepare("INSERT INTO room_table(id, item, value,  fname, description,
indate )VALUES(NULL, :item, :value, :fname, :description, sysdate())");
//bindValueで値をくっつける
$stmt->bindValue(':item', $item, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':value', $value, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':fname', $fname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':description', $description, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


// ----------------------------------------------------------------
// 5. データ登録処理後
// ----------------------------------------------------------------
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {
    //５．Location: in この:　のあとは半角スペースがいるので注意！！
    header("Location: item.php");
    exit;
}
