<?PHP
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
    while ($res = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .= '<li class="cart-list">';
        $view .= '<p class="cart-thumb"><img src="../img/' . $res["fname"] . '" width="200px"></p>';
        $view .= '<h2 class="cart-title">' . $res["item"] . '</h2>';
        $view .= '<p class="cart-price">' . $res["value"] . '</p>';
        $view .= '<a href="#" class="btn-update">編集</a>';
        $view .= ' <a href="delete.php?id='.$res["id"].'" class="btn-delete">削除</a>';
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
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <header class="header">
        <nav class="navigation" id="navigation">
            <ul class="nav-list">
                <li class="nav-item site-title"><a href="../top.php">waninaro</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-container">
        <h1 class="page-title page-title__cms">管理画面</h1>
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