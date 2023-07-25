<!DOCTYPE html>
<html lang="ru">
<? include ("proverka.php");?>
<? include ("../loading.php");?>
<head>
    <meta charset="UTF-8">
    <title>Новости</title>
     <? include ('../global-link.php');?>
     <link rel="stylesheet" href="../novosti.css">  
</head>
<body>
     <? include ('heder.php');?>
      <? include ('slaidPanel.php');?>
    <div class="cnop-novosti-center"  >
    <div class="cnop-novosti" id="addpost">Добавить новость</div>
    </div>
     <div class="novosti" id="newsNovosti" style="margin-top:10px;">
        </div>
<script>
    $(window).on('load', function(){
        
          $(document).on('click', '.cnop-add-novosti', function() {
             
            newnn();
            this.remove();
        }); 
        
        
     var d1 = document.getElementById('newsNovosti');
        str = 1;
      //  $('#newsNovosti').append('<div class=\"load-center\" id=\"load-img-gif\"><img class=\"load-img\" src=\"../new/load.gif\"></div>'); 
        newnn();
        function newnn() {
            $('.load_glav').css({"display":"block"});
            var msg = new FormData();
            msg.append('str', str);
            $.ajax({
                url: 'newsoutput.php',
                method: 'post',
                processData: false,
                contentType: false,
                data: msg,
                success: function(data) {
                    if (data == 1) {
                        return;
                    } else {
                       // document.getElementById("load-img-gif").remove();
                        d1.insertAdjacentHTML('beforeend', data);
                       $('.load_glav').css({"display":"none"});
                    }
                }
                
            });
             
            str = str + 1;
            
            
        }
        
        
        
     
        
    $('.load_glav').css({"display":"block"});    
    addpost.onclick = add;
    function add() {
        $('.load_glav').css({"display":"block"}); 
            $.ajax({
                    url: 'add.php',
                    method: 'post',
                    success: function (data) {
                        if (data == 1) {
                         document.getElementById("newsNovosti").innerHTML = " ";
                            str=1;
                           setTimeout(newnn, 1000);
                           // newnn();
                            
                           //location.reload();
                        }
                    }
                }); 
        
    }
    

})
    </script>
</body>
</html>