 <? include ("conn.php");?>
 <?
$stmt = $link->prepare("SELECT COUNT( * ) FROM  post WHERE vid=0 and dateRelease<now() and visibility = 1 ORDER BY dateRelease DESC");//ЗАЩИТА ОТ ИНЬЕКЦИЙ
$stmt->execute($parametr);
$data = $stmt->fetchAll();

$allnovosti=$data[0][0];
$strs=$_POST["str"];
$str=$strs-1;
$count=12;
$startnovost=$str*$count;
$allstr=$allnovosti/$count;
$allstr=ceil($allstr);

if($str<=$allstr){
$link->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
$stmt = $link->prepare("SELECT id,name,description,img,link,silka FROM post WHERE vid=0 and  dateRelease<now() and visibility = 1 ORDER BY dateRelease DESC LIMIT :nacalo OFFSET :konec");
$parametr = ['nacalo' => $count,'konec' => $startnovost];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$link->setAttribute( PDO::ATTR_EMULATE_PREPARES, true );
$d=count($data);
    $one=0;
    if($d){
        for($i=1;$i<=$d;){
            echo "<div class=\"block-novosti\">";
            
            for($j=0;$j<4;$j++){
             if($one<$d){
                if($data[$one][4]){
                     echo"
                 <div class=\"new\">
           <a  target=\"_blank\" href=\"//".$data[$one][5]."\">   
        <div class=\"hover-new\">
            <div class=\"new-name\"><p>".$data[$one]['name']."</p></div>
            <div class=\"new-opis\"><p>".$data[$one][2]."</p></div>
        </div>
        <img class=\"new-foto\" src=\"../new/".$data[$one][3]."\">
        <input class=\"fotoUp\" type=\"hidden\" value=\"-99\">
       </a>   
        </div>
                ";
                }else{
                   echo"
                 <div class=\"new\">
           
        <div class=\"hover-new\">
            <div class=\"new-name\"><p>".$data[$one]['name']."</p></div>
            <div class=\"new-opis\"><p>".$data[$one][2]."</p></div>
        </div>
        <img class=\"new-foto\" src=\"../new/".$data[$one][3]."\">
        <input class=\"fotoUp\" type=\"hidden\" value=\"".$data[$one][0]."\">
       
        </div>
                ";  
                }
               
                 $one++;
                  $i++;
            } 
                
                
            }
  
            echo "</div>";
        }
        if($strs!=$allstr){
            echo"<div class=\"cnop-novosti-center\">
    <div class=\"cnop-novosti cnop-add-novosti\">ЕЩЁ НОВОСТИ</div>
    </div>";
        }
    
    }
    
}



?>