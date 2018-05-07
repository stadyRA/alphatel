function validation() {
       var dane = $('#authorization').serialize();
        $.ajax({
            type: 'POST',
            url: 'include/privoff/authcheck/check_auth.php',
            dataType: 'html',
            data: dane,

            success: function(res){
                 if (res == "success") {
                       location.replace("/cabinet");
                 } else if (res == "error") {
                       $('#res').html("<div class='alert-msg'>Неверные логин или пароль</div>");
                 } else if (res == "empty") {
                       $('#res').html("<div class='alert-msg'>Все поля должны быть заполнены</div>");
                 }
            }
        })
}

function validation2() {
       var dane = $('#authorization2').serialize();
        $.ajax({
            type: 'POST',
            url: 'include/privoff/authcheck/check_auth.php',
            dataType: 'html',
            data: dane,

            success: function(res){
                 if (res == "success") {
                       location.reload();
                 } else if (res == "error") {
                       $('#res2').html("<div class='alert-msg'>Неверные логин или пароль</div>");
                 } else if (res == "empty") {
                       $('#res2').html("<div class='alert-msg'>Все поля должны быть заполнены</div>");
                 }
            }
        })
}