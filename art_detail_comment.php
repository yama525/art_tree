<?php
session_start(); //session id とれたらここをオープン
include("funcs.php");

// DB 接続
$pdo = db_conn();

// コメントの値を取得
$comment = $_POST["comment"]; 
$art_id =$_GET["a_id"];



// テスト
$user_id = $_SESSION["id"]; // 仮
// $art_id = 2; // 仮
// var_dump($art_id);
// var_dump($comment);
// var_dump($user_id);
// exit();

// データ登録
$stmt = $pdo->prepare("INSERT INTO comment_table(id, comment, user_id, art_id, indate)
                                       VALUES(NULL, :comment, :user_id, :art_id, sysdate())");
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR); //$id の箇所はセッションID でログイン時から持っておく
// $stmt->bindValue(':user_id', $_SESSION["id"], PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく。本番はこっち
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく。本番は ↑
$stmt->bindValue(':art_id', $art_id, PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく
$status = $stmt->execute();
// var_dump($status); // OK
// exit();


// Redirect
if($status == false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{

    header("Location: art_detail.php?a_comment_id=$art_id");
    exit;
}


?>