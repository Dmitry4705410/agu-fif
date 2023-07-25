 <? include ("conn.php");?>
 <?
$stmt = $link->prepare("SELECT id,img_slaid,link,silka FROM post WHERE vid=1 and  dateRelease<now() and visibility = 1 ORDER BY dateRelease DESC ");
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$d=count($data);
echo $d;
if($d){
    echo"
    <link rel=\"stylesheet\" href=\"slaid.css\"> 
<div class=\"slaider\">
   
       <div class=\"cnop-slaid cnop-left\" onclick=\"listSlaider(-1)\"><svg width=\"40px\"  viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
<path d=\"M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM13.79 15C14.08 15.29 14.08 15.77 13.79 16.06C13.64 16.21 13.45 16.28 13.26 16.28C13.07 16.28 12.88 16.21 12.73 16.06L9.2 12.53C8.91 12.24 8.91 11.76 9.2 11.47L12.73 7.94C13.02 7.65 13.5 7.65 13.79 7.94C14.08 8.23 14.08 8.71 13.79 9L10.79 12L13.79 15Z\" fill=\"#292D32\"/>
</svg></div>
       <div class=\"cnop-slaid cnop-rigth\" onclick=\"listSlaider(1)\"><svg width=\"40px\"  viewBox=\"0 0 24 24\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
<path d=\"M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM14.79 12.53L11.26 16.06C11.11 16.21 10.92 16.28 10.73 16.28C10.54 16.28 10.35 16.21 10.2 16.06C9.91 15.77 9.91 15.29 10.2 15L13.2 12L10.2 9C9.91 8.71 9.91 8.23 10.2 7.94C10.49 7.65 10.97 7.65 11.26 7.94L14.79 11.47C15.09 11.76 15.09 12.24 14.79 12.53Z\" fill=\"#292D32\"/>
</svg></div>
   
    <div class=\"slaider-img\" id=\"slaider-img\">
    <div class=\"block-slaider\" id=\"slider_one_img\"><img class=\"img-slaider-a\" ></div>
    ";
     for($i=0;$i<$d;$i++){
    if($data[$i][2]){
        //ссылка
        echo"
        <div class=\"block-slaider\"><a  target=\"_blank\" href=\"//".$data[$i][3]."\"><input class=\"fotoUp\" type=\"hidden\" value=\"-99\"><img class=\"img-slaider-a\" src=\"/new/".$data[$i][1]."\" ></a></div>
        ";
    }else{
        //если пост
         echo"
        <div class=\"block-slaider\"><input class=\"fotoUp\" type=\"hidden\" value=\"".$data[$i][0]."\"><img class=\"img-slaider-a\" src=\"/new/".$data[$i][1]."\" ></div>
        ";
    }
    
}
  echo"</div>
    
</div>";
      
}
?>

        
        
        
    

<script>
strFotos=0;
var elements = document.getElementById("slaider-img");
strFotos = elements.getElementsByTagName('div').length;
    strSlaids=1;
    function listSlaider(a){
        b=(strSlaids+a)*-100;
        strSlaids=strSlaids+a;
        if(b<(strFotos-1)*-100){
            b=-100;
            strSlaids=1;
        }
        if(b>-100){
            b=(strFotos-1)*-100;
            strSlaids=strFotos;
        }
        b=b+'%';
        $('#slider_one_img').css({"margin-left":b});
    }
    var timeSlader= 8000;/*время автослайдера*/
var runSec=8000;/*через сколько запустится слайдер после запуска стр*/
    
window.onload = setTimeout(runslaid, runSec);/*запуск автослайдера после загрузки после ...секунд*/
function runslaid(){
listSlaider(1);
	clearTimeout(tis);				
var tis =setTimeout(runslaid, timeSlader);			
}
</script>