<!-- ユーザーログインのページ -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-2.1.0.min.js" ></script>
    <title> Login</title>
</head>

<body>
<div id="formWrapper">

<div id="form">
<div class="logo">
    <img class="logo_img" src="../other_img/logo.png" alt="">
</div>
    <form method="POST" action="login_act.php">

        <div class="form-item">
            <p class="formLabel">Username</p>
            <input type="text" name="u_name" id="email" class="form-style" autocomplete="off"/>
        </div>
        <div class="form-item">
            <p class="formLabel">Password</p>
            <input type="password" name="u_pass" id="password" class="form-style" />
            <!-- <div class="pw-view"><i class="fa fa-eye"></i></div> -->
            <p><a href="#" ><small>Forgot Password ?</small></a></p>  
        </div>
        <div class="form-item">
            <p class="pull-left"><a href="register.php"><small>Register</small></a></p>
            <input type="submit" class="login pull-right" value="Log In">
            <div class="clear-fix"></div>
        </div>
    </form>
</div>
</div>


<style>
    body{
   background: url(http://www.timurtek.com/wp-content/uploads/2014/10/form-bg.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  font-family:'HelveticaNeue','Arial', sans-serif;

}
a{color:#A71286;text-decoration: none;}
a:hover{color:#aaa; }
.pull-right{float: right;}
.pull-left{float: left;}
.clear-fix{clear:both;}
div.logo{text-align: center; margin: 20px 20px 30px 20px; fill: #566375;}
div.logo svg{
  width:180px;
  height:100px;
}
.logo_img{
    width: 170px;
}
.logo-active{fill: #44aacc !important;}
#formWrapper{
  background: rgba(0,0,0,.2); 
  width:100%; 
  height:100%; 
  position: absolute; 
  top:0; 
  left:0;
  transition:all .3s ease;}
.darken-bg{background: rgba(0,0,0,.5) !important; transition:all .3s ease;}

div#form{
  position: absolute;
  width:360px;
  height:320px;
  height:auto;
  background-color: #fff;
  margin:auto;
  border-radius: 5px;
  padding:20px;
  left:50%;
  top:44%;
  margin-left:-200px;
  margin-top:-200px;
}
div.form-item{position: relative; display: block; margin-bottom: 20px;}
 input{transition: all .2s ease;}
 input.form-style{
  color:#8a8a8a;
  display: block;
  width: 90%;
  height: 44px;
  padding: 5px 5%;
  border:1px solid #ccc;
  -moz-border-radius: 27px;
  -webkit-border-radius: 27px;
  border-radius: 27px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  background-color: #fff;
  font-family:'HelveticaNeue','Arial', sans-serif;
  font-size: 105%;
  letter-spacing: .8px;
}
div.form-item .form-style:focus{outline: none; border:1px solid #A71286; color:#A71286; }
div.form-item p.formLabel {
  position: absolute;
  left:26px;
  top:2px;
  transition:all .4s ease;
  color:#bbb;}
.formTop{top:-22px !important; left:26px; background-color: #fff; padding:0 5px; font-size: 14px; color:#A71286 !important;}
.formStatus{color:#8a8a8a !important;}
input[type="submit"].login{
  float:right;
  width: 112px;
  height: 37px;
  -moz-border-radius: 19px;
  -webkit-border-radius: 19px;
  border-radius: 19px;
  -moz-background-clip: padding;
  -webkit-background-clip: padding-box;
  background-clip: padding-box;
  background-color: #A71286;
  border:1px solid #A71286;
  border:none;
  color: #fff;
  font-weight: bold;
}
input[type="submit"].login:hover{background-color: #fff; border:1px solid #A71286; color:#A71286; cursor:pointer;}
input[type="submit"].login:focus{outline: none;}
</style>

<script>
    $(document).ready(function(){
  var formInputs = $('input[type="text"],input[type="password"]');
  formInputs.focus(function() {
       $(this).parent().children('p.formLabel').addClass('formTop');
       $('div#formWrapper').addClass('darken-bg');
       $('div.logo').addClass('logo-active');
  });
  formInputs.focusout(function() {
    if ($.trim($(this).val()).length == 0){
    $(this).parent().children('p.formLabel').removeClass('formTop');
    }
    $('div#formWrapper').removeClass('darken-bg');
    $('div.logo').removeClass('logo-active');
  });
  $('p.formLabel').click(function(){
     $(this).parent().children('.form-style').focus();
  });
});
</script>

</body>
</html>