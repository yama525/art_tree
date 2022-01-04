<?php

session_start();
//1. POSTデータ取得
$a_title   = $_POST["a_title"];
$a_des = $_POST["a_des"];
$a_year  = $_POST["a_year"];
$user_id = $_SESSION["id"];



//2. DB接続します
include("funcs.php");
try {
  $pdo = new PDO('mysql:dbname=cream_puff;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError!:'.$e->getMessage());
}

$st = fileUpload("a_img","art_img/");
if($st==1 || $st==2){
  exit("File UPload Error");
}

// var_dump($st);
// exit();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO art_table(a_img,a_title,a_des,a_year,user_id,like_count,indate)VALUES(:a_img,:a_title,:a_des,:a_year,:user_id,0,sysdate())");
$stmt->bindValue(':a_img', $st, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a_title', $a_title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a_des', $a_des, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a_year', $a_year, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error($stmt);
}else{
  redirect("art.php");
}



?>
