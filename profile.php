<!-- ユーザープロフィールページ -->

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

// u_img がない場合はダミー画像、ある場合は u_img を表示。
if($_SESSION["u_img"] == null){
  $view = '<img class="profile_img" src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ">';
}else{
  $view = '<img class="profile_img" src="images/'.$_SESSION["u_img"].'">';
}

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
<!-- ページ右上のプロフィール写真アイコン -->
<div class="header_space">
    <?= $view_profile_icon ?>
</div>

<!-- ロゴ -->
<img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
<!-- ロゴの下の文章 -->
<p>M.A.D.S.</p>
<hr style="border:0;border-top:1px solid black;">
<p>the digital mixed reality art gallery 7.0</p>

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

    <form method="post" action="profile_act.php" enctype="multipart/form-data">
        <h2 class="subtitle">Profile</h2>
        <label for="file_upload" class="cms-thumb" >
            <input type="file" id="file_upload" name="u_img" accept="image/*" required>
            <?= $view ?>
        </label>

        <div>
          <h2 class="subtitle">Bio</h2>
          <textarea class="profile_text" name="u_des" id="" cols="30" rows="10"></textarea>
        </div>

        <div>
          <a href="home.php" class="btn_negative btn">Back</a>        <!-- 戻るボタン -->
          <input class="btn_positive btn" type="submit" value="Update">   <!-- 登録ボタン -->
        </div>
    </form>

    
  

</main>

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



//  ーーーーーーー 画像が選択されていない時のアラート ーーーーーーー
  $(".btn__positive").on("click", function () {
    if($("#file_upload").val() == ""){   // まずはクリックしたときに「$("#file_upload").val()」で val の値を取得。今回は空白だったので、 == "" とすることにより解消
      alert("ファイルが選択されていません");
    }  
  });

</script>



</body>
</html>