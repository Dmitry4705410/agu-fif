<? include ("proverka.php");?>
<?

$name=$_POST['name-new'];
$opis=$_POST['opis-new'];
$text=$_POST['text'];
$silka=$_POST['silka-new'];
$data=$_POST['data-new'];
$public=$_POST['checkbox_new'];
$vid=$_POST['checkbox_vid'];
$link_sil=$_POST['checkbox_sil'];
$get=$_GET['news'];
$opis = trim($opis);
$text = trim($text);
$name = trim($name);
if(!$name||!$opis||!$text){
 echo "заполните все полня";
    return;
}
if(!$public){
   $public=0; 
}
if(!$vid){
   $vid=0; 
}
if(!$link_sil){
   $link_sil=0; 
}
if(!$get){
   echo"ошибка";
    return;
}

$stmt = $link->prepare("UPDATE post set name=:name,description=:description,text=:text,dateRelease=:dateRelease,visibility=:visibility,vid=:vid,link=:link,silka=:silka where id=:id");
$parametr = ['name' => $name,'description' =>$opis,'text' =>$text,'dateRelease' =>$data,'visibility' =>$public,'vid' =>$vid,'link' =>$link_sil
             ,'silka' =>$silka,'id' =>$get];
$stmt->execute($parametr);
$data = $stmt->fetchAll(); 
echo 1;  
?>