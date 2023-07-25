<!DOCTYPE html>
<html lang="ru">
<?
   if($_COOKIE['music'] || $_COOKIE['center']){
header("Location:personal-cabinet.php");
} 
    ?>

<head>
    <meta charset="UTF-8">
    <title>Авторизация</title>
    <? include ('global-link.php');?>
    <link rel="stylesheet" href="authorization.css">   
</head>

<body>
    <? include ('heder.php');?>
    <div class="vhod">
        <div class="name-vhod">
        вход
        </div>
        <div class="vhod-block">
           <div class="eror" id="err"></div>
            <form method="post" onsubmit="return false;" id="vhod">
                <input class="input login-input"  id="login" type="text" placeholder="логин" name="login-agu"><br>
               <input class="input pass-input"   id="pass" type="password" placeholder="пароль" name="pass-agu"><br>
              <div class="button-vhod">
                 <input type="button" value="забыл пароль" id="recover" name="recover" class="submit submit-recover">
                <input type="button" value="вход" id="vhods" name="vhod" class="submit-vhod submit"> 
              </div>     
            </form>
        </div>
    </div>
    <script src="obrabotVhod.js"></script>
</body>
</html>
