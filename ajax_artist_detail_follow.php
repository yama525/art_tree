
<?php
//フォローボタンのajax(axios)機能

include("funcs.php");

//POSTパラメータを取得
$id = $_POST["id"];
$followee_id = $_POST["followee_id"];
$followed_id = $_POST["followed_id"];


// DB 接続
$pdo = db_conn();


// フォローしたタイミングで follow_table に新規rowをINSERT
$sql = 'INSERT INTO follow_table (id, followee_id, followed_id, indate)
VALUE(NULL, :followee_id, :followed_id, sysdate())';
$stmt = $pdo->prepare($sql);
 
$stmt->bindValue(':followee_id',  $followee_id,    PDO::PARAM_INT);
$stmt->bindValue(':followed_id',  $followed_id,    PDO::PARAM_INT);

    
$status = $stmt->execute();

// var_dump($status); // OK
// exit();


// // SQL からデータ抽出
$sql2 = 'SELECT * FROM follow_table WHERE id=:id';  
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindValue(':id', $id);
$status2 = $stmt2->execute();
// var_dump($status2); // 問題なし
// exit("sssss");


$json = '[
    {
      "id":"'.$id.'",
      "followee_id":"'.$followee_id.'",
      "followed_id":"'.$followed_id.'",
    }
]';



$val = $stmt2->fetch(PDO::FETCH_ASSOC);
//作成したJSON文字列をリクエストしたファイルに返す
echo $val[$id];
exit;
?>