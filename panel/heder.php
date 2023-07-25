<link rel="stylesheet" href="heder.css">   
    <div class="heder">
        <script>
        function silka(){
            document.location.href = "panel.php";									}
        </script>
        <div class="heder-center">
           
            <div class="logo">
            <img src="../fotoIcon/logo.png" width="100%"  onclick="silka()" alt="">
            </div>
            
            <div class="menu">
               
                <a href="panel.php" class="menu-cnop"><div class="menu-text">Главная</div></a>
                
                
                
               <div class="menu-cnop fack">
                  
                   <div style="display:flex">
                   <a href="redact.php?post=14" class="menu-text">
                    О факультете
                
                <? include ('../fotoIcon/strelka.php');?></a>
                </div>
                <div class="dop-menu">
                    <a href="redact.php?post=1">История</a><br>
                    <a href="redact.php?post=2">Деканат</a><br>
                    <a href="redact.php?post=3">История факультета</a><br>
                    <a href="redact.php?post=4">Кафедра</a>
                </div>
                </div>
               
                
                <div class="menu-cnop fack">
                  
                   <div style="display:flex">
                   <a href="redact.php?post=13" class="menu-text">
                    Студентам
                
                <? include ('../fotoIcon/strelka.php');?></a>
                </div>
                <div class="dop-menu">
                    <a href="redact.php?post=5">Направления подготовки</a><br>
                    <a href="redact.php?post=6">Почетные студенты</a><br>
                    <a href="redact.php?post=7">Списки студентов</a><br>
                    <a href="redact.php?post=8">Доп. информация</a>
                </div>
                </div>
                
                <div class="menu-cnop fack">
                  
                   <div style="display:flex">
                   <a href="redact.php?post=12" class="menu-text">
                    Нормативные документы
                
                <? include ('../fotoIcon/strelka.php');?></a>
                </div>
                <div class="dop-menu">
                    <a href="redact.php?post=9">Расписание</a><br>
                    <a href="redact.php?post=10">Сессия</a><br>
                    <a href="redact.php?post=11">Эор</a>
                    
                </div>
                </div>
               
                
                <a href="#" class="menu-cnop"><div class="menu-text">Галерея</div></a>
                <?if($role==1){
echo "
<div class=\"menu-cnop fack\">
                  
                   <div style=\"display:flex\">
                   <a href=\"#\" class=\"menu-text\">
                    Расписание
                
                 ";include ('../fotoIcon/strelka.php');echo"  </a>
                </div>
                <div class=\"dop-menu\">
                    <a href=\"users.php\">Пользователи</a><br>
                    <a href=\"#\">Журнал</a><br>
                </div>
                </div>                
";
}?>
                 
            </div>
            
         
            
        </div> 
    </div>
   
   