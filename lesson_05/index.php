<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Hachi+Maru+Pop&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css?<?php echo date('YmdHis'); ?>">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>じゃんけんであそぼう</h1>
    </header>

    <?php
    include("funcs.php");

    //猫
    echo "<div class=center>";
    $hisHand = rand(1, 3);
    Show_npc_hand($hisHand);
    echo '<img src="img/cat/cat0_smile.png">';
    echo "</div>";

    //自分の手
    if ($_POST) {
        $yourHand = $_POST["yourHand"];
        echo "<div class=judge>";
        Judge($yourHand, $hisHand);
        echo "</div>";
    }

    ?>

    <div class="form-wrapper">
        <form method="post">
            <input type="hidden" name="yourHand" value='gu'>
            <input type="image" src="img/janken_gu.png">
        </form>
        <form method="post">
            <input type="hidden" name="yourHand" value='choki'>
            <input type="image" src="img/janken_choki.png">
        </form>
        <form method="post">
            <input type="hidden" name="yourHand" value='pa'>
            <input type="image" src="img/janken_pa.png">
        </form>
    </div>

</body>

</html>