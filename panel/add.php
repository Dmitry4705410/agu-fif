<?
include ("proverka.php");
$today = date("Y-m-d H:i:s"); 
$stmt = $link->prepare("INSERT INTO post (name,text,description,dataAdd,dateRelease,idUser,img,img_slaid,silka)
VALUES (:name, :text,:description, :data,:dateRelease, :idUser, :img,:img_slaid,:silka)");//ЗАЩИТА ОТ ИНЬЕКЦИЙ
$parametr = ['name' => 'новый пост','text' => 'текст поста','description' => 'описание','data' => $today,'dateRelease' => $today,'idUser' => $id,'img' => 'nofoto.jpg','img_slaid' => 'nofotoSlaid.jpg','silka' => ''];
$stmt->execute($parametr);
$data = $stmt->fetchAll(); 
echo "1";
?>