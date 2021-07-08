<?php
function loginCheck()
{

    if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
        echo "Login Error!";
        exit();
    } else {
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
        echo $_SESSION["chk_ssid"];
    }
}


function dbConnect()
{

    try {
        //サーバーの情報
        $pdo = new PDO('mysql:dbname=gs_kadai_08;charset=utf8;host=localhost', 'root', '');
    } catch (PDOException $e) {
        exit('DbConnectError:' . $e->getMessage());
    }
    return $pdo;
}
