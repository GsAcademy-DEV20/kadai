<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Waninaro</title>
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
                <li class="nav-item"><a href="#">機能</a></li>
                <li class="nav-item"><a href="#">プラン</a></li>
                <li class="nav-item"><a href="#">ログイン</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-container-index">
        <div class="detail-container">
            <div class="title">Waninaro</div>
            <div>バーチャル世界で<br />困ったことを相談しあおう</div>
            <div class="description-container">
                <ul class="avatar-list">
                    <li>
                        <img class="chara" src="img/chara0.png" alt="">
                    </li>
                    <li>
                        <img class="chara" src="img/chara1.png" alt="">
                    </li>
                    <li>
                        <img class="chara" src="img/chara2.png" alt="">
                    </li>
                    <li>
                        <img class="chara" src="img/chara3.png" alt="">
                    </li>
                </ul>
            </div>
        </div>
        <div class="btn-container">
            <a href="top.php">
                <div id="enter" class="enter-btn">ENTER</div>
            </a>
        </div>
        <p>利用規約</p>
        <p>プライバシーポリシー</p>
    </div>




</body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/funcs.js"></script>

</html>