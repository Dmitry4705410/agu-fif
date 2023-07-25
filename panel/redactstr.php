<? include ("proverka.php");?>
<?
$text=$_POST['text'];
$idstr=$_POST['idstr'];
$text = trim($text);
if(!$idstr){
    echo "ошибка";
return;
}
if(!$text){
echo "заполните текст";
return;
}
$stmt = $link->prepare("UPDATE str set text=:text where id=:id");
$parametr = ['text' =>$text,'id' =>$idstr];
$stmt->execute($parametr);
$data = $stmt->fetchAll(); 
echo 1;  

?>