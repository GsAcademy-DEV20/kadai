<?php
// ----------------------------------------------------------------
// 入力チェック
// ----------------------------------------------------------------

if(
    !isset($_POST["name"]) ||$_POST["name"]=="" ||
    !isset($_POST["birthday"]) ||$_POST["name"]=="" ||
    !isset($_POST["avatar"]) ||$_POST["name"]==""
){

    exit('ParamError');
}

// ----------------------------------------------------------------
//  ユーザーデータ取得
// ----------------------------------------------------------------
$name = $_POST["name"];
$birthday =  $_POST["birthday"];
$avatar =  $_POST["avatar"];
$thanks =  0;
var_dump($avatar);


// ----------------------------------------------------------------
// DB接続
// ----------------------------------------------------------------
try {
    $pdo = new PDO('mysql:dbname=gs_kadai_08;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

// ----------------------------------------------------------------
//データ登録SQL作成 //ここにカラム名を入力する
// ----------------------------------------------------------------
$stmt = $pdo->prepare("INSERT INTO user_table(id, name, birthday, avatar, thanks, 
indate )VALUES(NULL, :name, :birthday, :avatar, :thanks, sysdate())");
//bindValueで値をくっつける
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':birthday', $birthday, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':avatar', $avatar, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':thanks', $thanks, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {
    //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
    header("Location: select.php");
    exit;
}
