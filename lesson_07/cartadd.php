<?php
session_start();
// ----------------------------------------------------------------
// 1. 入力チェック
// ----------------------------------------------------------------
//商品名 受信チェック:item
//金額 受信チェック:value
//商品紹介文 受信チェック:description
//ファイル受信チェック※S_FILES["*"]["name"]の場合

if (!isset($_POST["item"]) || $_POST["item"] == "") {
    exit("ParamError!item!");
}
if (!isset($_POST["value"]) || $_POST["value"] == "") {
    exit("ParamError!value!");
}
if (!isset($_POST["id"]) || $_POST["id"] == "") {
    exit("ParamError!id!");
}
if (!isset($_POST["num"]) || $_POST["num"] == "") {
    exit("ParamError!num!");
}
if (!isset($_POST["fname"]) || $_POST["fname"] == "") {
    exit("ParamError!fname!");
}

// ----------------------------------------------------------------
// 2. POSTデータ取得
// ----------------------------------------------------------------

$id = intval($_POST["id"]);
$item = $_POST["item"];
$value = intval($_POST["value"]);
$num = intval($_POST["num"]);
$fname = $_POST["fname"];

// ----------------------------------------------------------------
// 3. カートへ登録 array([0]=item,[1]=value,[2]=num,[3]=fname)
// ----------------------------------------------------------------
$_SESSION["cart"][$id] = array($item, $value, $num, $fname);

// ----------------------------------------------------------------
// 4. 次のページへ移動
// ----------------------------------------------------------------
header("Location: cart.php");
exit;
