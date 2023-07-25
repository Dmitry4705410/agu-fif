<? include ("proverka.php");?>
<?
$stmt = $link->prepare("DELETE FROM post
WHERE id=:id");
$parametr = ['id' => $_POST['gets']];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
echo 1;
?>