<?php
// ----------------------------------------------------------------
// 1. 入力チェック（※画像以外）
// ----------------------------------------------------------------
//部屋タイプ：type
//部屋の名前：name
//鍵のありなし：key_flg
//あいことば：psw

if (
    !isset($_POST["name"]) || $_POST["name"] == ""  ||
    !isset($_POST["birthday"]) || $_POST["name"] == ""
) {
    exit('ParamError');
}


// ----------------------------------------------------------------
// POSTデータ取得
// ----------------------------------------------------------------
$id = $_POST["id"];
$name = $_POST["name"];
$birthday =  $_POST["birthday"];
$thanks =  0;
var_dump($avatar);


// ----------------------------------------------------------------
// POSTデータ取得（アバター）
// ----------------------------------------------------------------
$avatar  = $_POST["avatar_original"];

if (!isset($_POST["avatar"]) || $_POST["avatar"] == "") {
    //新しい画像が送られてこなければそのまま使う
} else {
    //新しい画像が送られて来たらそれを使う
    $avatar  = $_POST["avatar"];
}




// ----------------------------------------------------------------
// 3. DB接続
// ----------------------------------------------------------------

try {
    //サーバーの情報
    $pdo = new PDO('mysql:dbname=gs_kadai_08;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

// ----------------------------------------------------------------
// 4. データ登録SQL作成
// ----------------------------------------------------------------
$stmt = $pdo->prepare("UPDATE user_table SET name=:name,  birthday=:birthday, avatar=:avatar WHERE id=:id");
//bindValueで値をくっつける
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':avatar', $avatar, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {

    $url = "../top.php";
    header("Location:" . $url);
    exit;
}
