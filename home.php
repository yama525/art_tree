<!-- サイトのトップページ -->
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


  $stmt_join_follow_art = $pdo->prepare(" SELECT * FROM art_table");
  $status_join_follow_art = $stmt_join_follow_art->execute();
  
  $view_all_art = "";
  while($result_art = $stmt_join_follow_art->fetch(PDO::FETCH_ASSOC)){
    // var_dump($result_join_follow_art["u_img"]);
    $view_all_art .= '<li><img src="art_img/'.$result_art["a_img"].'"></li>';
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
    <title>ArtTree Home</title>
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
<!-- サイトイメージ画像 -->
<img src="art_img/cafe.jpeg" alt="" style="width: 980px; height: 450px; object-fit: cover; object-position: 50% 100%;">

<!-- ---------artworks の見出し--------- -->
<div class="artworks">
    <h1>artworks.</h1>

    <!-- 見出しの下の説明文 -->
    <p>discover the best artworks by selected international artists.</p>

    <!-- artworks の写真一覧（とりあえず５枚） -->
    <ul class="imglist">
    <?=$view_all_art?>

</ul>

    <!-- スクロール時に背景が固定された画像 -->
    <!-- <img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt=""> -->

</div>


<!-- ---------about の見出し--------- -->
<div class="about" id="about">
    
    <h1>about.</h1>
    <p class="about__siteTitle1">M.A.D.S.</p>
    <p class="about__siteTitle2">Art Mediator, Advisor, Dealer, Seeker. </p>

    <p class="about__text">
    M.A.D.S. ART GALLERY is a company operating internationally in the artistic field. It already boasts a contemporary physical venue located in one of the most lively areas of Milan, Italy totally set up with screens 50”, 55”, 60”, 85" vertical and horizontal size, to optimally accomodate all kinds of dimensions and to make the real dimensions of the work stand out, video projectors and touch screen monitors allowing the viewer to zoom and enhance every detail for a great result. It is also equipped with the VR OCULUS virtual reality viewer device to host photos and videos 3D.<br>
    <br>
    M.A.D.S. ART GALLERY is able to create and guarantee a continuous multimedia exhibition with the use of these new video system projection technologies allowing buyers, press, public, collectors and artists to enjoy the exhibitions in streaming all over the world, in every moment, through all its digital channels and achieving sales anywhere in the world, because operating on an international level with media and digital tools, there is no need for someone coming physically in location to close the deal.<br>
    <br>
    It is the first multimedia gallery with this permanent, digital, unique and innovative set-up and the first totally INCLUSIVE gallery: there is no work of art that it cannot exhibit. Whatever the material that composes it, its size, its support. It is a reference point for emerging and established artists, to launch or consolidate their career. A reference point for museums, galleries, institutions, associations, foundations, curators, critics, collectors as one of its primary objectives is to highlight the artist, his talent, his portfolio, making it accessible to an increasingly international audience.<br>
    <br>
    M.A.D.S. has therefore revolutionised the process of presentation of the artworks, increasing the visual quality of the details, their three-dimensionality and materiality through high definition and augmented reality, eliminating costs (as shipping, packaging, insurance, customs), time and bureaucracy, as well as protecting and safeguarding the integrity of the original artworks.<br>
    <br>
    An evolution for the art market, a new trend. Thousands of artists from all over the world find in M.A.D.S. the answer to their needs: exhibition, curatela, advertising, marketing and promotion, aimed to ensure a long-lasting visibility on a worldwide scale, thanks to the team of professionals that includes webmaster, graphic, photographers, video reporters, art curators, art director, commercial director, communications manager, mediators, advisors, dealers, seekers at their service.<br>
    <br>
    In July 2021, M.A.D.S. ART GALLERY opened a new headquarters: a new digital physical gallery based in Fuerteventura, Canary Islands, becoming larger and increasingly international.<br>
    </p>

    <!-- about の動画（一旦ダミー画像入れてます） -->
    <!-- <img src="https://placehold.jp/c4c4c4/ffffff/237x237.png?text=イメージ" alt=""> -->

</div>


<!-- ---------contact. の見出し--------- -->

<h1 id="contact">contact.</h1>
<!-- 連絡先 -->
<p>T. +39 339 52 40 867   |   mads@madsgallery.art</p>
<!-- 説明文と住所 -->
<p>
Guests are received by appointment only, please write us by mail or use the form below specifying the reasons for the request<br>
<br>
Events Locations<br>
Corso San Gottardo 18, 20136 Milan, Italy - Fuerteventura, Canary Islands, Spain
<br>
<br>
</p>


    <!-- お問合せフォーム -->
    <form method="post" action="">
        <div>
            <input type="text" name="" placeholder="Name*" value="">
        </div>
        <div>
            <input type="text" name="" placeholder="Email*" value="">
        </div>
        <div>
            <input type="text" name="" placeholder="Subject*" value="">
        </div>
        <textarea name="" id="" placeholder="Message*" cols="30" rows="10"></textarea>
        <div>
            <input type="submit" value="Send">
        </div>

    </form>

</div>


<!-- ---------会社情報など（全ページ共通--------- -->
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