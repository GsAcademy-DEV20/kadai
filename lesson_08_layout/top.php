<?php
session_start();

// ----------------------------------------------------------------
// 1. DB接続
// ----------------------------------------------------------------

try {
    //サーバーの情報
    $pdo = new PDO('mysql:dbname=gs_kadai_08;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
}

// ----------------------------------------------------------------
// 2. データ抽出SQL作成
// ----------------------------------------------------------------
$stmt = $pdo->prepare("SELECT * FROM room_table");
$status = $stmt->execute();

// ----------------------------------------------------------------
// 3. データ表示
// ----------------------------------------------------------------
$view = "";
if ($status == false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:" . $error[2]);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<li class="products-item">';
        $view .= '<a href="prepare.php?id=' . $result["id"] . '">';
        $view .= '<p class="room-type">' . $result["type"] . '</p>';
        $view .= '<h3 class="room-name">' . $result["name"] . '</h3>';
        $view .= '</a>';
        $view .= '</li>';
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waninaro</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header class="header">
        <nav class="navigation" id="navigation">
            <ul class="nav-list">
                <li class="nav-item"><a href="./index.php">←</a></li>
                <li class="nav-item"><a href="#">検索</a></li>
            </ul>
        </nav>
        <!-- <div class="widget">
            <form action="" method="get" class="search-form">
                <div>
                    <input type="text" placeholder="部屋名を入力する" class="search-box">
                    <input type="submit" value="送信" class="search-submit">
                </div>
            </form>
        </div> -->
    </header>

    <div class="main-container">
        <div class="top-menu">
            <nav class="navigation">
                <ul class="nav-list">
                    <li class="nav-item current"><a href="./top.php">おすすめ</a></li>
                    <li class="nav-item"><a href="./myroom.php">まいるーむ</a></li>
                    <li class="nav-item"><a href="./myroom.php">りれき</a></li>
                </ul>
            </nav>
        </div>
        <div class="main-contents">
            <ul class="product-list">
                <?= $view ?>
            </ul>
        </div>
    </div>

    <div class="footer">
        <ul class="menu-list">
            <li class="menu-item"><a href="ホーム画面URL"><image src="./img/icon/icon_chat.gif"></image><br><span class="iconname">ほーむ</span></a></li>
            <li class="menu-item"><a href="./create.php"><image src="./img/icon/icon_create.png"></image><br><span class="iconname">つくる</span></a></li>
            <li class="menu-item"><a href="./account.php"><image src="./img/icon/icon_account.png"></image><br><span class="iconname">あかうんと</span></a></li>
        </ul>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/funcs.js"></script>

</html>