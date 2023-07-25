<!DOCTYPE html>
<html lang="ru">
<? include ("proverka.php");?>
<?if($role!=1){
         header("Location:../index.php"); 
}
    
    ?>
<? include ("../loading.php");?>

<head>
    <meta charset="UTF-8">
    <? include ('../global-link.php');?>
        <link rel="stylesheet" href="users.css">
    <title>Пользователи</title>
</head>
<body>
    <? include ('heder.php');?>
     <? include ("../infoError.php");?>
  <div class="edit_glav">
     <div class="block_name">КОНФИГУРАЦИЯ</div>
      <div class="setting_group">
      
      <div class="info_Group">
       
         <?
$stmt = $link->prepare("SELECT groups.id,groups.name,course.id, course.number , (SELECT COUNT(*) FROM users WHERE group_id= groups.id) from course course left JOIN groups groups on course.id = groups.course_id ORDER BY course.number ASC;");
$stmt->execute($parametr);
$data = $stmt->fetchAll();
$d=count($data);  
          $k;
          for($i=0;$i<$d; $i++){
              if($data[$i][3]==$k){
                  if(!is_null($data[$i][0])){
                  echo"
                  <div class=\"group\">
             ".$data[$i][1]."(".$data[$i][4].")<div class=\"delete_group\">удалить</div>
              <input class=\"group_id\" type=\"hidden\" value=\"".$data[$i][0]."\"> 
          </div>
                  ";
                      }
              }else{
                  
                  $k=$data[$i][3];
                  echo"
                  <div class=\"course\">
           ".$data[$i][3]." КУРС<div class=\"delete_course\">удалить</div>
            <input class=\"course_id\" type=\"hidden\" value=\"".$data[$i][2]."\">
          </div>
                  ";
                  if(!is_null($data[$i][0])){
                      echo"
                  <div class=\"group\">
             ".$data[$i][1]."(".$data[$i][4].")<div class=\"delete_group\">удалить</div>
              <input class=\"group_id\" type=\"hidden\" value=\"".$data[$i][0]."\"> 
          </div>
                  ";
                  }
                  
              }
          }
          ?>
         
          
      </div>
      
      
      <div class="add_course_and_group">
          <div class="block_add_course">
          <div class="info_add_course_and_group">Создание курса</div>
<button class="button_name_course" type="button" onclick="this.nextElementSibling.stepDown()">-</button>
<input type="number" min="1" max="10" value="1" readonly class="name_course">
<button class="button_name_course" type="button" onclick="this.previousElementSibling.stepUp()">+</button>
             <div class="add_course">добавить</div>
              
          </div>
          <div class="block_add_group">
             <div class="info_add_course_and_group">Создание группы</div>
              <input type="text" class="name_group" placeholder="Название группы"> 
              <select class="give_course">
                  <?
$stmt = $link->prepare("SELECT * FROM course ORDER BY number ASC");
$stmt->execute($parametr);
$datas = $stmt->fetchAll();
$d=count($datas);
                  if($d){
                     for($i=0;$i<$d; $i++){
                         if($i==0){
                              echo"<option value=\"".$datas[$i][0]."\" selected=\"selected\">".$datas[$i][1]."КУРС</option>"; 
                         }else{
                             echo"<option value=\"".$datas[$i][0]."\" >".$datas[$i][1]."КУРС</option>"; 
                         }
                       
                     } 
                  }
                  ?>
                  
              </select>
              
              
              
              <div class="add_group">добавить</div>
          </div>
      </div>
      <div class="add_users_block">
         <div class="info_add_course_and_group">Регистрация пользователей</div>
          <select class="add_users_course">
          <?
               if($d){
                     for($i=0;$i<$d; $i++){
                         if($i==0){
                              echo"<option value=\"".$datas[$i][0]."\" selected=\"selected\">".$datas[$i][1]."КУРС</option>"; 
                         }else{
                             echo"<option value=\"".$datas[$i][0]."\" >".$datas[$i][1]."КУРС</option>"; 
                         }
                       
                     } 
                  }
              ?>
          </select>
          <select class="add_users_group">
          //сюда будут подгружаться группы
          </select>
           <label for='input_exel'>
                        <div class="upload_exel_block">
                          <div class="upload_exel">excel(xlsx)</div> 
                        </div>
                    </label>
            <input type="file" id="input_exel"  class="file_input_exel">
            <div class="add_exel_batton">Загрузить</div>
      </div>
      </div>
  </div>
<script>
    //Загрузка файла на сервер, и регистрация пользователей
     $(document).on('click', '.add_exel_batton', function() {
         $('.load_glav').css({"display":"block"});
       
        group = $('.add_users_group').val();
        
         if(group==''){
              error("выберите группу!");
               $('.load_glav').css({"display":"none"});
         }else{
            var msg = new FormData();
            var file = document.getElementById("input_exel").files[0];
            msg.append('func', 'reg');
            msg.append('group', group);
            msg.append('file', file);
         $.ajax({
                url: 'regUsers.php',
                method: 'post',
                processData: false,
                contentType: false,
                data: msg,
                success: function(data) {
                    if (data == 1) {
                        
                        location.reload();
                        //remove.remove();
                        error("Пользователи загружены, сейчас страница перезагрузится");
                        $('.load_glav').css({"display":"none"});
                         
                       
                    } else {
                        $('.load_glav').css({"display":"none"});
                        error(data);
                       
                    }
                }
                
            });
         }
           
        
    });
    
    
    
    if($('.add_users_course').val()!=''){
      vivodcourse();
    }
    //при выборе курса, подставляются группы
    $(document).on('change', '.add_users_course', function() {
      vivodcourse();
        
    });
    function vivodcourse(){
         $('.load_glav').css({"display":"block"});
        $('.add_users_group').empty();
      
            var msg = new FormData();
            msg.append('func', 'vivodcourse');
            msg.append('kyrs', $('.add_users_course').val());
         $.ajax({
                url: 'usersConfig.php',
                method: 'post',
                processData: false,
                contentType: false,
                data: msg,
                success: function(data) {
                    if (data == 1) {
                        
                        //location.reload();
                       
                        $('.load_glav').css({"display":"none"}); 
                       
                    } else {
                        $('.load_glav').css({"display":"none"});
                        $('.add_users_group').prepend(data);
                        //error(data);
                       
                    }
                }
                
            });
    }
    //удаление КУРСА
     $(document).on('click', '.delete_course', function() {
         $('.load_glav').css({"display":"block"});
        id = $(this).siblings('.course_id').val();
        remove=   $(this).parent('.course');
            var msg = new FormData();
            msg.append('func', 'deleteCourse');
            msg.append('id', id);
         $.ajax({
                url: 'usersConfig.php',
                method: 'post',
                processData: false,
                contentType: false,
                data: msg,
                success: function(data) {
                    if (data == 1) {
                        
                        //location.reload();
                        remove.remove();
                        $('.load_glav').css({"display":"none"});
                         
                       
                    } else {
                        $('.load_glav').css({"display":"none"});
                        error(data);
                       
                    }
                }
                
            });
        
    });
    
    //удаление группы
    $(document).on('click', '.delete_group', function() {
         $('.load_glav').css({"display":"block"});
        id = $(this).siblings('.group_id').val();
        remove=   $(this).parent('.group');
            var msg = new FormData();
            msg.append('func', 'deleteGroup');
            msg.append('id', id);
         $.ajax({
                url: 'usersConfig.php',
                method: 'post',
                processData: false,
                contentType: false,
                data: msg,
                success: function(data) {
                    if (data == 1) {
                        
                        //location.reload();
                        remove.remove();
                        $('.load_glav').css({"display":"none"});
                       
                    } else {
                        $('.load_glav').css({"display":"none"});
                       error(data);
                    }
                }
                
            });
        
    });
    
    
    
    //создание группы
    $(document).on('click', '.add_group', function() {
         $('.load_glav').css({"display":"block"});
        var msg = new FormData();
            msg.append('kyrs', $('.give_course').val());
            msg.append('func', 'addgroup');
            msg.append('name', $('.name_group').val());
         $.ajax({
                url: 'usersConfig.php',
                method: 'post',
                processData: false,
                contentType: false,
                data: msg,
                success: function(data) {
                    if (data == 1) {
                        error("Создание прошло успешно. Сейчас страница перезапустится!");
                        location.reload();
                        $('.load_glav').css({"display":"none"});
                    } else {
                        $('.load_glav').css({"display":"none"});
                      error(data);
                    }
                }
                
            });
        
    });
    //создание курса
    $(document).on('click', '.add_course', function() {
         $('.load_glav').css({"display":"block"});
        var msg = new FormData();
            msg.append('kyrs', $('.name_course').val());
            msg.append('func', 'addcourse');
         $.ajax({
                url: 'usersConfig.php',
                method: 'post',
                processData: false,
                contentType: false,
                data: msg,
                success: function(data) {
                    if (data == 1) {
                        
                        location.reload();
                         error("Создание прошло успешно. Сейчас страница перезапустится!");
                        $('.load_glav').css({"display":"none"});
                    } else {
                        $('.load_glav').css({"display":"none"});
                        error(data);
                    }
                }
                
            });
        
    });
    
    </script>
  
</body>
</html>