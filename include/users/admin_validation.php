<?php
if (! defined ( 'BOOST' )) { exit ( "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> Эй, не озоруй. К данному файлу я тебе запрещаю прямой доступ. Теперь-то мне ясно, кто ковыряет мой сайт." ); }

# Авторизация
if(!empty($_POST['login']) AND !empty($_POST['password'])) {
	if($_POST['login'] == $auth[0] AND md5($_POST['password']) == $auth[1]) {
		setcookie("adminhash", $auth[2], time()+2592000, "/");
		header("Location: admin.php");
	} else {
		$showmsg = $newMess->into_msg("2", "Неверные логин или/и пароль", "2"); 
	}
# Управление 
	# Удаление
	} else if(isset($_POST['del']) AND !empty($_POST['id'])) {
		$id = intval($_POST['id']);
		mysql_query("DELETE FROM `documents` WHERE `id_doc` = {$id}") or die(mysql_error());
		header( 'Refresh: 2; url=admin.php?' );
		$showmsg = $newMess->into_msg("1", "Данный документ успешно удален", "1"); 
	}
}
?>