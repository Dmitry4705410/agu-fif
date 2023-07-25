<link rel="stylesheet" href="/infoError.css">
   <div class="error_block">
    <div class="eror_block_center">
       <div class="error_name">Уведомление</div>
        <div class="error_info">
           //здесь текст
        </div>
    </div>
</div>
<script>
$(document).on('click', '.error_block', function(e) {
      var div = $(".eror_block_center");
      if (!div.is(e.target) // если клик был не по нашему блоку
        && div.has(e.target).length === 0) { // и не по его дочерним элементам
        $('.error_block').slideUp();  
    }
    });
    
function error(text){
    $('.error_info').text(text);
    $('.error_block').slideDown();  
}
</script>