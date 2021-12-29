
<?php
//いいねボタンのajax(axios)機能

include("funcs.php");

//POSTパラメータを取得
$id = $_POST["id"];
$user_id = $_POST["user_id"];
$art_id = $_POST["art_id"];


// DB 接続
$pdo = db_conn();


// いいねしたタイミングで like_table に新規rowをINSERT
$sql = 'INSERT INTO like_table (id, user_id, art_id, indate)
VALUE(NULL, :user_id, :art_id, sysdate())';
$stmt = $pdo->prepare($sql);
 
$stmt->bindValue(':user_id',  $user_id,    PDO::PARAM_INT);
$stmt->bindValue(':art_id',  $art_id,    PDO::PARAM_INT);

    
$status = $stmt->execute();

// var_dump($status); // OK
// exit();


// // SQL からデータ抽出
$sql2 = 'SELECT * FROM like_table WHERE id=:id';  
$stmt2 = $pdo->prepare($sql2);
$stmt2->bindValue(':id', $id);
$status2 = $stmt2->execute();
// var_dump($status2); // 問題なし
// exit("sssss");


$json = '[
    {
      "id":"'.$id.'",
      "user_id":"'.$user_id.'",
      "art_id":"'.$art_id.'",
    }
]';



$val = $stmt2->fetch(PDO::FETCH_ASSOC);
//作成したJSON文字列をリクエストしたファイルに返す
echo $val[$id];
exit;
?>