<?
include ("conn.php");
$avtorizacia=0;
if($_COOKIE['music'] || $_COOKIE['center']){
$id=$_COOKIE['center'];
$hash=$_COOKIE['music'];
$stmt = $link->prepare("SELECT hash FROM users WHERE id=:id");
$parametr = ['id' =>$id];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$d=count($data); 
if($d){
    if(password_verify($data[0][0],$hash)){
//echo $id.": авторизован";
        $avtorizacia=1;
    }else{     
        setcookie("music", $hash, time()+60*-30);
        setcookie("center", $id, time()+60*-30);
        header("Location:authorization.php");
    }
}else{
 setcookie("music", $hash, time()+60*-30);
 setcookie("center", $id, time()+60*-30);
 header("Location:authorization.php");
}
     
}else{
    header("Location:authorization.php");
}
?>
