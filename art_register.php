<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Main[Start] -->
<form method="POST" action="art_insert.php" enctype="multipart/form-data">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
     <label>作品画像：<input type="file" name="a_img" ></label><br>
     <label>タイトル：<input type="text" name="a_title"></label><br>
     <label>作品紹介<textArea name="a_des" rows="2" cols="20"></textArea></label><br>
     <label>制作年：<input type="text" name="a_year"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
