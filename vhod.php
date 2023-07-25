<?
include ("conn.php");
$log=$_POST['login-agu'];$log=htmlspecialchars($log);
$pas=$_POST['pass-agu'];$pas=htmlspecialchars($pas);
if(($log)&&($pas)){
$stmt = $link->prepare("SELECT login,pass,id,hash FROM users WHERE login=:login");
$parametr = ['login' =>$log];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$d=count($data); 
    if($d){
        if(password_verify($pas,$data[0][1])){
            $hash=password_hash($data[0][3], PASSWORD_DEFAULT);
            $id=$data[0][2];
             setcookie("music", $hash, time()+60*60*24*30,"/");
             setcookie("center", $id, time()+60*60*24*30,"/");
            echo "1";
        }else{
             echo"не верный пароль";
        }
    }else{
         echo"не верный пароль";
    }
}
?>