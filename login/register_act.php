<?php

$u_name = $_POST["u_name"];
$email = $_POST["email"];
$u_pass = $_POST["u_pass"];

//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBError!:'.$e->getMessage());
}

//３．データ登録SQL作成
$sql = "INSERT INTO user_table(u_name, email, u_pass, indate)VALUES(:u_name, :email, :u_pass, sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':u_name', $u_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_pass', $u_pass, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //SQL実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQLError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: login.php");
  exit();
}


?>
