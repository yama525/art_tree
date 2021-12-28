<?php
session_start();
include("funcs.php");

// 画像の入力チェック
image_check("u_img");


// DB 接続
$pdo = db_conn();


// 画像 insert
    $_SESSION["u_img"] = fileUpload("u_img","artist_img/");
    if($_SESSION["u_img"] == 1 || $_SESSION["u_img"] == 2){    // エラーの種類を番号で確認できる
        exit("FileUpload Error!");
    }



// データ登録
$sql = 'UPDATE user_table SET u_img=:u_img WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    
    $stmt->bindValue(':u_img', $_SESSION["u_img"], PDO::PARAM_STR);
    $stmt->bindValue(':id',    $_SESSION["id"],    PDO::PARAM_INT);

    $status = $stmt->execute();


    // エラー確認とリダイレクト
if($status == false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{
    header("Location: home.php");
    exit;
}



?>