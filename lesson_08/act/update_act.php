<?php
// ----------------------------------------------------------------
// 1. 入力チェック（※画像以外）
// ----------------------------------------------------------------
//部屋タイプ：type
//部屋の名前：name
//鍵のありなし：key_flg
//あいことば：psw

if (!isset($_POST["type"]) || $_POST["type"] == "") {
    exit("ParamError!type!");
}
if (!isset($_POST["name"]) || $_POST["name"] == "") {
    exit("ParamError!name!");
}
if (!isset($_POST["key_flg"]) || $_POST["key_flg"] == "") {
    exit("ParamError!key_flg!");
}


// ----------------------------------------------------------------
// POSTデータ取得
// ----------------------------------------------------------------
$id = $_POST["id"];
$type = $_POST["type"];
$name = $_POST["name"];
$key_flg = $_POST["key_flg"];
$psw = $_POST["psw"];

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
$stmt = $pdo->prepare("UPDATE room_table SET type=:type, name=:name,  key_flg=:key_flg, psw=:psw WHERE id=:id");
//bindValueで値をくっつける
$stmt->bindValue(':type', $type, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':key_flg', $key_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':psw', $psw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {

    $url = "../prepare.php?id=" . $id;
    header("Location:" . $url);

    exit;
}
