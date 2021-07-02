<?php
// ----------------------------------------------------------------
// 1. 入力チェック（※画像以外）
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


// ----------------------------------------------------------------
// 2. POSTデータ取得（※画像以外）
// ----------------------------------------------------------------
$id = $_POST["id"];
$item = $_POST["item"];
$value = $_POST["value"];
$description = $_POST["description"];

// ----------------------------------------------------------------
// 2. POSTデータ取得（画像）
// ----------------------------------------------------------------
$fname = $_POST["fname_original"];

if (!isset($_FILES["fname"]["name"]) || $_FILES["fname"]["name"] == "") {
    //新しい画像が送られてこなければそのまま使う
} else {
    //新しい画像が送られて来たらそれを使う
    $fname = $_FILES["fname"]["name"];
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
$stmt = $pdo->prepare("UPDATE room_table SET item=:item, value=:value,  fname=:fname, description=:description WHERE id=:id");
//bindValueで値をくっつける
$stmt->bindValue(':item', $item, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':value', $value, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':fname', $fname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':description', $description, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {
    //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
    header("Location: item_list.php");
    exit;
}
