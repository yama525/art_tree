<!-- 各アートの詳細ページ -->


<?php
// session_start(); //session id とれたらここをオープン
include("funcs.php");

// DB 接続
$pdo = db_conn();


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

// echo empty($result_like);
// exit();

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
<p>M.A.D.S.</p>
<hr style="border:0;border-top:1px solid black;">
<p>the digital mixed reality art gallery 7.0</p>

<!-- メニュータブ -->
<ul>
<   li>
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
<!-- アートのタイトル（データベースから表示） -->
<p>Artworks/アートのタイトル</p>

<div>
    <!-- 選択されたアートの画像 （データベースから表示）-->
    <div>
    <img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
    </div>

    <!-- いいねボタン -->
    <div>
        <!-- いいねボタン -->
        <img class="like like_icon" src="other_img/heart_white.png" alt="">
        <!-- いいねキャンセルボタン（いいねは2回押すと取り消されるから） -->
        <img class="like_cancel like_icon" src="other_img/heart_red.png" style="display:none">
    </div>

    <!-- コメント -->
    <div>
    <textarea name="" id="" cols="30" rows="10" placeholder="コメントを入力"></textarea>
    </div>

</div>

<!-- アートのタイトル （データベースから表示）-->
<h2>アートのタイトル</h2>
<!-- アート作成年月日 （データベースから表示）-->
<p>アート作成の年</p>
<!-- アーティスト名（データベースから表示） -->
<p>アーティスト名</p>

<div>
    <!-- データベースから表示 -->
    <p>Title</p>
    <p>アートタイトル</p>
</div>
<div>
    <!-- データベースから表示 -->
    <p>Year</p>
    <p>アート作成の年</p>
</div>
<div>
    <!-- データベースから表示 -->
    <p> Description</p>
    <p>アートの説明文</p>
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
<div>
<p>Business Advisor</p>
</div>

<!-- Advisor 会社の画像とリンク -->
<img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">
<img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt="">

<!-- ページ最下部のやつ -->
<p>© 2021 website by Simone Segalini</p>

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
                    // params.append('id', <?//= $id ?>); // id を上の方で取得してるから活用 OK
                    params.append('id', 1); // テスト用
                    params.append('user_id', 1); 
                    params.append('art_id', 2); 

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
                    // params.append('id', <?//= $id ?>); // id を上の方で取得してるから活用
                    params.append('id', 1); // テスト用
                    params.append('user_id', 1); 
                    params.append('art_id', 2); 

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