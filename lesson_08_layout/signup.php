<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="cms">

    <header class="header">
        <nav class="navigation" id="navigation">
            <ul class="nav-list">
                <li class="nav-item site-title"><a href="./top.php">waninaro</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-container">
        <h1>新規登録</h1>
        <!-- login_act.phpにデータを送ります -->
        <form action="./act/insert_user_act.php" method="post">
            <div>
                <p><input type="text" name="lid" placeholder="メールアドレス"></p>
                <p><input type="text" name="lpw" placeholder="パスワード"></p>
                <input type="submit" value="Eメール登録" />
            </div>
        </form>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="./js/funcs.js"></script>

</html>