<!-- ユーザーログインのページ -->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>ログイン</title>
</head>
<body>

<form method="POST" action="login_act.php">
  <h1>ログイン</h1>
  <input type="text" name="u_name" placeholder="Username"/>
  <input type="password" name="u_pass" placeholder="Password"/>
  <button>Login</button>
  <a href="register.php">新規登録</a>
  <a href="../home.php">home</a>
</form>
  
</body>
</html>