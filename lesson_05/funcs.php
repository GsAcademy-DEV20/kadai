<?php

// 敵のじゃんけんの手を変える
function Show_npc_hand($npc_hand_num) {

    $npc_hand_pics_src = array('', 'img/janken_gu.png', 'img/janken_choki.png', 'img/janken_pa.png');

    if($npc_hand_num===1){
        echo '<img src='.$npc_hand_pics_src[1].'>';
    } 
    elseif($npc_hand_num===2){
        echo '<img src='.$npc_hand_pics_src[2].'>';
    }
    elseif($npc_hand_num===3){
        echo '<img src='.$npc_hand_pics_src[3].'>';
    }
}

// じゃんけんの勝敗を判定する
function Judge($pcHand, $npcHand) {
    switch ($pcHand) {
        case 'gu':
            if ($npcHand === 1)echo 'あいこ';
            else if ($npcHand === 2) echo 'あなたのかち';
            else if ($npcHand === 3) echo 'あなたのまけ';
            break;
        case 'choki':
            if ($npcHand === 1) echo 'あなたのまけ';
            else if ($npcHand === 2) echo 'あいこ';
            else if ($npcHand === 3) echo 'あなたのかち';
            break;
        case 'pa':
            if ($npcHand === 1) echo 'あなたのかち';
            else if ($npcHand === 2) echo 'あなたのまけ';
            else if ($npcHand === 3) echo 'あいこ';;
            break;
        default:
            break;
    }
}
