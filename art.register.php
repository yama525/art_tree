<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<form method="POST" action="art_insert.php" enctype="multipart/form-data">
  <div class="jumbotron">
   <fieldset>
    <legend>フリーアンケート</legend>
<!-- <<<<<<< joooooji -->
<!-- ======= -->
     <label>名前：<input type="text" name="name"></label><br>
     <label>Email：<input type="text" name="email"></label><br>
<!-- >>>>>>> master -->
     <label>画像：<input type="file" name="upfile" ></label><br>
     <label><textArea name="naiyou" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>

  
</body>
</html>