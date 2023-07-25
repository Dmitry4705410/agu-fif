<? include ("proverka.php");?>
<?
$stmt = $link->prepare("DELETE FROM imgpost
WHERE id=:id");
$parametr = ['id' => $_POST['id']];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
echo 1;

?>