<!-- 各アートの詳細ページ -->


<?php
// session_start(); //session id とれたらここをオープン
include("funcs.php");

$a_img=$_GET["a_img"];
$a_title=$_GET["a_title"];
$a_des=$_GET["a_des"];
$a_year=$_GET["a_year"];

// var_dump($a_year);
// exit();

// DB 接続
$pdo = db_conn();


// 右上アイコンで u_img がない場合はダミー画像、ある場合は u_img を表示。
if($_SESSION["u_img"] == null){
    $view_profile_icon = '<a href="profile.php"><img class="header_space__img" src="https://placehold.jp/24/e3e3e6/ffffff/200x200.png?text=%E3%83%97%E3%83%AD%E3%83%95%E3%82%A3%E3%83%BC%E3%83%AB%0A%E7%94%BB%E5%83%8F%E3%82%92%E8%BF%BD%E5%8A%A0" alt="プロフィール画像"></a>';
  }else{
    $view_profile_icon = '<a href="profile.php"><img class="header_space__img" src="artist_img/'.$_SESSION["u_img"].'" alt="プロフィール画像"></a>';
  }


// いいね処理----------
    // ログインしている user の id とlike_table の user_id を一致させる
    // $user_id = $_SESSION["user_id"]; //session id とれたらここをオープン
    // $art_id = $_SESSION["art_id"]; //session id とれたらここをオープン
    $user_id = 1; // テスト。本番は↑
    $art_id = 2; // テスト。本番は↑

    // データ抽出
    $stmt_like = $pdo->prepare('SELECT * FROM like_table WHERE user_id=:user_id && art_id=:art_id ');
    $stmt_like->bindValue(':user_id', $user_id, PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく
    $stmt_like->bindValue(':art_id', $art_id, PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく
    $status_like = $stmt_like->execute();

    $result_like = $stmt_like->fetch(PDO::FETCH_ASSOC);
    // var_dump($result_like); // OK
    // exit();


// コメント処理----------
    // 定義
    $art_id = 2; // 仮

    // データ抽出
    $stmt_comment = $pdo->prepare('SELECT * FROM comment_table WHERE art_id=:art_id ORDER BY indate DESC');
    $stmt_comment->bindValue(':art_id', $art_id, PDO::PARAM_INT); 
    $status_comment = $stmt_comment->execute();
    // $result_comment = $stmt_comment->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($result_comment); // OK
    // exit();

    $view_comment = "";
    while($result_comment = $stmt_comment->fetch(PDO::FETCH_ASSOC)){
        $view_comment .= '<div>';
        $view_comment .= '<p>'.$result_comment["comment"].'</p>';
        $view_comment .= '</div>';
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
    <title>Art Detail</title>
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
<!-- アートのタイトル（データベースから表示） -->
<p class="main_guide_text">Artworks/<?=$a_title?></p>

<div>
    <!-- 選択されたアートの画像 （データベースから表示）-->
        <div>
        <img src="art_img\<?=$a_img?>" alt="" width="600">
        </div>

    <!-- いいねボタン -->
        <div>
            <!-- いいねボタン -->
            <img class="like like_icon" src="other_img/heart_white.png" alt="">
            <!-- いいねキャンセルボタン（いいねは2回押すと取り消されるから） -->
            <img class="like_cancel like_icon" src="other_img/heart_red.png" style="display:none">
        </div>

    <!-- コメント入力欄 -->
        <form method="post" action="art_detail_comment.php">
            <div>
                <textarea name="comment" id="" cols="30" rows="10" placeholder="コメントを入力"></textarea>
            </div>
    <!-- コメント投稿ボタン -->
            <div>
                <input type="submit" class="post_comment" value="投稿">
            </div>
        </form>

    <!-- コメント表示箇所 -->
        <?= $view_comment ?>

</div>


<div>
    <!-- データベースから表示 -->
    <p>Title</p>
    <p><?=$a_title?></p>
</div>
<div>
    <!-- データベースから表示 -->
    <p>Year</p>
    <p><?=$a_year?></p>
</div>
<div>
    <!-- データベースから表示 -->
    <p> Description</p>
    <p><?=$a_des?></p>
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




<!-- ======================================================================================== -->
<!-- =========================================script========================================= -->
<!-- ======================================================================================== -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>


// ===================================いいね処理===================================
    // いいねボタンの色変え-------------------
        // Like ボタンを押したら白→赤に変更
            $(".like").on("click", function(){
                $(".like").hide();
                $(".like_cancel").show();
            });

        // Liked ボタンを押したら赤→白に変更
            $(".like_cancel").on("click", function(){
                $(".like_cancel").hide();
                $(".like").show();
            });



    // user_id > 1
    // art_id > 2 と仮定→params.appendの箇所を修正する！

    // いいね情報のサーバー登録、削除処理-------------------
        // いいねボタンを押した時のサーバーとの非同期通信 axios INSERT
            $(".like").on("click", function () {  // on を押すとオフにする処理
            const params = new URLSearchParams();
                //Ajax（非同期通信）post 
                    params.append('user_id', <?= $user_id ?>); 
                    params.append('art_id', <?= $art_id ?>); 

                    //axiosでAjax送信
                    axios.post('ajax_art_detail_like.php',params).then(function (response) {
                        console.log(response.data);//通信OK
                    }).catch(function (error) {
                        console.log(error);//通信Error
                    }).then(function () {
                        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
                    });

            });

        // いいねキャンセルボタンを押した時のサーバーとの非同期通信 axios DELETE

            $(".like_cancel").on("click", function () {
            const params = new URLSearchParams();

                //Ajax（非同期通信）post ーーーーーーーー
                    params.append('user_id', <?= $user_id ?>); 
                    params.append('art_id', <?= $art_id ?>); 

                    //axiosでAjax送信
                    axios.post('ajax_art_detail_like_cancel.php',params).then(function (response) {
                        console.log(response.data);//通信OK
                    }).catch(function (error) {
                        console.log(error);//通信Error
                    }).then(function () {
                        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
                    });

            });


    // ページ更新時にいいねの表示を保持する-------------------
        if(<?= 1* empty($result_like) ?> != 1){ // 1* を入れないと empty($result_like) が空白になるのでエラーが起きる
            $(".like_cancel").show();
            $(".like").hide();
        }
      















</script>




    
</body>
</html>