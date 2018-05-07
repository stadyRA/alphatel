function open_pop_up(value) {
	$("#overlay").show();
	$('#pop-up-' + value + '').center_pop_up();
	$('#pop-up-' + value + '').show(500);
}

function open_pop_up_order(type, view, id) {
       $.ajax({
            type: 'POST',
            url: 'ajax.php?order', 
            dataType: 'json',
            data: {"order": "", "type": + type, "view": + view, "id": + id},

            success: function(res) {
	                $("#overlay").show();
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
                       $('#pop-up-order').center_pop_up();
                       $('#pop-up-order').show(500);
                     }
       })
}

function open_pop_up_control(id, user) {
       $.ajax({
            type: 'POST',
            url: 'ajax.php?control', 
            dataType: 'json',
            data: {"control": "", "id": + id, "user": + user},

            success: function(res) {
	                $("#overlay").show();
                       $('#control').html('<h2 style="text-align: center;">' + res.title + '</h2>\
                                           <div id="text">' + res.text + '</div>\
                                           <div id="button">' + res.button + '</div>');
                       $('#pop-up-control').center_pop_up();
                       $('#pop-up-control').show(500);
                     }
       })
}

function open_pop_up_perpage(id, userid) {
       $.ajax({
            type: 'POST',
            url: 'ajax.php?pepage', 
            dataType: 'json',
            data: {"perpage": "", "id": + id, "user": + userid},

            success: function(res){
                 if (res.owner == userid) {
                       $("#overlay").show();
                       $('#perpage').html('<div class="tape_' + res.type + '"></div>\
                                     <div class="info_mw">\
                                     <center><b class="info_name" title="Название"> <i class="flag-' + res.country + '" title="Страна: ' + res.countryname + '\nГород: ' + res.city + '"></i> &nbsp; ' + res.hostname + '</b></center>\
                                     <b class="info_address" title="Адрес"><i class="icon-map-marker"></i> ' + res.address + '</b>\
                                     <b class="info_players" title="Игроки"><i class="icon-user"></i> ' + res.players + ' / ' + res.maxplayers + '</b></div>\
                                     <div class="info_mw_mapimg" style="background: url(../main/img/maps/' + res.map + '.png);" title="Карта: ' + res.map_title + '"></div>\
                                     <div class="info_ss">\
                                       ' + res.dane + '\
                                     </div>');
                       $('#pop-up-perpage').center_pop_up();
                       $('#pop-up-perpage').show(500);
                 } else {
                       $("#overlay").show();
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
                       $('#pop-up-perpage').center_pop_up();
                       $('#pop-up-perpage').show(500);
                 }
            }
       })
}
 
function close_pop_up(value) {
	$('#pop-up-' + value + '').hide(500);
	$("#overlay").delay(550).hide(1);
}

function close_pop_up_no(value) {
	$('#pop-up-' + value + '').hide(500);
}
 
$(document).ready(function(){
 
	jQuery.fn.center_pop_up = function(){
		this.css('position','absolute');  
		this.css('top', ($(window).height() - this.height()) / 2+$(window).scrollTop() + 'px');  
		this.css('left', ($(window).width() - this.width()) / 2+$(window).scrollLeft() + 'px');
	}
 
});