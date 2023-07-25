<!DOCTYPE html>
<html lang="ru">
<? include ("loading.php");?>
<head>
    <meta charset="UTF-8">
    <title>Инженерно-физический факультет АГУ</title>
    <? include ('global-link.php');?>
</head>
<body>

 <? include ('heder.php');?>
<link rel="stylesheet" href="novosti.css"> 
<? include ("slaid.php");?>  
<div class="novosti" id="novosti">

 <div class="hNovosti">Новости</div>
</div>
   <? include ('checknovosti.php');?>
<div class="bottom-info" style="display:none; height:100px;background: #66a0bb;"></div>
<script>
      $(document).on('click', '.new , .block-slaider', function() {
          id = $(this).find('.fotoUp').val();
              if(id!=-99){
          
         $('.load_glav').css({"display":"block"});
            
          
            var msgid = new FormData();
            msgid.append('id', id);
            $.ajax({
                url: 'vivodNovosti.php',
                method: 'post',
                processData: false,
                contentType: false,
                data: msgid,
                success: function(data) {
                    if (data == 1) {
                        return;
                    } else {
                        $('.img_slaider_new').empty();
                        $('.text_novosti_primer').empty();
                         $('.editor_op').css({"display":"block"});
                         hit=$('.primer_novosti_glav').width();
    hit = hit*0.30*1.4;
    $('.text_novosti_primer').css({"height":hit});
                         $( ".img_slaider_new" ).append( $.parseJSON(data)[2]);
                         $( ".text_novosti_primer" ).append( $.parseJSON(data)[0]);
                        $('.load_glav').css({"display":"none"});
                        
                        strFoto=0;
    fotoSliderStr();
    
    function fotoSliderStr(){
      var element = document.getElementById("img_slaider_new");
     strFoto = element.getElementsByTagName('*').length;
    if(strFoto-1==0){
       $('.slaider_bovosti_primer').css({"display":"none"});
       $('.text_novosti_primer').css({"width":"100%"});
       }else{
           $('.slaider_bovosti_primer').css({"display":"block"});
       $('.text_novosti_primer').css({"width":"65%"});
       } 
        if(strFoto-1>=2){
            $('.strilka').css({"display":"block"});
           }
    }
                        
                        
                    }
                }
            });
      }
        });
   
    $(document).click('on', function(e) {
  var box = $('.editor-glav');
  if (!box.is(e.target) && box.has(e.target).length === 0) {
   $('.editor_op').css({"display":"none"});
       $('.strilka').css({"display":"none"});
  }
});
    
   strSlaid=1;
    function listSlaiders(a){
        b=(strSlaid+a)*-100;
        strSlaid=strSlaid+a;
        if(b<(strFoto-1)*-100){
            b=-100;
            strSlaid=1;
        }
        if(b>-100){
            b=(strFoto-1)*-100;
            strSlaid=strFoto;
        }
        b=b+'%';
        $('#slider_one_new').css({"margin-left":b});
    } 

    
    $(document).on('click', '.cnop-add-novosti', function() {
             
            newnn();
            this.remove();
        }); 
        
        
     var d1 = document.getElementById('novosti');
        str = 1;
      
        newnn();
        function newnn() {
            $('.load_glav').css({"display":"block"});
            var msg = new FormData();
            msg.append('str', str);
            $.ajax({
                url: 'postoutput.php',
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
                        
                            $('.bottom-info').css({"display":"block"});
                           
                    }
                }
                
            });
             
            str = str + 1;
            
            
        }
           

    </script>
</body>
</html>