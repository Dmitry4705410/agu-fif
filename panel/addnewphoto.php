<? include ("proverka.php");?>
<?

$foto=$_FILES['file']['name'];
$infoFoto = pathinfo($foto, PATHINFO_EXTENSION);
if($foto){
$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG);
$detectedType = exif_imagetype($_FILES['file']['tmp_name']);
$error = !in_array($detectedType, $allowedTypes);
if($error){
    echo"1";
    return;
}
    //загрузка  фото
    $ff=@date('YmdHis').rand(100,1000);
    $filename   = $_FILES['file']['name'];
    $new  = rand(0000,99999999999);
    $newfilename=$new.$ff.".".$infoFoto;
$file = "../new/".$newfilename;
move_uploaded_file($_FILES['file']['tmp_name'], $file );
}

// оригинальное изображение
$filename = $file;
//die(print_r($_POST));
$failnamenew="PHOTO".$newfilename;
$new_filename = "../new/".$failnamenew;

// получаем размеры изображения
list($current_width, $current_height) = getimagesize($filename);
$pogreh=$current_width/500;

// координаты x и y оригинального изображение, где мы
// будем вырезать фрагмент, по данным, берущимся из формы

$x1    = $_POST['x1']*$pogreh;
$y1    = $_POST['y1']*$pogreh;
$x2    = $_POST['x2']*$pogreh;
$y2    = $_POST['y2']*$pogreh;
$w    = $_POST['w']*$pogreh;
$h    = $_POST['h']*$pogreh;     
$get    = $_POST['get'];     
$slaider    = $_POST['slaider'];     

//die(print_r($_POST));

// финальные размеры изображения
if($slaider==1){
$crop_width = 880;
$crop_height = 1232;
}else if($slaider==0){
  $crop_width = 880;
$crop_height = 880;  
}
else if($slaider==2){
  $crop_width = 1800;
$crop_height = 900;  
}

// создаём маленькое изображение
$new = imagecreatetruecolor($crop_width, $crop_height);
// создаём оригинальное изображение

if($infoFoto=="png"){
$current_image = imagecreatefrompng($filename);
}else{
   $current_image = imagecreatefromjpeg($filename); 
}
//вырезаем
imagecopyresampled($new, $current_image, 0, 0, $x1, $y1, $crop_width, $crop_height, $w, $h);
// создаём новое изображение
if($infoFoto=="png"){
    imagepng($new, $new_filename,9);
}else{
    imagejpeg($new, $new_filename, 100);
}

unlink($file);

if($slaider==1){
$stmt = $link->prepare("INSERT INTO imgpost (idPost,images)VALUES (:idPost, :images)");
$parametr = ['images' => $failnamenew,'idPost' =>$get];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
    
$stmt = $link->prepare("SELECT id FROM imgpost WHERE id=LAST_INSERT_ID();");
$stmt->execute($parametr);
$data1 = $stmt->fetchAll();
    
$content = array($failnamenew, $data1[0][0]); 
echo json_encode($content);
//echo $failnamenew;   
}else if($slaider==0){
$stmt = $link->prepare("UPDATE post set img=:img where id=:id");
$parametr = ['img' => $failnamenew,'id' =>$get];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
echo $failnamenew;   
}else if($slaider==2){
$stmt = $link->prepare("UPDATE post set img_slaid=:img where id=:id");
$parametr = ['img' => $failnamenew,'id' =>$get];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
echo $failnamenew;   
}
