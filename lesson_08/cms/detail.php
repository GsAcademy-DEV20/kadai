<?php

// step 1.GETを使って送られたidを取得
// この場合$_GET['id'];を使う
$id = $_GET['id'];


//step 2.insert.phpからDBに接続するコード一式を持ってくる
//2. DB接続します xxxにDB名を入力する
//ここから作成したDBに接続をしてデータを登録します xxxxに作成したデータベース名を書きます

try {
    $pdo = new PDO('mysql:dbname=gs_kadai_07;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

//step3.IDをもとにsqlを準備
//３．SELECT * FROM xxx WHERE id=:id
$sql = "SELECT * FROM room_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //idは数値なのでINT
$status = $stmt->execute();

//step４．データ出力
$view = ""; //受け取るための変数を事前に作ります。
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
        <!-- 商品情報 -->
        <div class="wrapper wrapper-cms">
            <!-- 商品選択フォーム -->
            <form action="update.php" method="post" class="flex-parent cartin-area cms-area" enctype="multipart/form-data">
                <!-- 商品情報 -->
                <p class="cms-thumb"><img src="../img/<?= $row["fname"] ?>" width="200px"></p>
                <dl class="cms-list">
                    <dt>画像</dt>
                    <dd><input type="file" name="fname" class="cms-item" accept="img/*"></dd>
                    <dt>商品名</dt>
                    <dd><input type="text" name="item" placeholder="商品名を入力" class="cms-item" value="<?= $row["item"] ?>"></dd>
                    <dt>金額</dt>
                    <dd><input type="text" name="value" placeholder="金額を入力" class="cms-item" value="<?= $row["value"] ?>"></dd>
                    <dt>商品紹介文</dt>
                    <dd><textarea name="description" id="" cols="30" rows="10" class="cms-item"> <?= $row["description"] ?></textarea></dd>
                </dl>
                <!-- end商品情報 -->
                <ul class="btn-list btn-list__cms">
                    <li class="btn-calculate">
                        <input type='hidden' name="id" value="<?= $row["id"] ?>">
                        <!-- 画像が空なら元画像を使う -->
                        <input type='hidden' name="fname_original" value="<?= $row["fname"] ?>">
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