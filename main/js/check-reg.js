/ ждем загрузки DOM
$(document).ready (function() 
{

    var emailFIN 
    var loginFIN 
    var passwordFIN 

    // блокируем кнопку отправки до того момента, пока все поля не будут проверены
    $('#submit').prop('disabled', true);

    // при изменении значения поля email
    $('#email').change(function() {

        var email = $(this).val();

        // делаем ajax-запрос методом POST на текущий адрес, в ответ ждем данные HTML
        $.ajax({
            type: 'GET',
            url: 'include/privoff/regcheck/check_email_ajax.php',
            dataType: 'html',
            data: "email=" + email,

            success: function(msg)
            {
               if(msg == "yes"){
                    $('#emailmsg').hide().html("<div class='msg-succes msg-rt'></div>").fadeIn(400);
                    $('#email').css({"border":"1px solid #ccc", "color":"#333"});
                    emailFIN = 1;
                    Button();
               } else if(msg == "exists") {
                    $('#emailmsg').hide().html("<div style='color: #cd2626'>E-mail уже зарегистрирован</div>").fadeIn(400);
                    $('#email').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    emailFIN = 0;
                    Button();
               } else if(msg == "wrong") {
                    $('#emailmsg').hide().html("<div style='color: #cd2626'>Неверно введен e-mail</div>").fadeIn(400);
                    $('#email').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    emailFIN = 0;
                    Button();
               } else if(msg == "emty") {
                    $('#emailmsg').hide().html("<div style='color: #cd2626'>Поле не может быть пустым</div>").fadeIn(400);
                    $('#email').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    emailFIN = 0;
                    Button();
               }
            }
        });
    });

    // при изменении значения поля login
    $('#login').change(function() {

        var login = $(this).val();

        // делаем ajax-запрос методом POST на текущий адрес, в ответ ждем данные HTML
        $.ajax({
            type: 'GET',
            url: 'include/privoff/regcheck/check_login_ajax.php',
            dataType: 'html',
            data: "login=" + login,

            success: function(msg)
            {
               if(msg == "yes2"){
                    $('#loginmsg').hide().html("<div class='msg-succes msg-rt'></div>").fadeIn(400);
                    $('#login').css({"border":"1px solid #ccc", "color":"#333"});
                    loginFIN = 1;
                    Button();
               } else if(msg == "exists2") {
                    $('#loginmsg').hide().html("<div style='color: #cd2626'>Логин уже зарегистрирован</div>").fadeIn(400);
                    $('#login').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    loginFIN = 0;
                    Button();
               } else if(msg == "min") {
                    $('#loginmsg').hide().html("<div style='color: #cd2626'>Минимальная длина логина 3 символа</div>").fadeIn(400);
                    $('#login').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    loginFIN = 0;
                    Button();
               } else if(msg == "max") {
                    $('#loginmsg').hide().html("<div style='color: #cd2626'>Максимальная длина логина 15 символов</div>").fadeIn(400);
                    $('#login').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    loginFIN = 0;
                    Button();
               } else if(msg == "lang") {
                    $('#loginmsg').hide().html("<div style='color: #cd2626'>Допускаются только цифры и латинские буквы</div>").fadeIn(400);
                    $('#login').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    loginFIN = 0;
                    Button();
               } else if(msg == "emty2") {
                    $('#loginmsg').hide().html("<div style='color: #cd2626'>Поле не может быть пустым</div>").fadeIn(400);
                    $('#login').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    loginFIN = 0;
                    Button();
               }
            }
        });
    });

    // при изменении значения поля password
    $('#password').change(function() {

        var password = $(this).val();

        // делаем ajax-запрос методом POST на текущий адрес, в ответ ждем данные HTML
        $.ajax({
            type: 'GET',
            url: 'include/privoff/regcheck/check_password_ajax.php',
            dataType: 'html',
            data: "password=" + password,

            success: function(msg)
            {
               if(msg == "yes3"){
                    $('#passwordmsg').hide().html("<div class='msg-succes msg-rt'></div>").fadeIn(400);
                    $('#password').css({"border":"1px solid #ccc", "color":"#333"});
                    passwordFIN = 1;
                    Button();
               } else if(msg == "figures") {
                    $('#passwordmsg').hide().html("<div style='color: #cd2626'>Пароль не может состоять только из цифр.<br>Добавьте буквы.</div>").fadeIn(400);
                    $('#password').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    passwordFIN = 0;
                    Button();
               } else if(msg == "letters") {
                    $('#passwordmsg').hide().html("<div style='color: #cd2626'>Пароль не может состоять только из букв.<br>Добавьте цифры.</div>").fadeIn(400);
                    $('#password').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    passwordFIN = 0;
                    Button();
               } else if(msg == "lang2") {
                    $('#passwordmsg').hide().html("<div style='color: #cd2626'>Допускаются только цифры и латинские буквы</div>").fadeIn(400);
                    $('#password').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    passwordFIN = 0;
                    Button();
               } else if(msg == "min2") {
                    $('#passwordmsg').hide().html("<div style='color: #cd2626'>Минимальная длина пароля 6 символов</div>").fadeIn(400);
                    $('#password').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    passwordFIN = 0;
                    Button();
               } else if(msg == "max2") {
                    $('#passwordmsg').hide().html("<div style='color: #cd2626'>Максимальная длина пароля 20 символов</div>").fadeIn(400);
                    $('#password').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    passwordFIN = 0;
                    Button();
               } else if(msg == "emty3") {
                    $('#passwordmsg').hide().html("<div style='color: #cd2626'>Поле не может быть пустым</div>").fadeIn(400);
                    $('#password').css({"border":"1px solid #cd2626", "color":"#cd2626"});
                    passwordFIN = 0;
                    Button();
               }
            }
        });
    });

    
    Button = function(){
           if (emailFIN == 1 && loginFIN == 1 && passwordFIN == 1) {
                    $('#submit').prop('disabled', false);
           } else {
                    $('#submit').prop('disabled', true);
           }                    
    }

});