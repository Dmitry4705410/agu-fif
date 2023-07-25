
 <? include ("proverka.php");?>
 <?


$stmt = $link->prepare("SELECT COUNT( * ) FROM  post WHERE vid=0 and  dateRelease<now() ORDER BY dateRelease DESC");//ЗАЩИТА ОТ ИНЬЕКЦИЙ
$stmt->execute($parametr);
$data = $stmt->fetchAll();

$allnovosti=$data[0][0];
$strs=$_POST["str"];
$str=$strs-1;
$count=8;
$startnovost=$str*$count;
$allstr=$allnovosti/$count;
$allstr=ceil($allstr);

if($str<=$allstr){
$link->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
$stmt = $link->prepare("SELECT id,name,description,img FROM post WHERE vid=0 and dateRelease<now() ORDER BY dateRelease DESC LIMIT :nacalo OFFSET :konec");
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
                
                echo"
                 <div class=\"new\">
           <a href=\"newsEditor.php?news=".$data[$one][0]."\">   
        <div class=\"hover-new\">
            <div class=\"new-name\"><p>".$data[$one]['name']."</p></div>
            <div class=\"new-opis\"><p>".$data[$one][2]."</p></div>
        </div>
        <img class=\"new-foto\" src=\"../new/".$data[$one][3]."\">
        <input class=\"fotoUp\" type=\"hidden\" value=\"".$data[$one][0]."\">
        </a>   
        </div>
                ";
                 $one++;
                  $i++;
            } 
                
                
            }
  
            echo "</div>";
        }
    echo"<div class=\"cnop-novosti-center\">
    <div class=\"cnop-novosti cnop-add-novosti\">ЕЩЁ НОВОСТИ</div>
    </div>";
    }
    
}

    ?>