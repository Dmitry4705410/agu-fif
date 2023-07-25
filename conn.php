<?
$link = new PDO('mysql:host=localhost;dbname=agu_fif','root','root');
//$link->exec("SET NAMES UTF8");
$link->exec("set names utf8mb4_unicode_ci");
if($link)
{
//echo"связь есть<br>";
}else{
    header("Location: eror.php");
}

?>






