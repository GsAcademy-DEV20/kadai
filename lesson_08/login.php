<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">

</head>

<body>

  <header class="header">
    <nav class="navigation" id="navigation">
      <ul class="nav-list">
        <li class="nav-item site-title"><a href="./top.php">waninaro</a></li>
        <li class="nav-item"><a href="./signup.php">登録</a></li>
      </ul>
    </nav>
  </header>


  <div class="main-container">
    <h1>ログイン</h1>
    <!-- login_act.phpにデータを送ります -->
    <form action="./act/login_act.php" method="post">
      <div>
        <p><input type="text" name="lid" placeholder="メールアドレス"></p>
        <p><input type="text" name="lpw" placeholder="パスワード"></p>
        <input type="submit" value="Eメールでログイン" />
      </div>
    </form>

  </div>

</body>

</html>