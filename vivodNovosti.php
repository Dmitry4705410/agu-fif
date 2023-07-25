 <? include ("conn.php");?>
<?

$get=$_POST['id'];
 if($get){
     
$stmt = $link->prepare("SELECT   text FROM post WHERE  id=:id");
$parametr = ['id' => $get];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
        if(!count($data)){
            header("Location:index.php");
        }
        
    }else{
         header("Location:index.php");
    }
    $stmt = $link->prepare("SELECT   images FROM imgpost WHERE  idPost=:idPost");
    $parametr = ['idPost' => $get];
    $stmt->execute($parametr);
    $datas = $stmt->fetchAll();

$img = "<img src=\"/new/PHOTO1754694383220221228215840603.jpg\" class=\"foto_slaider_new\" id=\"slider_one_new\">";
if(count($datas)){
                  for($i=0;$i<count($datas);$i++){
                      $img.="<img src=\"/new/".$datas[$i][0]."\"class=\"foto_slaider_new\"> ";
                  }
}
$content = array($data[0][0] , count($datas),$img);

echo json_encode($content);

?>