<link rel="stylesheet" href="newphoto.css">
<script type="text/javascript" src="jquery.imgareaselect.js"></script>
<link rel="stylesheet"  href="imgareaselect-default.css">  
<div class="centerNewPhoto">
<div class="blockNewFoto">
    <form method="post" id="newphoto" enctype="multipart/form-data" onsubmit="return false;">
                  <div class="close_addfoto_glav">
                  <div class="close_block"  onclick="closeaddfoto()">
                  <div class="close_addfoto close_1"></div>
                  <div class="close_addfoto close_2"></div>
                  </div>
                  </div>
                   <div id="errphotosave" style="color:red;font-size: 8pt;"></div>
                    <label for='inputFilePhoto'>
                        <div class="upload">
                          <div class="upload_fotos">Загрузить фото</div> 
                        </div>
                    </label>
                        <input type="hidden" name="x1" id="x1" value="" />
                        <input type="hidden" name="y1" id="y1" value="" />
                        <input type="hidden" name="x2" id="x2" value="" />
                        <input type="hidden" name="y2" id="y2" value="" />
                        <input type="hidden" name="w" id="w" value="" />
                        <input type="hidden" name="h" id="h" value="" />

                    <input type="file" id="inputFilePhoto"  class="fileNewNovost" name="fileNewphoto">
                    <img id="image_photo" src=""/>
                    <div class="savenovost_div" ><input type="submit" value="сохранить" class="savenovost" id="savephotomy"></div>

                </form>
                <script>
                function  closeaddfoto(){
                     $('.centerNewPhoto').slideUp(1000);
                                    onphoto = 0;
                                    $('div[class^=imgareaselect-]').hide();
                     
                  }
function readURLs(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                             $('.savenovost_div').css('display', 'block');
                            reader.onload = function(e) {
                                $('#image_photo').css('display', 'block');
                                $('#image_photo').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                        }
                    }

                    $("#inputFilePhoto").change(function() {
                        readURLs(this);
                    });
               
                    
                     slaider=0;
                    onphoto = 0;
    function newphotoOnslaider(){
        slaider=1;
         scrollTop = $(window).scrollTop();
       if (onphoto == 0) {
           $('.centerNewPhoto').css('margin-top', scrollTop);
                $('.centerNewPhoto').slideDown(500);
           
                onphoto = 1;
           errphotosave.innerHTML = "";
            } else {
                $('.centerNewPhoto').slideUp(1000);
                onphoto = 0;
            } 
         
        selection = $('#image_photo').imgAreaSelect({
             aspectRatio: '1:1.4',
            handles: true,
            instance: true,           
}); 
    }
                    
       function newphotoOn(){//блок загрузки фото
           slaider=0;
            scrollTop = $(window).scrollTop();
        if (onphoto == 0) {
            $('.centerNewPhoto').css('margin-top', scrollTop);
                $('.centerNewPhoto').slideDown(500);
                
                onphoto = 1;
            errphotosave.innerHTML = "";
            } else {
                $('.centerNewPhoto').slideUp(1000);
                onphoto = 0;
            } 
           selection = $('#image_photo').imgAreaSelect({
             aspectRatio: '1:1',
            handles: true,
            instance: true,           
});   
    }              
          function newfotoSlaiderVid(){//блок загрузки фото
           slaider=2;
         scrollTop = $(window).scrollTop();
        if (onphoto == 0) {
            $('.centerNewPhoto').css('margin-top', scrollTop);
                $('.centerNewPhoto').slideDown(500);
                
                onphoto = 1;
            errphotosave.innerHTML = "";
            } else {
                $('.centerNewPhoto').slideUp(1000);
                onphoto = 0;
            } 
           selection = $('#image_photo').imgAreaSelect({
             aspectRatio: '2:1',
            handles: true,
            instance: true,           
});   
    }               
        
    $("#savephotomy").click(function(){
        $('.load_glav').css({"display":"block"});
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
    var s = selection.getSelection();
            $('input[name=x1]').val(s.x1);
            $('input[name=y1]').val(s.y1);
            $('input[name=x2]').val(s.x2);
            $('input[name=y2]').val(s.y2);
            $('input[name=w]').val(s.width);
            $('input[name=h]').val(s.height);
        x1 = $('#x1').val();
        y1 = $('#y1').val();
        x2 = $('#x2').val();
        y2 = $('#y2').val();
        w = $('#w').val();
        h = $('#h').val();
        get = getUrlParameter('news');
        var filePhoto = document.getElementById("inputFilePhoto").files[0]; //fetch file
                        var msg = new FormData();
                        msg.append('file', filePhoto);
                        msg.append('x1', x1);
                        msg.append('y1', y1);
                        msg.append('x2', x2);
                        msg.append('y2', y2);
                        msg.append('w', w);
                        msg.append('h', h);
                        msg.append('get', get);
                        msg.append('slaider', slaider);
                        
                       
                        $.ajax({
                            url: 'addnewphoto.php',
                            method: 'post',
                            processData: false,
                            contentType: false,
                            data:  msg,
                            success: function(data) {
                                if (data == 1) {
                                    errphotosave.innerHTML = "загрузите файл с расширением PNG,JPEG";
                                    $('.load_glav').css({"display":"none"});
                                    
                                } else {
                                    errphotosave.innerHTML = "";
                                     //$('#image_photo').css('display', 'none');
                                    if(slaider==0){
                                       
                                        up="../new/"+data;
                                    //up=up.replace(/ /g,'');
                                    $('#foto-glav').attr('src', up);
                                    $('.centerNewPhoto').css('display', 'none');
                                    onphoto = 0;
                                    $('div[class^=imgareaselect-]').hide();
                                       }else if(slaider==1){
                                           $( ".img_slaider_new" ).append( " <img src=\"/new/"+$.parseJSON(data)[0]+"\" class=\"foto_slaider_new\" >" );
                                           fotoSliderStr();
                                            $( ".slider_glav_omg" ).append( 
                                                "<div class=\"foto_slaid_num\"><div class=\"newsImg \" ><img class=\"fotoUps\" src=\"/new/"+$.parseJSON(data)[0]+"\" ></div><input class=\"fotoUp\" type=\"hidden\" value=\""+$.parseJSON(data)[1]+"\"></div>" );
                                           
                                           
                                           
                                            $('.centerNewPhoto').css('display', 'none');
                                    onphoto = 0;
                                    $('div[class^=imgareaselect-]').hide();
                                       }else if(slaider==2){
                                                
                                        up="../new/"+data;
                                    //up=up.replace(/ /g,'');
                                    $('#foto-slaider').attr('src', up);
                                    $('.centerNewPhoto').css('display', 'none');
                                    onphoto = 0;
                                    $('div[class^=imgareaselect-]').hide();
                                                }
                                   $('.load_glav').css({"display":"none"});
                                    
                                }

                            }
                        });
        
        
});
    

</script>
</div></div>