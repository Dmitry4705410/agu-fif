<? include ("proverka.php");?>
<?$_POST['func']($_POST['kyrs']);
//добавить курс
function addcourse($a){
global $link;
$stmt = $link->prepare("SELECT * FROM course WHERE number=:number");
$parametr = ['number' =>$a];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$d=count($data);
    if($d){
        echo"Курс существует, выберите другой";
    }else{
$stmt = $link->prepare("INSERT INTO course (number)
VALUES (:number)");//ЗАЩИТА ОТ ИНЬЕКЦИЙ
$parametr = ['number' => $a];
$stmt->execute($parametr);
$data = $stmt->fetchAll();  
        echo 1;
    }
}
//добавить группу
function addgroup($a){
global $link;
$stmt = $link->prepare("SELECT id FROM groups WHERE name=:name and course_id=:course_id");
$parametr = ['name' =>$_POST['name'],'course_id' =>$_POST['kyrs']];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$d=count($data);
  if($d){
      echo "Группа существует, дайте другое название";
  }else{
$stmt = $link->prepare("INSERT INTO groups (name,course_id)
VALUES (:name,:course_id)");//ЗАЩИТА ОТ ИНЬЕКЦИЙ
$parametr = ['name' =>$_POST['name'],'course_id' =>$_POST['kyrs']];
$stmt->execute($parametr);
$data = $stmt->fetchAll();  
        echo 1;
  }
    
}
//удалить группу
function deleteGroup(){
  global $link;
$stmt = $link->prepare("SELECT id FROM users WHERE group_id=:group_id ");
$parametr = ['group_id' =>$_POST['id']];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$d=count($data); 
   if($d){
       echo"В группе есть ученики, освободите группу";
   }else{
     $stmt = $link->prepare("DELETE FROM groups where id=:id");//ЗАЩИТА ОТ ИНЬЕКЦИЙ
$parametr = ['id' =>$_POST['id']];
$stmt->execute($parametr);
$data = $stmt->fetchAll();  
        echo 1;  
   }   
}
//удалить курс
function deleteCourse(){
  global $link;
  $stmt = $link->prepare("SELECT id FROM groups WHERE course_id=:course_id");
$parametr = ['course_id' =>$_POST['id']];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$d=count($data);
  if($d){
       echo"В курсе есть группы, удалите группы";
  }else{
$stmt = $link->prepare("DELETE FROM course where id=:id");//ЗАЩИТА ОТ ИНЬЕКЦИЙ
$parametr = ['id' =>$_POST['id']];
$stmt->execute($parametr);
$data = $stmt->fetchAll();  
echo 1;   
  }  
}

//при выборе курса, подставляются группы
function vivodcourse(){
   global $link;
$stmt = $link->prepare("SELECT id,name FROM groups WHERE course_id=:course_id");
$parametr = ['course_id' =>$_POST['kyrs']];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$d=count($data);
    if($d){
        $text;
       for($i=0;$i<$d; $i++){
                         if($i==0){
                              $text .="<option value=\"".$data[$i][0]."\" selected=\"selected\">".$data[$i][1]."</option>"; 
                         }else{
                             $text .="<option value=\"".$data[$i][0]."\" >".$data[$i][1]."</option>"; 
                         }
                       
                     } 
        echo $text;
  } 
    
}  

?>