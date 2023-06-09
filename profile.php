<!-- ユーザープロフィールページ -->

<?php
session_start();
include("funcs.php");

// DB 接続
$pdo = db_conn();

// 右上アイコンで u_img がない場合はダミー画像、ある場合は u_img を表示。
if($_SESSION["u_img"] == null){
  $view_profile_icon = '<a href="profile.php"><img class="header_space__img" src="other_img/dammy_person.png" alt="プロフィール画像"></a>';
}else{
  $view_profile_icon = '<a href="profile.php"><img class="header_space__img" src="artist_img/'.$_SESSION["u_img"].'" alt="プロフィール画像"></a>';
}

// u_img がない場合はダミー画像、ある場合は u_img を表示。
if($_SESSION["u_img"] == null){
  $view = '<img class="profile_img" src="other_img/dammy_person.png">';
}else{
  $view = '<img class="profile_img" src="artist_img/'.$_SESSION["u_img"].'">';
}



$user_id = $_SESSION["id"]; // 
// user_table からのデータ抽出
$stmt_user = $pdo->prepare('SELECT * FROM user_table WHERE id=:id');
$stmt_user->bindValue(':id', $user_id, PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく
$status_user = $stmt_user->execute();

$result_user = $stmt_user->fetch(PDO::FETCH_ASSOC);


// art_table からの自分のid のデータ抽出
$view_user_art = "";
$stmt_art = $pdo->prepare('SELECT * FROM art_table WHERE user_id=:user_id');
$stmt_art->bindValue(':user_id', $_SESSION["id"], PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく
$status_art = $stmt_art->execute();

while($result_art = $stmt_art->fetch(PDO::FETCH_ASSOC)){
    $view_user_art .= '<li>';
    $view_user_art .= '<a href="art_detail.php?id='.$result_art["id"].'"><img src="art_img/'.$result_art["a_img"].'"></a>';
    $view_user_art .= '</li>';
}



// フォロー、フォロワー関係＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
  // follow_table から自分がフォローしているアーティスト数を取得
  $stmt_followee = $pdo->prepare('SELECT COUNT(*) FROM follow_table WHERE followee_id=:followee_id;');
  $stmt_followee->bindValue(':followee_id', $user_id, PDO::PARAM_INT); 
  $status_followee = $stmt_followee->execute();
  $result_followee = $stmt_followee->fetch(PDO::FETCH_ASSOC);


  // follow_table から自分がフォローされているアーティスト数を取得
  $stmt_followed = $pdo->prepare('SELECT COUNT(*) FROM follow_table WHERE followed_id=:followed_id;');
  $stmt_followed->bindValue(':followed_id', $user_id, PDO::PARAM_INT); 
  $status_followed = $stmt_followed->execute();
  $result_followed = $stmt_followed->fetch(PDO::FETCH_ASSOC);


  // inner join で follow_table と user_table を接続。自分がフォローしている人を取得
    $stmt_join_follow_art = $pdo->prepare(" SELECT * FROM user_table AS U_T
    INNER JOIN follow_table AS F_T ON F_T.followed_id = U_T.id
    WHERE F_T.followee_id = :followee_id");
    $stmt_join_follow_art->bindValue(':followee_id', $_SESSION["id"], PDO::PARAM_STR);
    $status_join_follow_art = $stmt_join_follow_art->execute();

    $view_join_follow_art = "";
    while($result_join_follow_art = $stmt_join_follow_art->fetch(PDO::FETCH_ASSOC)){
      $view_join_follow_art .= '<tr>';
      $view_join_follow_art .= '<td><a href=""><img class="my_modal__img" src="artist_img/'.$result_join_follow_art["u_img"].'" alt=""></a></td>';
      $view_join_follow_art .= '<td><a href="" class="my_modal__text">'.$result_join_follow_art["u_name"].'</a></td>';
      $view_join_follow_art .= '</tr>';
    }


  // inner join で follow_table と user_table を接続。自分をフォローしている人を取得
    $stmt_join_follower_art = $pdo->prepare(" SELECT * FROM user_table AS U_T
    INNER JOIN follow_table AS F_T ON F_T.followee_id = U_T.id
    WHERE F_T.followed_id = :followed_id");
    $stmt_join_follower_art->bindValue(':followed_id', $_SESSION["id"], PDO::PARAM_STR);
    $status_join_follower_art = $stmt_join_follower_art->execute();

    $view_join_follower_art = "";
    while($result_join_follower_art = $stmt_join_follower_art->fetch(PDO::FETCH_ASSOC)){
      $view_join_follower_art .= '<tr>';
      $view_join_follower_art .= '<td><a href=""><img class="my_modal__img" src="artist_img/'.$result_join_follower_art["u_img"].'" alt=""></a></td>';
      $view_join_follower_art .= '<td><a href="" class="my_modal__text">'.$result_join_follower_art["u_name"].'</a></td>';
      $view_join_follower_art .= '</tr>';
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
    <title>My Profile</title>
</head>
<body>

<!-- ------------------------------------------------------ -->
<!---------------------- ここから header ---------------------->
<!-- ------------------------------------------------------ -->
<header>
<!-- ページ右上のプロフィール写真アイコン -->
<div class="header_space">

    <a href="login/logout_act.php" class="header_space__text">Log out</a>
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
<br>
<br>

<!-- プロフィール -->
<div class="profile">
  <!-- プロフィール写真 -->
    <div>
      <?= $view ?>
    </div>
  <!-- フォロー、フォロワー -->
    <div class="profile__follow_followers">
      <p id="follow" class="profile__follow_followers__btn" href=""><?= $result_followee["COUNT(*)"] ?> Follow</p>
      <p id="follower" class="profile__follow_followers__btn" href=""><?= $result_followed["COUNT(*)"] ?> Follower</p>
    </div>
    <!-- フォロークリック時のモーダル -->
      <div class="modal modal_follow" style="display:none">
          <!-- モーダルの外側の暗い所 -->
              <div class="modal-overlay close_modal"></div>
          <!-- モーダルの本体 -->
              <div class="my_modal">
                <!-- フォロー、フォロワーの切り替え -->
                <div class="my_modal__title">
                  <p class="my_modal__title__follow">Follow</p>
                  <p>Follower</p>
                </div>
                <!-- <hr> -->
                <!-- Follow ユーザー -->
                  <table class="my_modal__artists">
                    <?= $view_join_follow_art ?>
                  </table>
              </div>
      </div>

    <!-- フォロワークリック時のモーダル -->
      <div class="modal modal_follower" style="display:none">
          <!-- モーダルの外側の暗い所 -->
              <div class="modal-overlay close_modal"></div>
          <!-- モーダルの本体 -->
              <div class="my_modal">
                <!-- フォロー、フォロワーの切り替え -->
                <div class="my_modal__title">
                  <p>Follow</p>
                  <p class="my_modal__title__follower">Follower</p>
                </div>
                <!-- <hr> -->
                <!-- Follow ユーザー -->
                  <table class="my_modal__artists">
                    <?= $view_join_follower_art ?>
                  </table>
              </div>
      </div>
  <!-- プロフィール名 -->
    <div class="profile__name">
      <p class="japanese"><?= $result_user["u_name"] ?></p>
      <img class="edit_start_btn" src="other_img/pen.png" alt="">
    </div>
  <!-- ユーザー自己紹介 -->
    <div class="user_des">
      <p class="japanese"><?= $result_user["u_des"] ?></p>
    </div>
</div>

<!-- プロフィール編集中のみ表示 -->
<div class="profile_edit" style="display:none">
    <form method="post" action="profile_act.php" enctype="multipart/form-data">
        <label for="file_upload" class="cms-thumb" >
            <input type="file" id="file_upload" name="u_img" accept="image/*" required>
            <?= $view ?>
        </label>
        <div style="padding-top:12px">
          <input class="profile_input" type="text" name="u_name" value="<?= $result_user["u_name"] ?>">
        </div>

        <br>
        <div>
          <textarea class="profile_textarea japanese" name="u_des" cols="30" rows="10"><?= $result_user["u_des"] ?></textarea>
        </div>

        <div>
          <a class="btn_negative btn">Cancel</a>        <!-- 戻るボタン -->
          <input class="btn_positive btn" type="submit" value="Update">   <!-- 登録ボタン -->
        </div>
    </form>
  </div>


<!-- 自分の作品集 -->
<h2 class="subtitle">Artworks</h2>
<div class="imglist_wrap">
  <ul class="imglist">
      <?= $view_user_art ?>
  </ul>
</div>
  

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


// いいねボタンの色変え-------------------
    // edit_start_btn ボタンを押したら編集画面に切り替え
    $(".edit_start_btn").on("click", function(){
            $(".profile").hide();
            $(".profile_edit").show();
        });

    // btn_negative ボタンを押したら表示モードに戻す
        $(".btn_negative").on("click", function(){
            $(".profile_edit").hide();
            $(".profile").show();
        });

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


// ーーーーーーーーーー 編集時の自作モーダル（modal）関係の動き ーーーーーーーーーー
    // Followボタンを押した後、モーダルを表示させる
    $("#follow").on("click", function () {
            $(".modal_follow").fadeIn("slow");
        });

    // Followerボタンを押した後、モーダルを表示させる
    $("#follower").on("click", function () {
        $(".modal_follower").fadeIn("slow");
    });
    
    // 外枠を押したときモーダルを消す処理
        $(".close_modal").on("click", function () {
            $(".modal").fadeOut("slow");
        });


</script>



</body>
</html>