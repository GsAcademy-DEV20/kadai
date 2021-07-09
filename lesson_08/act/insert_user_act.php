<?php
// ----------------------------------------------------------------
// 入力チェック
// ----------------------------------------------------------------
// id	：int(12)	ユーザーid
// name	：varchar(64)	ユーザー表示名
// birthday	：date	生年月日
// lid	：varchar(128)	ログインid（メアド）
// lpw	：varchar(64)	ログインパスワード
// kanri_flg	：int(1)	0:一般、1：管理者
// life_flg	：int(1)	0:使用中、1：退会済み
// avatar	：int(12)	アバターid
// thanks	：int(12)	感謝pt
// indate	：datetime	更新日時


if (!isset($_POST["lid"]) || $_POST["lid"] == "") {
    exit("ParamError!lid!");
}
if (!isset($_POST["lpw"]) || $_POST["lpw"] == "") {
    exit("ParamError!lpw!");
}



// ----------------------------------------------------------------
// POSTデータ取得
// ----------------------------------------------------------------

$lid = $_POST["lid"];
$lpw = $_POST["lpw"];


// ----------------------------------------------------------------
// DB接続
// ----------------------------------------------------------------

try {
    //サーバーの情報
    $pdo = new PDO('mysql:dbname=gs_kadai_08;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

// ----------------------------------------------------------------
// データ登録SQL作成
// ----------------------------------------------------------------

$stmt = $pdo->prepare("INSERT INTO user_table(id, name, birthday,  lid, lpw, kanri_flg, life_flg, avatar, thanks,
indate )VALUES(NULL, :name, :birthday, :lid, :lpw, :kanri_flg, :life_flg, :avatar, :thanks, sysdate())");
//bindValueで値をくっつける
$stmt->bindValue(':name', "ななしさん", PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':birthday', "1900-01-01", PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', 0, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', 0, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':avatar', 0, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':thanks', 0, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


// ----------------------------------------------------------------
// データ登録処理後
// ----------------------------------------------------------------

if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} 

// ----------------------------------------------------------------
//   そのままログイン処理
// ----------------------------------------------------------------
//データ登録SQL作成
// ----------------------------------------------------------------
$stmt = $pdo->prepare("SELECT * FROM user_table WHERE lid=:lid AND lpw=:lpw");
$stmt->bindValue(':lid', $lid); //php変数に置き換えてもOK
$stmt->bindValue(':lpw', $lpw);
$res = $stmt->execute();

// ----------------------------------------------------------------
//データ登録処理後
// ----------------------------------------------------------------
if ($res == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
}

// ----------------------------------------------------------------
//抽出データ数を取得
// ----------------------------------------------------------------
$val = $stmt->fetch(); //1レコードだけを取得する

// ----------------------------------------------------------------
//該当レコードがあればSESSIONに値を代入 ※空っぽじゃなければ（認証がオッケーだったときに新しくセッションIDを作る）
// ----------------------------------------------------------------
if ($val["id"] != "") {
    $_SESSION["chk_ssid"]  = session_id(); //ここでログインしているか判断するsessionID
    $_SESSION["user_id"] = $val['id']; //DBに格納されたidという引き出しに入っているデータ
    header("Location:../register.php");
} else {
    //login処理を経由して全画面へ
    header("Location:../login.php");
}
exit();
