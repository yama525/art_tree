<?php
session_start();
include("funcs.php");

// DB 接続
$pdo = db_conn();
  
  
// 右上アイコンで u_img がない場合はダミー画像、ある場合は u_img を表示。
if($_SESSION["u_img"] == null){
    $view_profile_icon = '<a href="profile.php"><img class="header_space__img" src="https://placehold.jp/24/e3e3e6/ffffff/200x200.png?text=%E3%83%97%E3%83%AD%E3%83%95%E3%82%A3%E3%83%BC%E3%83%AB%0A%E7%94%BB%E5%83%8F%E3%82%92%E8%BF%BD%E5%8A%A0" alt="プロフィール画像"></a>';
}else{
    $view_profile_icon = '<a href="profile.php"><img class="header_space__img" src="artist_img/'.$_SESSION["u_img"].'" alt="プロフィール画像"></a>';
}


// inner join で follow_table と user_table を接続
$stmt_join_follow_art = $pdo->prepare(" SELECT * FROM art_table AS A_T
INNER JOIN follow_table AS F_T ON F_T.followed_id = A_T.user_id
WHERE F_T.followee_id = :followee_id");
$stmt_join_follow_art->bindValue(':followee_id', $_SESSION["id"], PDO::PARAM_STR);
$status_join_follow_art = $stmt_join_follow_art->execute();

$view_join_follow_art = "";
while($result_join_follow_art = $stmt_join_follow_art->fetch(PDO::FETCH_ASSOC)){
  // var_dump($result_join_follow_art["u_img"]);
  $view_join_follow_art .= '<li><img src="art_img/'.$result_join_follow_art["a_img"].'"></li>';
}

// inner join で follow_table と user_table を接続
$stmt_join_follow_art = $pdo->prepare(" SELECT * FROM follow_table AS F_T
INNER JOIN art_table AS A_T ON F_T.followed_id = A_T.user_id
WHERE F_T.followee_id = :followee_id");
$stmt_join_follow_art->bindValue(':followee_id', $_SESSION["id"], PDO::PARAM_STR);
$status_join_follow_art = $stmt_join_follow_art->execute();

$view_join_follow_art = "";
while($result_join_follow_art = $stmt_join_follow_art->fetch(PDO::FETCH_ASSOC)){
//   var_dump($result_join_follow_art["id"]);
//   exit();
  $view_join_follow_art .= '<li><a href="art_detail.php
  ?a_id='.$result_join_follow_art["id"].'
  &a_img='.$result_join_follow_art["a_img"].'
  &a_title='.$result_join_follow_art["a_title"].'
  &a_des='.$result_join_follow_art["a_des"].'
  &a_year='.$result_join_follow_art["a_year"].'


  "><img src="art_img/'.$result_join_follow_art["a_img"].'"></a></li>';

}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
    <title>Arts</title>
</head>
<body>


<!-- ------------------------------------------------------ -->
<!---------------------- ここから header ---------------------->
<!-- ------------------------------------------------------ -->
<header>
<!-- ページ右上のプロフィール写真アイコン -->
<div class="header_space">
    <a href="art_register.php"><img class="header_space__img" src="other_img/plus_icon.png"></a>
    <?= $view_profile_icon ?>
</div>

<!-- ロゴ -->
<img class="logo" src="other_img/logo.png" alt="">
<!-- ロゴの下の文章 -->
  <div class="logo_text">
    <p>ART TREE</p>
      <hr> <!-- 横線 -->
    <p>the digital mixed reality and NFT art gallery</p>
  </div>

<!-- メニュータブ -->
<ul>
    <li>
        <a href="art.php">artwork.</a>
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
        <a href="home.php#about">about.</a>
    </li>
    <li>
        <a href="home.php#contact">contact.</a>
    </li>
</ul>

</header>


<!-- ------------------------------------------------------ -->
<!---------------------- ここから main ---------------------->
<!-- ------------------------------------------------------ -->
<main>
<!-- 検索バー -->
<p class="main_guide_text">Artworks/All</p>
<!-- <input type="text" placeholder="Search artworks..."> -->


<!-- アート一覧画面 （とりあえず５枚）-->
<ul class="imglist">
    
    <?=$view_join_follow_art?>

</ul>

<div>
    <div class="container jumbotron" id="view"><?=$view?></div>

</div>




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