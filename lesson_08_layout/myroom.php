<?PHP
session_start();

include("./act/funcs.php");
// ----------------------------------------------------------------
// DB接続
// ----------------------------------------------------------------
$pdo = dbConnect();

// ----------------------------------------------------------------
// データ抽出SQL作成
// ----------------------------------------------------------------

$stmt = $pdo->prepare("SELECT * FROM room_table");
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
    while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<li class="cart-list">';
        $view .= '<h2 class="cart-title">' . $res["name"] . '</h2>';
        $view .= '<p class="cart-price">' . $res["type"] . '</p>';
        $view .= '<a href="./prepare.php?id=' . $res["id"] . '" class="btn-update">入室</a>';
        $view .= ' <a href="./act/delete_act.php?id=' . $res["id"] . '" class="btn-delete">削除</a>';
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
                <li class="nav-item site-title"><a href="./top.php">waninaro</a></li>
                <li class="nav-item"><a href="#">検索</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-container">
        <h1 class="page-title page-title__cms">非公開</h1>
        <div><a href="./create.php">新規追加</a></div>
        
        <div class="wrapper wrapper-main flex-parent">
            <main class="wrapper-main">
                <ul class="cart-products">
                    <?php echo $view; ?>
                </ul>
            </main>
        </div>
    </div>

</body>

</html>