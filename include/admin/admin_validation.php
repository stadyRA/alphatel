<?php
if (! defined ( 'BOOST' )) { exit ( "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> Эй, не озоруй. К данному файлу я тебе запрещаю прямой доступ. Теперь-то мне ясно, кто ковыряет мой сайт." ); }
require_once 'include/global.php';
# Авторизация
if ( !empty($_REQUEST['password']) and !empty($_REQUEST['login']) ) {
		//Пишем логин и пароль из формы в переменные (для удобства работы):
		$login = $_REQUEST['login'];
		$password = $_REQUEST['password'];
		setcookie("adminhash", $auth[2], time()+2592000, "/");
		header("Location: admin.php");
	
    $query = 'SELECT*FROM users WHERE login="'.$login.'" AND password="'.$password.'"';
		$result = mysqli_query($link, $query); //ответ базы запишем в переменную $result
		$user = mysqli_fetch_assoc($result); //преобразуем ответ из БД в нормальный массив 
    
    if (!empty($user)){
        
        session_start(); 
		$_SESSION['auth'] = true; 
        
        $_SESSION['id'] = $user['id']; 
		$_SESSION['login'] = $user['login'];
    
    } else {
		$showmsg = $newMess->into_msg("2", "Неверные логин или/и пароль", "2"); 
	}
# Управление документами
} else if(isset($_GET['servers'])) {

	# Удаление
	} else if(isset($_POST['del']) AND !empty($_POST['id'])) {
		$id = intval($_POST['id']);
		mysqli_query("DELETE FROM `dokuments` WHERE `id_doc` = {$id}") or die(mysql_error());
		header( 'Refresh: 2; url=admin.php?servers' );
		$showmsg = $newMess->into_msg("1", "Данный документ успешно удален", "1"); 
	
	} 
?>