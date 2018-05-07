<?php
if (! defined ( 'BOOST' )) { exit ( "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> Эй, не озоруй. К данному файлу я тебе запрещаю прямой доступ. Теперь-то мне ясно, кто ковыряет мой сайт." ); }
#---------------------------------------------------------------------------------------------------------+
# $newMess->into_msg("Заголовок", "Сообщение", "Цвет");
#---------------------------------------------------------------------------------------------------------+

# Создание объектов
$newMess = new Messages();

class Messages
{
	static function into_msg($header, $msg, $status) 
	{
		$array_status = array(1 => 'success', 2 => 'error', 3 => 'info', 4 => 'warning');
		$array_header = array(1 => 'Поздравляем!', 2 => 'Ошибка!', 3 => 'Информация', 4 => 'Предупреждение');
		if(isset($array_status[$status])) {
			$status = $array_status[$status];
		} else {
			return;
		}
		if(isset($array_header[$header])){
			$header = $array_header[$header];
		} else {
			$header = "$header";
		}
		return "<div class='alert alert-$status'><strong>$header</strong><br />$msg</div>";
	}
}

?>