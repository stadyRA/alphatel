function feedback() {
        $.ajax({
            type: 'POST',
            url: 'ajax.php?feedback',
            dataType: 'json',
            data: {feedback: "", theme: $("#theme").val(), email: $("#mail").val(), message: $("#message").val()},

            success: function(res){
                 if (res.status == "success") {
                       $('#feed_info').html('<div style="color: #aaa;">Сообщение успешно отправлено</div>');
                 } else if (res.status == "again") {
                       $('#feed_info').html('<div style="color: #aaa;">Отправлять сообщения чаще одного раза в пять минут нельзя</div>');
                 } else if (res.status == "error") {
                       $('#feed_info').html('<div style="color: #aaa;">Неверный E-mail</div>');
                 } else if (res.status == "empty") {
                       $('#feed_info').html('<div style="color: #aaa;">Все поля должны быть заполнены</div>');
                 }
            }
        })
}


function order() {
       var ip = $("#ip").val();
       var type = $("#type").val();
       var service = $("#service").val();
       var summ = $("#selectsumm").val();
       var view = $("#view").val();
       var domain = location.hostname;
        $.ajax({
            type: 'POST',
            url: 'include/order_validation.php',
            dataType: 'json',
            data: {ip: $("#ip").val(), view: $("#view").val(), type: $("#type").val(), summ: $("#selectsumm").val()},

            success: function(res){
                 if (res.status == "success") {
                       location='http://' + domain + '/include/payment.php?ip=' + ip + '&type=' + type + '&service=' + service + '&summ=' + summ + '&view=' + view + '';
                 } else if (res.status == "error") {
                       $('#infoorder').html('<div style="color: #444; font-size: 110%; margin-bottom: 10px;">' + res.info + '</div>');
                 } else if (res.status == "ban") {
                       $('#infoban').html('<div style="color: #444; font-size: 110%; margin-bottom: 10px;">' + res.info + '</div>');
                 } else if (res.status == "yes") {
                       $('#infoban').html('<div style="color: #444; font-size: 110%; margin-bottom: 10px;">' + res.info + '</div>');
                 }
            }
        })
}


function order_start() {
       var ip = $("#ip").val();
       var type = $("#type").val();
       var service = $("#service").val();
       var summ = $("#selectsumm").val();
       var view = $("#view").val();
       $.ajax({
            type: 'POST',
            url: 'ajax.php?order', 
            dataType: 'json',
            data: {"order": "", "type": + type, "view": + view, "id": + id},

            success: function(res) {
                       $('#order').html('<h2 style="text-align: center;">' + res.service + '</h2>\
                                         <div id="infoorder" style="text-align: center; width: 65%; margin: auto;">\
                                         <form action="javascript:void(null);" method="POST" id="formorder" style="text-align: center;" onsubmit="order()" autocomplete="off">\
                                           ' + res.hidden + '\
                                           <div id="infoban"></div>\
                                           ' + res.input + '\
                                           <select id="selectsumm" name="select" style="background: #aaa; font-size: 130%; color: #444; width: 200px; height: 30px;">\
                                             ' + res.select + '\
                                           </select><br>\
                                           ' + res.button + '\
                                         </form>\
                                         </div>');
                     }
       })
}


function add() {
       if ($('input[name=check]').is(':checked')==false) {
            $('#info').html('<div style="color: #444; font-size: 110%; margin-bottom: 10px;">Подтвердите согласие с правилами</div>');
       } else {
            var dane = $('#add').serialize();
            $.ajax({
                type: 'POST',
                url: 'ajax.php?add',
                dataType: 'json',
                data: {add: "", address: $('#ip').val(), user: $('#user').val()},

                success: function(res){
                         if (res.status == "error") {
                               $('#info').html('<div style="color: #444; font-size: 110%; margin-bottom: 10px;">' + res.info + '</div>');
                         } else if (res.status == "success") {
                               location.replace("/cabinet");
                         }
                }
            })
       }
}


function checked(id, user) {
            $.ajax({
                type: 'POST',
                url: 'ajax.php?checked',
                dataType: 'json',
                data: {"checked": "", "id": + id, "user": + user},

                success: function(res){
                         $('#text').html('<div>' + res.text + '</div>');
                         $('#button').html('<div>' + res.button + '</div>');
                }
            })
}


function control(id, user) {
            $.ajax({
                type: 'POST',
                url: 'ajax.php?checked',
                dataType: 'json',
                data: {"control": "", "id": + id, "user": + user},

                success: function(res){
                         $('#text').html('<div>' + res.text + '</div>');
                         $('#button').html('<div>' + res.button + '</div>');
                }
            })
}


function deleted(id, user) {
            $.ajax({
                type: 'POST',
                url: 'ajax.php?delete',
                dataType: 'json',
                data: {"delete": "", "id": + id, "user": + user},

                success: function(res){
                         location.replace("/cabinet");
                }
            })
}


function perpage(id, userid) {
       $.ajax({
            type: 'POST',
            url: 'ajax.php?pepage', 
            dataType: 'json',
            data: {"perpage": "", "id": + id, "user": + userid},

            success: function(res){
                 if (res.owner == userid) {
                       $('#perpage').html('<div class="tape_' + res.type + '"></div>\
                                     <div class="info_mw">\
                                     <center><b class="info_name" title="Название"> <i class="flag-' + res.country + '" title="Страна: ' + res.countryname + '\nГород: ' + res.city + '"></i> &nbsp; ' + res.hostname + '</b></center>\
                                     <b class="info_address" title="Адрес"><i class="icon-map-marker"></i> ' + res.address + '</b>\
                                     <b class="info_players" title="Игроки"><i class="icon-user"></i> ' + res.players + ' / ' + res.maxplayers + '</b></div>\
                                     <div class="info_mw_mapimg" style="background: url(../main/img/maps/' + res.map + '.png);" title="Карта: ' + res.map_title + '"></div>\
                                     <div class="info_ss">\
                                       ' + res.dane + '\
                                     </div>');
                 } else {
                       $('#perpage').html('<div class="tape_' + res.type + '"></div>\
                                     <div class="info_mw">\
                                     <center><b class="info_name" title="Название"> <i class="flag-' + res.country + '" title="Страна: ' + res.countryname + '\nГород: ' + res.city + '"></i> &nbsp; ' + res.hostname + '</b></center>\
                                     <b class="info_address" title="Адрес"><i class="icon-map-marker"></i> ' + res.address + '</b>\
                                     <b class="info_players" title="Игроки"><i class="icon-user"></i> ' + res.players + ' / ' + res.maxplayers + '</b></div>\
                                     <div class="info_mw_mapimg" style="background: url(../main/img/maps/' + res.map + '.png);" title="Карта: ' + res.map_title + '"></div>\
                                     <div class="info_ss"><div class="ct_ss_lt"><h3>УСЛУГИ</h3></div><div class="ct_ss_rt"><div class="ct_line"></div></div><div class="clear"></div></div>\
                                     <div class="info_block"><div><i class="icon-tag"></i> <b>Активная услуга:</b> ' + res.service + '<br><i class="icon-plus-sign"></i> <b>Дата добавления:</b> ' + res.date_add + '<br><i class="icon-calendar"></i> <b>Дата окончания:</b> ' + res.date_end + '<br>\
                                     <div class="ct_rem_popup"><i class="icon-time icon-white"></i> <b>Осталось:</b> ' + res.date_left + '</div>\
                                     <div onclick="open_pop_up_order(' + res.type + ', 2, ' + id + ')" class="ext_pp_popup"><b>П� ОДЛИТЬ</b></div></div>\
                                     <div class="clear"></div></div>');
                 }
            }
       })
}


function edit_profile(user, value) {
       $.ajax({
            type: 'POST',
            url: 'ajax.php?edit_password', 
            dataType: 'json',
            data: {old: $('#old').val(), new: $('#new').val(), again: $('#again').val(), email: $('#new_email').val(), user: + user, edit_profile: + value},

            success: function(res){
                      if (res.status == "error") {
                            $('#info_profile').html('' + res.info + '');
                      } else if (res.status == "success") {
                            $('#edit_edit').html('<div>' + res.info + '</div><br><div>' + res.button + '</div>');
                      } else {
                            $('#title_edit').html('' + res.title + '');
                            $('#edit_edit').html('' + res.form + '');
                      }
            }
       })
}


function edit_email(user) {
        $('#title').html('E-MAIL');
        $('#edit').html('<form style="text-align: center;" action="javascript:void(null);" method="POST" id="add" onsubmit="add()" autocomplete="off">\
                           <div id="res3"></div>\
                           <input type="hidden" name="userid" value="' + user + '">\
                           <input style="background: #aaa; font-size: 130%; color: #444; width: 200px; height: 30px;" class="input_ip" name="new" type="text" placeholder="Новый e-mail"><br>\
                           <button type="submit" style="border: 0px; background: #444; color: #ccc; font-size: 130%; font-family: Arimo; padding: 4px 10px; border-radius: 2px;">Изменить</button>\
                         </form>');
}