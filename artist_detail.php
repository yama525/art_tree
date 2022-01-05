<!-- 各アーティストの詳細情報ページ -->


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



// ログインしている user の id（followee_id）と現在の画面のユーザー の user の id（followed_id）を一致させる
$followee_id = $_SESSION["id"]; //ログインしているユーザーのid
// $followed_id = $_GET["user_id"]; // 選択しているアーティストのid
$followed_id = 2; // テスト。本番は↑

// follow_table からのデータ抽出
$stmt_follow = $pdo->prepare('SELECT * FROM follow_table WHERE followee_id=:followee_id && followed_id=:followed_id ');
$stmt_follow->bindValue(':followee_id', $followee_id, PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく
$stmt_follow->bindValue(':followed_id', $followed_id, PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく
$status_follow = $stmt_follow->execute();

$result_follow = $stmt_follow->fetch(PDO::FETCH_ASSOC);

// var_dump($result_follow); // OK
// // echo empty($result_follow);
// exit();


// user_table からのデータ抽出
$user_id = 1; //（仮）本番はクリックしたユーザーの id を取得する
$stmt_user = $pdo->prepare('SELECT * FROM user_table WHERE id=:id');
$stmt_user->bindValue(':id', $user_id, PDO::PARAM_INT); //$id の箇所はセッションID でログイン時から持っておく
$status_user = $stmt_user->execute();

$result_user = $stmt_user->fetch(PDO::FETCH_ASSOC);


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
<!-- アーティスト名（データベースから表示） -->
<p>Artworks/<?= $result_user["u_name"] ?></p>

<!-- 選択されたアーティストの画像 （データベースから表示）-->
<img src="<?= $result_user["u_img"]?>">


<!-- フォローボタン -->
    <div>
        <!-- フォローボタン -->
        <button class="follow follow_btn" >フォロー</button>
        <!-- フォローキャンセルボタン（1回押すとアラートが表示されてフォロー解除の確認をとる） -->
        <button class="follow_cancel follow_btn" style="display:none">フォロー中</button>
    </div>


<!-- アーティストの名前 （データベースから表示）-->
<h2><?= $result_user["u_name"] ?></h2>
<!-- アーティストの自己紹介 （データベースから表示）-->
<p><?= $result_user["u_des"] ?></p>

<!-- 作品集 -->
<h2>Artworks</h2>
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

// ===================================フォロー、フォロワー処理===================================
    // フォロー > フォロー中の表示切り替え処理
        $(".follow").on("click", function () {
            $(".follow_cancel").show();
            $(".follow").hide();
        });


    // フォロー情報のサーバー登録、削除処理-------------------
        // フォローボタンを押した時のサーバーとの非同期通信 axios INSERT
        $(".follow").on("click", function () {  
            const params = new URLSearchParams();
                //Ajax（非同期通信）post 
                    params.append('followee_id', <?= $followee_id ?>); 
                    params.append('followed_id', <?= $followed_id ?>); 

                    //axiosでAjax送信
                    axios.post('ajax_artist_detail_follow.php',params).then(function (response) {
                        console.log(response.data);//通信OK
                    }).catch(function (error) {
                        console.log(error);//通信Error
                    }).then(function () {
                        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
                    });

            });


        // フォロー中 > フォローの表示切り替え処理
            $(".follow_cancel").on("click", function () {
                if(!confirm("フォローを解除しますか？")){
                    return false;
                }else{
                    $(".follow").show();
                    $(".follow_cancel").hide();

                // フォローキャンセルボタンを押した時のサーバーとの非同期通信 axios DELETE
                    const params = new URLSearchParams();
                        //Ajax（非同期通信）post ーーーーーーーー
                            params.append('followee_id', <?= $followee_id ?>); 
                            params.append('followed_id', <?= $followed_id ?>); 

                            //axiosでAjax送信
                            axios.post('ajax_artist_detail_follow_cancel.php',params).then(function (response) {
                                console.log(response.data);//通信OK
                            }).catch(function (error) {
                                console.log(error);//通信Error
                            }).then(function () {
                                console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
                            });

                }
                
            });
            
   // ページ更新時にフォロー中の表示を保持する-------------------
   if(<?= 1* empty($result_follow) ?> != 1){ // 1* を入れないと empty($result_follow) 自体が空白になるのでエラーが起きる
            $(".follow_cancel").show();
            $(".follow").hide();
        }
      


</script>



    
</body>
</html>