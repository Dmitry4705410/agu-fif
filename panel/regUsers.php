<? include ("proverka.php");?>
<?
include ("PHPExcel-1.8/Classes/PHPExcel/IOFactory.php");
$_POST['func']();

function reg(){
  $filename=$_FILES['file']['name'];  
$pach='xlsx/';//путь сохранения
     $whitelist = array('xls', 'xlsx');//разрешенные файлы
     $extension = end(explode('.', $filename));
    if(!in_array($extension, $whitelist)) 
        {
            echo"не верный формат";
        }else{
        if(!opendir($pach)){return 'Директория сохранения файлов, указана неверно!';}
        
         $uploadfile = $pach.basename($_FILES['file']['name']); 
        if(!empty($filename)) 
    {
       // Ограничения размера загружаемого файла 
      if($_FILES[$filename]['size'] > 1024*4*1024) 
       { 
         return("Размер файла превышает 4 мегабайта"); 
          
       }
          // Проверяем загружен ли файл 
       if(is_uploaded_file($_FILES['file']['tmp_name'])) 
       { 
         // Если файл загружен успешно, перемещаем его 
         // из временной директории в конечную 
          if(copy($_FILES['file']['tmp_name'],$uploadfile)) 
         { 
             //echo"Файл успешно загружен. "; //далее вызываем функциюю обработки файла для регистрации пользователей
              exel($pach.$filename);
              
         }  else{
              echo"не является правильно загруженным файлом или
не может быть перемещён из временной директории.";
          }
       }else  
       { 
           echo'ошибка';
          switch($_FILES[$filename]['error']) 
          { 
              case 1: echo "Размер файла превышает допустимый."; 
              break; 
              case 2: echo "Размер файла превышает допустимый."; 
              break; 
              case 3: echo "Загружаемый файл был получен только частично."; 
              break; 
              case 4: echo "Файл не был загружен!"; 
              break; 
          } 
           
       }
        
        
    }else 
    { 
        echo'Не указан файл для загрузки!';     
    } 
    }
}
function exel($src){
    global $link;
    //echo $src;
 $xls = PHPExcel_IOFactory::load($src);
// Первый лист
$xls->setActiveSheetIndex(0);
$sheet = $xls->getActiveSheet();
$infoarry=$sheet->toArray(); 
$stmt = $link->prepare("INSERT INTO users (surname,name,patronymic,year,status,foto,login,pass,phone,post,roleLevel,headman,group_id,hash)VALUES (:surname,:name,:patronymic,:year,1,0,:login,:pass,:phone,1,0,0,:group_id,0)");//ЗАЩИТА ОТ ИНЬЕКЦИЙ


    
foreach($infoarry as $row){
    $row[5]=password_hash($row[5], PASSWORD_DEFAULT);
    array_push($row,$_POST['group'] );
  // print_r($row);
    $parametr = ['surname' =>$row[0],'name' =>$row[1],'patronymic' =>$row[2],'year' =>$row[3],'login' =>$row[4],'pass' =>$row[5],'phone' =>$row[6],'group_id' =>$row[7]];
    $stmt->execute($parametr);
    $data = $stmt->fetchAll();
} 
echo 1;
}
?>
 