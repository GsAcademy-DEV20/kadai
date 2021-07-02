<?php
session_start();
// ----------------------------------------------------------------
// 1. 入力チェック
// ----------------------------------------------------------------
//商品名 受信チェック:item
//金額 受信チェック:value
//商品紹介文 受信チェック:description
//ファイル受信チェック※S_FILES["*"]["name"]の場合

if (!isset($_GET["id"]) || $_GET["id"] == "") {
    exit("ParamError!id!");
}


// ----------------------------------------------------------------
// 2. POSTデータ取得
// ----------------------------------------------------------------
$id = intval($_GET["id"]);


// ----------------------------------------------------------------
// 3. SESSION削除
// ----------------------------------------------------------------
unset($_SESSION["cart"][$id]);

// ----------------------------------------------------------------
// 4. 次のページへ移動
// ----------------------------------------------------------------
header("Location: cart.php");
exit;