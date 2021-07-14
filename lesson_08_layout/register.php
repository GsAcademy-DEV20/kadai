<?PHP
session_start();

include("./act/funcs.php");
loginCheck();

// ----------------------------------------------------------------
// GETを使って送られたUseridを取得
// ----------------------------------------------------------------
$id = $_SESSION["user_id"];
echo $id;

// ----------------------------------------------------------------
// DB接続
// ----------------------------------------------------------------
$pdo = dbConnect();

// ----------------------------------------------------------------
// データ抽出SQL作成
// ----------------------------------------------------------------

$sql = "SELECT * FROM user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //idは数値なのでINT
$status = $stmt->execute();


// ----------------------------------------------------------------
// データ出力
// ----------------------------------------------------------------

if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    //１データのみ抽出の場合はwhileループで取り出さない(一個しかデータが返ってこないので一レコード取得する)
    $row = $stmt->fetch();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アカウント</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="cms">

    <header class="header">
        <nav class="navigation" id="navigation">
            <ul class="nav-list">
                <li class="nav-item site-title"><a href="./top.php">waninaro</a></li>
                <li class="nav-item site-title"><a href="./act/logout_act.php">ログアウト</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-container">

        <div class="wrapper wrapper-cms">
            <form action="./act/update_account_act.php" method="post" class="flex-parent cartin-area cms-area" enctype="multipart/form-data">
                <p class="cms-thumb"></p>
                <!--アバター-->
                <div class="avatar-container">
                    <div>Avator</div>
                    <div><img id="selected-avatar" src="img/chara/chara<?= $row["avatar"] ?>.png" alt=""></div>
                    <div>
                        <ul class="select-avatar-list">
                            <li>
                                <input id="chara0" type="radio" value="0" name="avatar">
                                <label for="chara0">
                                    <img class="chara" data-image="0" src="img/chara/chara0.png" alt="">
                                </label>
                            </li>
                            <li>
                                <input id="chara1" type="radio" value="1" name="avatar">
                                <label for="chara1">
                                    <img class="chara" data-image="1" src="img/chara/chara1.png" alt="">
                                </label>
                            </li>
                            <li>
                                <input id="chara2" type="radio" value="2" name="avatar">
                                <label for="chara2">
                                    <img class="chara" data-image="2" src="img/chara/chara2.png" alt="">
                                </label>
                            </li>
                            <li>
                                <input id="chara3" type="radio" value="3" name="avatar">
                                <label for="chara3">
                                    <img class="chara" data-image="3" src="img/chara/chara3.png" alt="">
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--名前＆誕生日-->
                <div class="name-container">
                    <div>Name</div>
                    <div class="name-form"><input type="text" id="username" placeholder="Enter Your Name.." name="name" value="<?= $row["name"] ?>"></div>
                    <div>Birthday</div>
                    <div class="name-form"><input type="date" id="birthday" name="birthday" value="<?= $row["birthday"] ?>"></div>
                </div>
                <ul class="btn-list btn-list__cms">
                    <li class="btn-calculate">
                        <input type='hidden' name="id" value="<?= $row["id"] ?>">
                        <!-- アバターが未選択ら元画像を使う -->
                        <input type='hidden' name="avatar_original" value="<?= $row["avatar"] ?>">
                        <input type="submit" id="btn-update" value="更新">
                    </li>
                    <li class="">
                        <a href="./top.php" class="btn-back">戻る</a>
                    </li>
                </ul>
            </form>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="./js/funcs.js"></script>

</html>