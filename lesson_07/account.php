<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.ico">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=DotGothic16&display=swap" rel="stylesheet">
    <title>Document</title>
</head>

<body class="index">
    <div class="index-container">
        <form method="post" action="insert.php">
            <!--名前-->
            <div class="name-container">
                <div>Name</div>
                <div class="name-form"><input type="text" id="username" placeholder="Enter Your Name.." name="name"></div>
                <div>Birthday</div>
                <div class="name-form"><input type="date" id="birthday" name="birthday"></div>
            </div>
            <!--アバター-->
            <div class="avatar-container">
                <div>Avator</div>
                <div><img id="selected-avatar" src="img/chara0.png" alt=""></div>
                <div>
                    <ul class="select-avatar-list">
                        <li>
                            <input id="chara0" type="radio" value="0" name="avatar">
                            <label for="chara0">
                                <img class="chara" data-image="0" src="img/chara0.png" alt="">
                            </label>
                        </li>
                        <li>
                            <input id="chara1" type="radio" value="1" name="avatar">
                            <label for="chara1">
                                <img class="chara" data-image="1" src="img/chara1.png" alt="">
                            </label>
                        </li>
                        <li>
                            <input id="chara2" type="radio" value="2" name="avatar">
                            <label for="chara2">
                                <img class="chara" data-image="2" src="img/chara2.png" alt="">
                            </label>
                        </li>
                        <li>
                            <input id="chara3" type="radio" value="3" name="avatar">
                            <label for="chara3">
                                <img class="chara" data-image="3" src="img/chara3.png" alt="">
                            </label>
                        </li>
                    </ul>
                </div>
            </div>

            <!--入室-->
            <div class="enter-container">
                <!-- <div id="enter" class="enter-btn">ENTER</div> -->
                <input type="submit" value="ENTER" id="enter" class="enter-btn">
            </div>
        </form>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.2/firebase.js"></script>
<script src="env/firebase_init.js"></script>
<script src="js/main.js"></script>

</html>