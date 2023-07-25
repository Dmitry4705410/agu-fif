<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Деканат</title>
     <? include ('global-link.php');?>
     <link rel="stylesheet" href="strinfo.css"> 
</head>
<body>
  
   <?
    include ("conn.php");
    $get=2;
    if($get){
$stmt = $link->prepare("SELECT  text FROM str WHERE  id=:id");
$parametr = ['id' => $get];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
        if(!count($data)){
            header("Location:index.php");
        }
        
    }else{
         header("Location:index.php");
    }  
    ?>
    <? include ('heder.php');?>
    <div class="glavinfo">
        <? echo $data[0][0];?>
    </div>
</body>
</html>