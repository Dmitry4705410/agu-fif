<!DOCTYPE html>
<html lang="ru">
<? include ("proverka.php");?>
<? include ("../loading.php");?>
<head>
    <meta charset="UTF-8">
    <? include ('../global-link.php');?>
        <link rel="stylesheet" href="editor.css">
    <title>Редактор Страниц</title>
</head>
<body>
    <? include ('heder.php');?>
    <?
    $get=$_GET['post'];
    if($get){
$stmt = $link->prepare("SELECT  id,text FROM str WHERE  id=:id");
$parametr = ['id' => $get];
$stmt->execute($parametr);
$data = $stmt->fetchAll();
        if(!count($data)){
            header("Location:panel.php");
        }
    }else{
         header("Location:panel.php");
    }  
    ?>
    <div class="editor-glav" style="margin-top:70px; padding-top:10px;">
<form method="post" id="addnovostiNEW" name="addnovostiNEW" onsubmit="return false;">
    <input class="fotoUp" name="idstr" type="hidden" value="<?echo $data[0][0];?>">
    <div class="center_save_public_button"><div  class="save_public_button save_srt_public" >сохранить</div></div>
    
    <textarea class="" id="text" name="text"><? echo $data[0][1];?></textarea><br>
  </form>  
  </div>
  <script src="../tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    
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
}
      
       $(".save_public_button").click(function(){
       $('.load_glav').css({"display":"block"});
                        if(text){
                             $('#text').val(text);
                        }
                        msg = $('#addnovostiNEW').serialize();
                        $.ajax({
                            url: 'redactstr.php',
                            method: 'post',
                            data: msg ,
                            success: function(data) {
                                if (data == 1) {
                                    $('.load_glav').css({"display":"none"});
                                    
                                } else {
                                   alert(data);
                                }

                            }
                        });
        
        
});  
      
    </script>
</body>
</html>