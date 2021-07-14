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

<body class="cms">

    <header class="header">
        <nav class="navigation" id="navigation">
            <ul class="nav-list">
                <li class="nav-item site-title"><a href="./top.php">waninaro</a></li>
            </ul>
        </nav>
    </header>

    <div class="main-container">

        <div class="wrapper wrapper-cms">
            <form action="./act/insert_act.php" method="post" class="flex-parent cartin-area cms-area" enctype="multipart/form-data">

                <!--ルームタイプ-->
                <div class="room-container">
                    <div>部屋タイプ</div>
                    <div>
                        <ul class="select-room-list">
                            <li>
                                <input id="room0" type="radio" value="0" name="type">
                                <label for="room0">
                                    <img class="room" data-image="0" src="img/room/room0.png" alt="">
                                </label>
                            </li>
                            <li>
                                <input id="room1" type="radio" value="1" name="type">
                                <label for="room1">
                                    <img class="room" data-image="1" src="img/room/room1.png" alt="">
                                </label>
                            </li>
                            <li>
                                <input id="room2" type="radio" value="2" name="type">
                                <label for="room2">
                                    <img class="room" data-image="2" src="img/room/room2.png" alt="">
                                </label>
                            </li>
                            <li>
                                <input id="room3" type="radio" value="3" name="type">
                                <label for="room3">
                                    <img class="room" data-image="3" src="img/room/room3.png" alt="">
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <dl class="cms-list">
                    <dt>ルーム名</dt>
                    <dd><input type="text" name="name" placeholder="ルーム名を入力" class="cms-item"></dd>
                    <dt>鍵</dt>
                    <dd>
                        <input type="radio" name="key_flg" value="1" checked="checked">鍵なし
                        <input type="radio" name="key_flg" value="2">鍵あり
                    </dd>
                    <dt>あいことば</dt>
                    <dd><input type="text" name="psw" placeholder="パスワードを入力" class="cms-item"></dd>
                </dl>
                <ul class="btn-list btn-list__cms">
                    <li class="btn-calculate">
                        <input type="submit" id="btn-update" value="登録">
                    </li>
                    <li class="">
                        <a href="./top.php" class="btn-back">戻る</a>
                    </li>
                </ul>
            </form>
        </div>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="./js/funcs.js"></script>

</html>