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
            <form action="insert.php" method="post" class="flex-parent cartin-area cms-area" enctype="multipart/form-data">
                <!-- 商品情報 -->
                <p class="cms-thumb"><img src="../img/about.png" width="200"></p>
                <dl class="cms-list">
                    <dt>画像</dt>
                    <dd><input type="file" name="fname" class="cms-item" accept="img/*"></dd>
                    <dt>商品名</dt>
                    <dd><input type="text" name="item" placeholder="商品名を入力" class="cms-item"></dd>
                    <dt>金額</dt>
                    <dd><input type="text" name="value" placeholder="金額を入力" class="cms-item"></dd>
                    <dt>商品紹介文</dt>
                    <dd><textarea name="description" id="" cols="30" rows="10" class="cms-item">商品紹介文を入力</textarea></dd>
                </dl>
                <!-- end商品情報 -->
                <ul class="btn-list btn-list__cms">
                    <li class="btn-calculate">
                        <input type="submit" id="btn-update" value="登録">
                    </li>
                    <li class="">
                        <a href="./" class="btn-back">戻る</a>
                    </li>
                </ul>
            </form>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/funcs.js"></script>

</html>