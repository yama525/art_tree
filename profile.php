<!-- ユーザープロフィールページ -->

<?php
session_start();
include("funcs.php");

// DB 接続
$pdo = db_conn();


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

<header>
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
          <a href="home.php">戻る</a>        <!-- 戻るボタン -->
          <input class="register_btn btn" type="submit" value="登録">   <!-- 登録ボタン -->
        </div>
    </form>

    
  

</main>


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
  $(".register_btn").on("click", function () {
    if($("#file_upload").val() == ""){   // まずはクリックしたときに「$("#file_upload").val()」で val の値を取得。今回は空白だったので、 == "" とすることにより解消
      alert("ファイルが選択されていません");
    }  
  });

</script>



</body>
</html>