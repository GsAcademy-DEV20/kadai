<?php
session_start();

// ----------------------------------------------------------------
// 1. DB接続
// ----------------------------------------------------------------

try {
    //サーバーの情報
    $pdo = new PDO('mysql:dbname=gs_kadai_07;charset=utf8;host=localhost', 'root', '');
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
        $view .= '<a href="item.php?id=' . $result["id"] . '">';
        $view .= '<p class="products-thumb"><img src="./img/' . $result["fname"] . '" width="200"></p>';
        $view .= '<h3 class="products-title">' . $result["item"] . '</h3>';
        $view .= '<p class="products-price">' . $result["value"] . '</p>';
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
        <nav class="navigation" id="navigation">
            <ul class="nav-list">
                <li class="nav-item"><a href="./index.php">waninaro</a></li>
                <li class="nav-item"><a href="./cms/item_list.php">管理</a></li>
            </ul>
        </nav>
    </header>


    <div class="main-container">
        <!-- メインカテゴリ -->
        <div class="wrapper wrapper-main flex-parent">

            <div class="widget">
                <form action="" method="get" class="search-form">
                    <div>
                        <input type="text" placeholder="アイテムを探す" class="search-box">
                        <input type="submit" value="送信" class="search-submit">
                    </div>
                </form>
            </div>

            <div class="widget">
                <h3 class="widget-title">All products</h3>
                <ul class="category-list">
                    <li class="category-item"><a href="#">Category1</a></li>
                    <li class="category-item"><a href="#">Category2</a></li>
                    <li class="category-item"><a href="#">Category3</a></li>
                    <li class="category-item"><a href="#">Category4</a></li>
                </ul>
            </div>

            <main class="wrapper-main">
                <div class="sort-area">
                    <a href="#" class="sort-all">全て見る</a>

                    <div class="sort-detail">
                        <p class="sort-text">並びかえ</p>
                        <ul class="sort-list flex-parent">
                            <li class="sort-item"><a href="#">名前順</a></li>
                            <li class="sort-item"><a href="#">価格の安い順</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="product-list">
                    <?= $view ?>
                </ul>
            </main>

        </div>
    </div>
</body>

</html>