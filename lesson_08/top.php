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
        $view .= '<a href="peparation_room.php?id=' . $result["id"] . '">';
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
    <title>Document</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>

    <header class="header">
        <button class="btn-trigger" id="btn-trigger">
            <svg viewBox="0 0 44 44" xmlns:xlink="http://www.w3.org/1999/xlink" role="img" aria-labelledby="menuButtonTitle">
                <title id="menuButtonTitle">Menu</title>
                <symbol id="bar">
                    <rect width="28" height="2" fill="white"></rect>
                </symbol>
                <use xlink:href="#bar" x="8" y="14"></use>
                <use xlink:href="#bar" x="8" y="24"></use>
                <use xlink:href="#bar" x="8" y="34"></use>
            </svg>
        </button>
        <nav class="navigation-index" id="navigation-index">
            <ul class="nav-list">
                <li class="nav-item"><a href="./index.php">←おすすめ</a></li>
                <li class="nav-item"><a href="#">検索</a></li>
            </ul>
        </nav>
    </header>

    <div class="widget">
                <form action="" method="get" class="search-form">
                    <div>
                    <input type="text" placeholder="部屋を探す" class="search-box">
                        <input type="submit" value="送信" class="search-submit">
                    </div>
                </form>
            </div>


    <div class="main-container">
        <!-- メインカテゴリ -->
        <div class="wrapper wrapper-main flex-parent">

            <div class="header-menu">
                <nav>
                    <ul>
                        <li><a href="#">おすすめ</a></li>
                        <li><a href="./cms/myroom.php">まいるーむ</a></li>
                        <li><a href="#">りれき</a></li>
                    </ul>
                </nav>
            </div>



            <main class="wrapper-main">
                <ul class="product-list">
                    <?= $view ?>
                </ul>
            </main>
        </div>
    </div>

    <footer class="menu">
        <ul class="menu-list">
            <li class="menu-item"><a href="#">ほーむ</a></li>
            <li class="menu-item"><a href="./cms/make_room.php">つくる</a></li>
            <li class="menu-item"><a href="#">あかうんと</a></li>
        </ul>
    </footer>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/funcs.js"></script>

</html>