<link rel="stylesheet" href="heder.css">   
    <div class="heder">
        <script>
        function silka(){
            document.location.href = "/";									}
        </script>
        <div class="heder-center">
           
            <div class="logo">
            <img src="fotoIcon/logo.png" width="100%"  onclick="silka()" alt="">
            </div>
            
            <div class="menu">
               
                <a href="/" class="menu-cnop"><div class="menu-text">Главная</div></a>
                
                
                
               <div class="menu-cnop fack">
                  
                   <div style="display:flex">
                   <a href="#" class="menu-text">
                    О факультете
                
                <? include ('fotoIcon/strelka.php');?></a>
                </div>
                <div class="dop-menu">
                    <a href="/history.php">История</a><br>
                    <a href="/deansoffice.php">Деканат</a><br>
                    <a href="#">История факультета</a><br>
                    <a href="#">Кафедра</a>
                </div>
                </div>
               
                
                <div class="menu-cnop fack">
                  
                   <div style="display:flex">
                   <a href="#" class="menu-text">
                    Студентам
                
                <? include ('fotoIcon/strelka.php');?></a>
                </div>
                <div class="dop-menu">
                    <a href="#">Направления подготовки</a><br>
                    <a href="#">Почетные студенты</a><br>
                    <a href="#">Списки студентов</a><br>
                    <a href="#">Доп. информация</a>
                </div>
                </div>
                
                <div class="menu-cnop fack">
                  
                   <div style="display:flex">
                   <a href="#" class="menu-text">
                    Нормативные документы
                
                <? include ('fotoIcon/strelka.php');?></a>
                </div>
                <div class="dop-menu">
                    <a href="#">Расписание</a><br>
                    <a href="#">Сессия</a><br>
                    <a href="#">Эор</a>
                    
                </div>
                </div>
                
                <a href="#" class="menu-cnop"><div class="menu-text">Галерея</div></a>
            </div>
            
            <div class="social">
                <div class="social-icon">
                    <a href="/personal-cabinet.php"><? include ('fotoIcon/lk.php');?></a>
                </div>
                <div class="social-icon">
                    <a href="#"><? include ('fotoIcon/telega.php');?></a>
                </div>
                <div class="social-icon">
                    <a href="https://vk.com/agufif"><? include ('fotoIcon/vk.php');?></a>
                </div>
                <div class="social-icon">
                    <a href="#"><? include ('fotoIcon/inst.php');?></a>
                </div>
            </div>
            <div class="mobil-menu">
                <div class="mobil-menu-element"></div>
                <div class="mobil-menu-element"></div>
                <div class="mobil-menu-element"></div>
            </div>
        </div> 
    </div>
    <div class="smol-menu">
        <div class= "smol-center">
            <div class="smol-center-left">
             <a href="index.php" class="menu-cnop-smol"><div class="menu-text">Главная</div></a>
                
                
                <a  class="menu-cnop-smol fun1">
                   <div style="display:flex">
                   <div class="menu-text">
                    О факультете
                    <? include ('fotoIcon/strelka.php');?>
                </div>
                
                </div>
                </a>
                <div class="dop-menu-mobil e1">
                    <a href="/history.php">История</a><br>
                    <a href="/deansoffice.php">Деканат</a><br>
                    <a href="#">История факультета</a><br>
                    <a href="#">Кафедра</a>
                </div>
                
                
                <a  class="menu-cnop-smol fun3">
                   <div style="display:flex">
                   <div class="menu-text">
                    Студентам
                    <? include ('fotoIcon/strelka.php');?>
                </div>
                
                </div>
                </a>
                <div class="dop-menu-mobil e3">
                   <a href="#">Направления подготовки</a><br>
                    <a href="#">Почетные студенты</a><br>
                    <a href="#">Списки студентов</a><br>
                    <a href="#">Доп. информация</a>
                </div>
                
                
                
                <a  class="menu-cnop-smol fun2">
                   <div style="display:flex">
                   <div class="menu-text">
                    Нормативные документы
                    <? include ('fotoIcon/strelka.php');?>
                </div>
                
                </div>
                </a>
                <div class="dop-menu-mobil e2">
                    <a href="#">Расписание</a><br>
                    <a href="#">Сессия</a><br>
                    <a href="#">Эор</a>
                </div>
                
                
                
                
                
               
                
                <a href="#" class="menu-cnop-smol"><div class="menu-text">Галерея</div></a>
                <div class="social-mobil">
                <div class="social-icon">
                    <a href="/personal-cabinet.php"><? include ('fotoIcon/lk.php');?></a>
                </div>
                <div class="social-icon">
                    <a href="#"><? include ('fotoIcon/telega.php');?></a>
                </div>
                <div class="social-icon">
                    <a href="https://vk.com/agufif"><? include ('fotoIcon/vk.php');?></a>
                </div>
                <div class="social-icon">
                    <a href="#"><? include ('fotoIcon/inst.php');?></a>
                </div>
            </div>
            </div>
            <div class="smol-menu-close">
                <div class="menu-close close-left"></div>
                <div class="menu-close close-right"></div>
            </div>
            </div>
        </div>
    <script>
    $(document).on('click', '.smol-menu-close', function() {
    $('.smol-menu').css('display', 'none');    
        });
        
        $(document).on('click', '.fun1', function() {
           $('.e1').css('display', 'block');
        });
        
        $(document).on('click', '.fun2', function() {
           $('.e2').css('display', 'block');
        });
        
        $(document).on('click', '.fun3', function() {
           $('.e3').css('display', 'block');
        });
        
        
        $(document).on('click', '.mobil-menu', function() {
    $('.smol-menu').show();    
        });
    </script>