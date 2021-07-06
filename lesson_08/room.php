<?php
session_start();

//値を取得
if (!isset($_GET["id"]) || $_GET["id"] == "") {
    exit("ParamError!item!");
} else {
    $id = intval($_GET["id"]); //intvalは全部数値に変換する関数
}

// ----------------------------------------------------------------
//  DB接続
// ----------------------------------------------------------------

try {
    //サーバーの情報
    $pdo = new PDO('mysql:dbname=gs_kadai_07;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

// ----------------------------------------------------------------
// データ抽出SQL作成
// ----------------------------------------------------------------
$stmt = $pdo->prepare("SELECT * FROM room_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// ----------------------------------------------------------------
// データ表示
// ----------------------------------------------------------------
$view = "";
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {
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
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header class="header">
        <nav class="navigation" id="navigation">
            <ul class="nav-list">
                <li class="nav-item site-title"><a href="./top.php">waninaro</a></li>
            </ul>
        </nav>
    </header>

    <form action="cartadd.php" method="POST">
        <div class="main-container">
            <h1 class="page-title">商品</h1>
            <div class="wrapper wrapper-main flex-parent">

                <main class="wrapper-main">
                    <!-- 商品情報 -->
                    <p class="item-thumb"><img src="./img/<?= $row["fname"] ?>" width="200"></p>
                    <div class="flex-parent item-label">
                        <h1 class="item-name"><?= $row["item"] ?></h1>
                        <p class="item-price"><?= $row["value"] ?></p>
                        <p><input type="number" value="1" name="num" class="cartin-number"> </p>
                    </div>
                    <!-- カートボタン -->
                    <div class="flex-parent item-label">
                        <input type="submit" class="btn-cartin" value="カートに入れる">
                    </div>
                    <!-- 商品詳細 -->
                    <div class="flex-parent item-label">
                        <p class="item-text"><?= $row["description"] ?></p>
                    </div>
                    <input type="hidden" name="item" value="<?= $row["item"] ?>">
                    <input type="hidden" name="value" value="<?= $row["value"] ?>">
                    <input type="hidden" name="id" value="<?= $row["id"] ?>">
                    <input type="hidden" name="fname" value="<?= $row["fname"] ?>">
                </main>
            </div>
        </div>
    </form>

</body>

</html>