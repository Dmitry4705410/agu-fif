$(window).on('load', function(){
    vhods.onclick = vhod;

    function vhod() {
        err.innerHTML = " ";
        login = $('#login').val();
        pass = $('#pass').val();
        msg = $('#vhod').serialize();
        if(login && pass){
            
            $.ajax({
                    url: 'vhod.php',
                    method: 'post',
                    data: msg,
                    success: function (data) {
                        if (data == 1) {
                            document.location.href = "/personal-cabinet.php";
                        }else {
                            err.innerHTML = data;
                        }

                    }
                }); 
        } else {
            err.innerHTML = "заполните все поля";
        }
    }
    

})
