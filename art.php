<?php
session_start();

include("funcs.php");
// sschk();
try {
    $pdo = new PDO('mysql:dbname=cream_puff;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError!:'.$e->getMessage());
  }

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM art_table WHERE user_id=:user_id");
$stmt->bindValue(':user_id', $_SESSION["id"], PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<img src="art_img/'.$r["a_img"].'" width="200">';
  }
}




// <img src="art_img/dammy.png" alt="">

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/main.css">
    <title>Document</title>
</head>
<body>

<!-- ------------------------------------------------------ -->
<!---------------------- ここから header ---------------------->
<!-- ------------------------------------------------------ -->
<header>
<!-- ロゴ -->
<img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
<!-- ロゴの下の文章 -->
<div class="header_text">
<p>M.A.D.S.</p>
<hr style="border:0;border-top:1px solid black;">

<p class="header_sub">the digital mixed reality art gallery 7.0</p>
</div>
<!-- メニュータブ -->
<ul>
    <li>
        <a href="art.php">artworks.</a>
    </li>
    <li>
        <a href="artist.php">artists.</a>
    </li>
    <li>
        <a href="event.php">events.</a>
    </li>
    <li>
        <a href="press.php">press.</a>
    </li>
    <li>
        <a href="">about.</a>
    </li>
    <li>
        <a href="">contact.</a>
    </li>
</ul>

</header>


<!-- ------------------------------------------------------ -->
<!---------------------- ここから main ---------------------->
<!-- ------------------------------------------------------ -->
<main>
<!-- 検索バー -->
<p>Artworks/All</p>
<input type="text" placeholder="Search artworks...">


<!-- アート一覧画面 （とりあえず５枚）-->
<ul class="imglist">
    <li>
        <img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
    </li>
    <li>
        <img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
    </li>
    <li>
        <img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
    </li>
    <li>
        <img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
    </li>
    <li>
        <img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
    </li>
</ul>

<div>
    <div class="container jumbotron" id="view"><?=$view?></div>

</div>

<!-- もっと見るボタン -->
<button>Lead More</button>




<!-- ---------会社情報など（全ページ共通）--------- -->
<!-- 区切り線 -->
<hr style="border:0;border-top:1px solid black;">

<!-- 会社住所 -->
<p>
M.A.D.S. Art Gallery SL Unipersonal - C.I.F. B 05303862<br>
38670 Adeje - Tenerife Islas - Spain
</p>


</main>



<!-- ------------------------------------------------------ -->
<!---------------------- ここから footer ---------------------->
<!-- ------------------------------------------------------ -->

<footer>

<!-- ページ最下部のやつ -->
<p>© 2022 Art tree</p>

</footer>

    
</body>
</html>