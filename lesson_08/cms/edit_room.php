<?php

// ----------------------------------------------------------------
// GETを使って送られたidを取得
// ----------------------------------------------------------------

$id = $_GET['id'];


// ----------------------------------------------------------------
// DB接続
// ----------------------------------------------------------------

try {
    $pdo = new PDO('mysql:dbname=gs_kadai_08;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

// ----------------------------------------------------------------
// IDをもとにsqlを準備
// ----------------------------------------------------------------

$sql = "SELECT * FROM room_table WHERE id=:id";
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
    <title>Document</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="cms">

    <header class="header">
        <nav class="navigation" id="navigation">
            <ul class="nav-list">
                <li class="nav-item site-title"><a href="../top.php">waninaro</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-container">

        <div class="wrapper wrapper-cms">

            <form action="update.php" method="post" class="flex-parent cartin-area cms-area" enctype="multipart/form-data">
                <p class="cms-thumb"></p>
                <dl class="cms-list">
                    <dt>部屋タイプ</dt>
                    <dd>
                    <!-- https://teratail.com/questions/317139 -->
                        <input type="radio" name="type" value="1" checked="checked">タイプ１
                        <input type="radio" name="type" value="2">タイプ２
                        <input type="radio" name="type" value="3">タイプ３
                    </dd>
                    <dt>ルーム名</dt>
                    <dd><input type="text" name="name" placeholder="ルーム名を入力" class="cms-item" value="<?= $row["name"] ?>"></dd>
                    <dt>鍵</dt>
                    <dd>
                        <input type="radio" name="key_flg" value="1" checked="checked">鍵なし
                        <input type="radio" name="key_flg" value="2">鍵あり
                    </dd>
                    <dt>あいことば</dt>
                    <dd><input type="text" name="psw" placeholder="パスワードを入力" class="cms-item" value="<?= $row["psw"] ?>"></dd>
                </dl>
                <ul class="btn-list btn-list__cms">
                    <li class="btn-calculate">
                        <input type='hidden' name="id" value="<?= $row["id"] ?>">
                        <input type="submit" id="btn-update" value="更新">
                    </li>
                    <li class="">
                        <a href="../" class="btn-back">戻る</a>
                    </li>
                </ul>
            </form>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/funcs.js"></script>

</html>