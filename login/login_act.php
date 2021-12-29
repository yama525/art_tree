<?php
// //実行エラーを表示
// error_reporting(E_ERROR | E_WARNING | E_PARSE);

// //変数、変数名のスペルミスなども含める（E_NOTICE）
// error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// //全てのPHPエラーを表示する
// error_reporting(E_ALL);
// error_reporting(-1);

error_reporting(-1);
ini_set('display_errors', 'On');



session_start();

$u_name = $_POST["u_name"];
$u_pass = $_POST["u_pass"];


//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=cream_puff;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError!:'.$e->getMessage());
}

//2．SELECT * FROM gs_an_table WHERE id =:id
$sql = "SELECT * FROM user_table WHERE u_name =:u_name AND u_pass=:u_pass";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':u_name', $u_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':u_pass', $u_pass, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$res = $stmt->execute(); //SQL実行

//3．エラーがでた確認
if($res==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QuerryError:".$error[2]);
}

// ４.抽出データの確認
$val = $stmt->fetch(); 

// 5.レコードがあればSESSionに代入
if($val["id"] != ""){
  $_SESSION["chk_ssid"] = session_id();
  $_SESSION["id"] = $val['id'];
  // ログイン処理OKならselect.phpへ
  header("Location: ../home.php");
}else{
  // ログイン処理NGならlogin.phpへ
  header("Location: login.php");
}
// 処理終了
exit();


?>