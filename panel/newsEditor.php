<!DOCTYPE html>
<html lang="ru">
<? include ("proverka.php");?>
<? include ("../loading.php");?>

<?
    $get=$_GET['news'];
    if($get){
$stmt = $link->prepare("SELECT   id,name,description,text,DATE_FORMAT(dateRelease, '%Y-%m-%dT%H:%i') AS dateRelease,DATE_FORMAT(dataAdd, '%Y-%m-%d %H:%i') AS dataAdd, visibility ,img, vid,img_slaid,link,silka FROM post WHERE  id=:id");
$parametr = ['id' => $get];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
        if(!count($data)){
            header("Location:panel.php");
        }
        
    }else{
         header("Location:panel.php");
    }
    $stmt = $link->prepare("SELECT   id,images FROM imgpost WHERE  idPost=:idPost");
    $parametr = ['idPost' => $get];
    $stmt->execute($parametr);
    $datas = $stmt->fetchAll();
    
    
    ?>

<head>
    <meta charset="UTF-8">
    <title>Редактор Новостей</title>
    <? include ('../global-link.php');?>
    
    <link rel="stylesheet" href="../novosti.css">
    <link rel="stylesheet" href="editor.css">
</head>

<body>
 
    <? include ('heder.php');?>
    <? include ("newphoto.php");?>
   
     <div class="example_new_mini" >
     <div class="new" style="width:30%;" id="foto-click" onclick="newphotoOn()">
        <div class="hover-new">
            <div class="new-name"><p id="nn"><? echo $data[0][1];?></p></div>
            <div class="new-opis"><p id="no"><? echo $data[0][2];?> ...</p></div>
        </div>
        <img class="new-foto" id="foto-glav" src="../new/<? echo $data[0][7];?>">
        </div>
      <div class="addFoto_slaider">
          <div class="cpoAdd_slaider" onclick="newphotoOnslaider()">Добавить фото на слайдер</div>
          <div class="slider_glav_omg">
          <?
              if(count($datas)){
                  for($i=0;$i<count($datas);$i++){
                      echo "
                      <div class=\"foto_slaid_num\">
       <div class=\"newsImg \" ><img class=\"fotoUps\" src=\"/new/".$datas[$i][1]."\" ></div>
       <input class=\"fotoUp\" type=\"hidden\" value=\"".$datas[$i][0]."\">
       </div>
                      ";
                  }
              }
              ?>
         
       
       
       </div>
      </div>
    </div>
     <div class="slider_img" onclick="newfotoSlaiderVid()" >
    <img class="foto-slaider" id="foto-slaider" src="../new/<? echo $data[0][9];?>">
    </div>
    <div class="editor-glav">
        <form method="post" id="addnovostiNEW" name="addnovostiNEW" onsubmit="return false;">
           <div class="block_seting_post">
           <div class="block_siting_opis">
            <input maxlength="50" value="<? echo $data[0][1];?>" type="text" class="input-editor" name="name-new" id="name-new" placeholder="название"><br>
            <textarea maxlength="350" class="input-editor textareas"  placeholder="описание" id="opis-new" name="opis-new"><? echo $data[0][2];?></textarea><br>
            </div>
            <div class="block_setting_info">
               <div class="save_public">
                  <div class="save_public_button" >сохранить</div>
                  <div class="delite_public_button" >Удалить</div>
                  </div>
                <div style="color:#fff"><input class=" setting_date" type="datetime-local" value="<? echo $data[0][4];?>" name="data-new" id="data-new"></div>
                <div class="public_setting_new">Создано: <? echo $data[0][5];?></div>
                <div class="glav_public_setting" >
                <div class="public_setting_new">Видимость новости:</div><div class="timetable-cnop"><input type="checkbox" name="checkbox_new" value=""<? if( $data[0][6]==1){echo "checked";}?> class="checkbox" id="checkbox_new">
               <label for="checkbox_new" class="checkbox-label"></label>
                <label for="checkbox_new" class="checkbox-label-all"></label>
                </div>
                 </div>
                 
                 <div class="glav_public_setting">
                   <div class="public_setting_new">Слайдер:</div>
                    <div class="timetable-cnop">
                     <input onchange="vidOn(0)" type="checkbox" name="checkbox_vid" value=""<? if( $data[0][8]==1){echo "checked";}?> class="checkbox" id="checkbox_vid">
               <label for="checkbox_vid" class="checkbox-label"></label>
                <label for="checkbox_vid" class="checkbox-label-all"></label>
                 </div>
                 </div>
                 <div class="glav_public_setting">
                   <div class="public_setting_new">Ссылка:</div>
                    <div class="timetable-cnop">
                     <input onchange="silOn(0)" type="checkbox" name="checkbox_sil" value=""<? if( $data[0][10]==1){echo "checked";}?> class="checkbox" id="checkbox_sil">
               <label for="checkbox_sil" class="checkbox-label"></label>
                <label for="checkbox_sil" class="checkbox-label-all"></label>
                 </div>
                 </div>
                 <div class="input-silka-block">
                      <input  value="<? echo $data[0][11];?>" type="text" class="input-editor input-silka" name="silka-new" id="silka-new" placeholder="Ссылка без https://">
                 </div>
                
                <script>
    
                    vidOn(1);
                function vidOn(a){
                    var d = document.querySelector('#checkbox_vid');
                        
                        if (d.checked) {
                            if(a){
                                $('.new').css({"display":"none"});  
                                $('.block_siting_opis').css({"opacity":"0"});  
                                //$('.slider_img').css({"display":"block"});
                                $('.addFoto_slaider').css({"width":"100%"});
                            }else{
                                $('.new').hide(1000);
                                $('.block_siting_opis').css({"opacity":"0"});
                                $('.addFoto_slaider').css({"width":"100%"});
                                $('.slider_img').slideDown(1000);
                            }
                         
                         
                    } else {
                        if(a){
                            //$('.addFoto_slaider').css({"width":"50%"});
                            //$('.new').css({"display":"block"});
                            $('.slider_img').css({"display":"none"});
                        }else{
                            $('.addFoto_slaider').css({"width":"50%"});
                            $('.new').show(1000);
                            $('.block_siting_opis').css({"opacity":"1"});
                            $('.slider_img').slideUp(1000);
                        }
                        
                        }
                }
                </script>    
                 
            </div>
            </div>
            <textarea class="" id="text" name="text"><? echo $data[0][3];?></textarea><br>
        </form>
    </div>
    <div class="editor-glav primer_novosti">
        <div class="primer_novosti_glav">
            <div class="slaider_bovosti_primer">
             <div class="strilka">
                  <? include ("../new/87.php");?>
              </div>
              <div class="claidr_cnopki">
                  <div class="slaider_cnop_left" onclick="listSlaiders(-1)"></div>
                  <div class="slaider_cnop_right" onclick="listSlaiders(1)"></div>
              </div>
              
               <div class="img_slaider_new" id="img_slaider_new">
                <img src="/new/PHOTO2549826620520221225171154528.png" class="foto_slaider_new" id="slider_one_new">
                <?
                   if(count($datas)){
                  for($i=0;$i<count($datas);$i++){
                      echo "<img src=\"/new/".$datas[$i][1]."\"class=\"foto_slaider_new\"> ";
                  }}?>
               
                </div>
            </div>
            <div class="text_novosti_primer">
        <? echo $data[0][3];?>
            </div>
        </div>
        
    </div>
</body>

<script src="../tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    $(document).ready(function() {
 silOn(1);

});
  function silOn(a){
                    var d = document.querySelector('#checkbox_sil');
                        
                        if (d.checked) {
                            if(a){
                                $('.primer_novosti').css({"display":"none"}); 
                               tinymce.activeEditor.hide();
                               $('#text').css({"display":"none"});
                               //$('.input-silka-block').css({"display":"block"});
                                $('.addFoto_slaider').css({"display":"none"});
                               
                            }else{
                                $('.input-silka-block').show(1000);
                                $('.primer_novosti').hide(1000);
                               tinymce.activeEditor.hide(1000);
                                $('#text').hide();
                                 $('.addFoto_slaider').hide(1000);
                            }
                         
                        
                    } else {
                        if(!a){
                            $('.input-silka-block').hide(1000);
                            $('.primer_novosti').show(1000);
                            //$('#text').show();
                             tinymce.activeEditor.show(1000);
                            $('.addFoto_slaider').show(1000);
                            
                        }else{
                             //$('#text').show();
                             $('.input-silka-block').css({"display":"none"}); 
                        }
                       
                        }
                }
                    
    
    
    
    
    $(document).on('click', '.newsImg', function() {
        result = confirm("вы действительно хотите удалить фото со слайдера? Чтобы обновился слайдер, обновите страницу");
        if(!result){
           return;
           }
            $(this).parents('.foto_slaid_num').remove();
            id = $(this).siblings('.fotoUp').val();
            var msgid = new FormData();
            msgid.append('id', id);
            $.ajax({
                url: 'deleteslaid.php',
                method: 'post',
                processData: false,
                contentType: false,
                data: msgid,
                success: function(data) {
                    if (data == 1) {
                        return;
                    } else {
                        alert(data);
                    }
                }
            });
        });
    
    
    
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
    
    
    
    var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
        
}; 
    get = getUrlParameter('news');
    
    
    hit=$('.primer_novosti_glav').width();
    hit = hit*0.30*1.4;
   //$('.text_novosti_primer').style.height  = hit;
    $('.text_novosti_primer').css({"height":hit});
    $("#name-new").on("keyup",function(){
        names = $('#name-new').val();
        $('#nn').html(names);
    });
     $("#opis-new").on("keyup",function(){
        names = $('#opis-new').val();
        $('#no').html(names);
        
    });
    
    



    
    const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {//загрузка фото на сервер из редактора
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'postAcceptor.php');

        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };

        xhr.onload = () => {


            if (xhr.status < 200 || xhr.status >= 300) {
                reject('HTTP Error: ' + xhr.status);
                return;
            }

            const json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                reject('Invalid JSON: ' + xhr.responseText);
                return;
            }

            resolve(json.location);


        };

        xhr.onerror = () => {
            reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };

        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());


        xhr.send(formData);

    });





    tinymce.init({//подключение редактора
        selector: '#text',
        plugins: ['media', 'autoresize', 'charmap', 'code', 'emoticons', 'insertdatetime', 'link', 'lists', 'media', 'quickbars', 'table', 'save'],
        toolbar_sticky: true,
        toolbar_sticky_offset: 60,
        toolbar: ['link numlist bullist media quickimage  table alignleft aligncenter alignright alignjustify backcolor bold italic underline fontsize forecolor backcolor charmap code emoticons insertdatetime', ' undo redo subscript superscript save'],
        quickbars_selection_toolbar: 'bold italic | blocks | quicklink blockquote  h2 h3 ',
        media_url_resolver: function(data, resolve /*, reject*/ ) {
            if (data.url.indexOf('YOUR_SPECIAL_VIDEO_URL') !== -1) {
                const embedHtml = `<iframe src="${data.url}" width="400" height="400" ></iframe>`;
                resolve({
                    html: embedHtml
                });
            }


        },

        language: 'ru',
        relative_urls : false,
        //remove_script_host : true,
        //convert_urls : true,
        images_upload_handler: example_image_upload_handler,
        setup: function (ed) {
        ed.on('keyup', function (e) {
            tinyMceChange(ed);
        });
        ed.on('change', function(e) {
            tinyMceChange(ed);
        }); 
    }
    });
text=0;
function tinyMceChange(ed) {
    text = ed.getContent();
    $('.text_novosti_primer').html(text);
}
  
    
    $(".delite_public_button ").click(function(){
        result = confirm("вы действительно хотите удалить новость?");
        if(!result){
           return;
           }
        $('.load_glav').css({"display":"block"});
                        var msg= get;
                        //msg.append('get', get); //append file to formData object
                        $.ajax({
                            url: 'deletenovosti.php',
                            method: 'post',
                            data: {gets: get},
                            success: function(data) {
                                if (data == 1) {
                                 window.location.href = 'panel.php'; 
                                } 

                            }
                        });
    });
  
    
  $(".save_public_button").click(function(){
       $('.load_glav').css({"display":"block"});
                        if(text){
                             $('#text').val(text);
                        }
                       var c = document.querySelector('#checkbox_new');
                       var d = document.querySelector('#checkbox_vid');
                       var e = document.querySelector('#checkbox_sil');
                        
                        if (c.checked) {
                         $('#checkbox_new').val(1);
                    } else {
                        $('#checkbox_new').val(0);
                        }
      
                        if (d.checked) {
                         $('#checkbox_vid').val(1);
                    } else {
                        $('#checkbox_vid').val(0);
                        }
                        if (e.checked) {
                         $('#checkbox_sil').val(1);
                    } else {
                        $('#checkbox_sil').val(0);
                        }
                                
                        
                        msg = $('#addnovostiNEW').serialize();
                       
                        $.ajax({
                            url: 'updateNovosti.php?news=' + get,
                            method: 'post',
                            data: msg ,
                            success: function(data) {
                                if (data == 1) {
                                    $('.load_glav').css({"display":"none"});
                                    
                                } else {
                                  // alert(data);
                                }

                            }
                        });
        
        
});  
    
    
    
    
    
</script>
<script type="text/javascript">



</script>

</html>
