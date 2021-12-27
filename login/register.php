<!-- ユーザー新規登録画面のページ -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>新規登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/register.css">
</head>
<body>

<h1>新規登録</h1>

<form method="POST" action="register_act.php" enctype="multipart/form-data">
     <label >ユーザーネーム<input type="text" name="u_name"></label><br>
     <label >email<input type="email" name="email"></label><br>
     <label >パスワード：<input type="password" name="u_pass"></label><br>
     <button>アカウント登録</button>
     <a href="login.php">ログイン</a>
</form>



</body>
</html>
