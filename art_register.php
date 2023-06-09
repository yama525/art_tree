<!-- 写真の投稿画面 -->
<?php

session_start();
include("funcs.php");

// DB 接続
$pdo = db_conn();


// 右上アイコンで u_img がない場合はダミー画像、ある場合は u_img を表示。
if($_SESSION["u_img"] == null){
    $view_profile_icon = '<a href="profile.php"><img class="header_space__img" src="https://placehold.jp/24/e3e3e6/ffffff/200x200.png?text=%E3%83%97%E3%83%AD%E3%83%95%E3%82%A3%E3%83%BC%E3%83%AB%0A%E7%94%BB%E5%83%8F%E3%82%92%E8%BF%BD%E5%8A%A0" alt="プロフィール画像"></a>';
  }else{
    $view_profile_icon = '<a href="profile.php"><img class="header_space__img" src="artist_img/'.$_SESSION["u_img"].'" alt="プロフィール画像" width="200" height="200"></a>';
  }


?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="scss/main.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>


</head>
<body>


<!-- ------------------------------------------------------ -->
<!---------------------- ここから header ---------------------->
<!-- ------------------------------------------------------ -->
<header>
<!-- ページ右上のプロフィール写真アイコン -->
<div class="header_space">
    <?= $view_profile_icon ?></p>
</div>

<!-- ロゴ -->
<img class="logo" src="other_img/logo.png" alt="">
<!-- ロゴの下の文章 -->
  <div class="logo_text">
    <p>ART TREE</p>
      <hr> <!-- 横線 -->
    <p>the digital mixed reality and NFT art gallery</p>
  </div>


<!-- ロゴ
<img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
ロゴの下の文章 -->
<!-- <p>M.A.D.S.</p>
<hr style="border:0;border-top:1px solid black;">
<p>the digital mixed reality art gallery 7.0</p> -->

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

<!-- Main[Start] -->


<div class="profile_edit">
    <form method="post" action="art_insert.php" enctype="multipart/form-data">
        <label for="file_upload" class="cms-thumb" >
            <input type="file" id="file_upload" name="a_img" accept="image/*" required>
            <img class="art_register_img" src="other_img/dummy_image.jpeg">
        </label>
        <div style="padding-top:12px">
          <input class="art_register_input" type="text" name="a_title" placeholder="Title*">
        </div>
        <div style="padding-top:12px">
          <input class="art_register_input" type="text" name="a_year" placeholder="Year">
        </div>

        <div>
          <textarea class="profile_textarea japanese" name="a_des" cols="30" rows="10" placeholder="Description"></textarea>
        </div>

        <div>
          <input class="btn_positive btn" type="submit" value="Add">   <!-- 登録ボタン -->
        </div>
    </form>
  </div>
<!-- Main[End] -->


</body>

<footer>

<!-- ページ最下部のやつ -->
<p>© 2022 Art tree</p>

</footer>


<style>
    label > input {
        display:none; アップロードボタンのスタイルを無効にする
    }


    .cms-thumb{
    margin: 0 auto;
    text-align: center;
    margin-top: 15px;
  }



</style>

<script src="http://code.jquery.com/jquery-3.0.0.js"></script>
<script>
// ーーーーーーーーーーーー 画像サムネイル表示 ーーーーーーーーーーーー
  // アップロードするファイルを選択
  $('input[type=file]').change(function() {
    //選択したファイルを取得し、file変数に格納
    var file = $(this).prop('files')[0];
    // 画像以外は処理を停止
    if (!file.type.match('image.*')) {
      // クリア
      $(this).val(''); //選択されてるファイルを空にする
      $('.cms-thumb > img').html(''); //画像表示箇所を空にする
      return;
    }
    // 画像表示
    var reader = new FileReader(); //1
    reader.onload = function() {   //2
      $('.cms-thumb > img').attr('src', reader.result);
    }
    reader.readAsDataURL(file);    //3
  });


</script>
</html>
