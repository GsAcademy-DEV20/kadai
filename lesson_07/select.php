<?php

//1.  DB接続します xxxにDB名（a_db）を入れます
//Xamppの人は''の右は何も入れない
//Mamppの人は''の右に'root'をいれる
//tryとcatchはエラーを拾うときによくやる書き方
try {
//PODでデータベースに接続するためのおまじないの塊（専門用語でオブジェクト）を作っている　（これを専門用語でインスタンス化）
$pdo = new PDO('mysql:dbname=gs_kadai_06;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
//作ったテーブル名を書く場所  xxxにテーブル名を入れます
$stmt = $pdo->prepare("SELECT * FROM user_table ORDER BY id DESC");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる $resultの中に「カラム名」が入ってくるのでそれを表示させる例
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .= "ID：".$result["id"]."<br>名前：".$result["name"]."<br>誕生日：".$result["birthday"]."<br>いいね：".$result["thanks"];
    $view .= "</p>";
    $view .= Show_avatar($result["avatar"]);
  }

}

// アバターの見た目を変える
function Show_avatar($avatar)
{
    $avatarImg = ['img/chara0.png', 'img/chara1.png', 'img/chara2.png', 'img/chara3.png'];
    return '<img src=' . $avatarImg[$avatar] . '>';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>アバター表示</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] $view-->
<div>
    <?=$view?>
</div>
<!-- Main[End] -->

</body>
</html>
