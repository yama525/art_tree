<?php
session_start();
include("funcs.php");

// 画像の入力チェック
image_check("u_img");


// DB 接続
$pdo = db_conn();


// u_name, u_des の値を取得
$u_name = $_POST["u_name"];
$u_des = $_POST["u_des"];
// echo $u_name;
// echo $u_des;
// echo $_SESSION["id"];
// exit();

// 画像 insert
    $_SESSION["u_img"] = fileUpload("u_img","artist_img/");
    if($_SESSION["u_img"] == 1 || $_SESSION["u_img"] == 2){    // エラーの種類を番号で確認できる
        exit("FileUpload Error!");
    }



// データ登録
$sql = 'UPDATE user_table SET u_name=:u_name, u_des=:u_des, u_img=:u_img WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':u_name', $u_name, PDO::PARAM_STR);
    $stmt->bindValue(':u_des', $u_des, PDO::PARAM_STR);
    $stmt->bindValue(':u_img', $_SESSION["u_img"], PDO::PARAM_STR);
    $stmt->bindValue(':id',    $_SESSION["id"],    PDO::PARAM_INT);
    $status = $stmt->execute();


    // エラー確認とリダイレクト
if($status == false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{
    header("Location: profile.php");
    exit;
}



?>