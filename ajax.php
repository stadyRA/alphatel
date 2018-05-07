<?php 
# Подключение конфига
define ('BOOST', true);
require_once "config.php";
# Отдаем хедеры
Header("Cache-Control: no-cache, must-revalidate");
Header("Pragma: no-cache");
Header("Content-Type: text/javascript; charset=utf-8");

if(empty($_POST['act'])) exit ('Доступ запрещен');

if(!empty($_POST['act']) AND $_POST['act'] == 'validation' AND !empty($_POST['ip']) AND !empty($_POST['key'])) {
	global $newMess;
	# Создаем пустой массив ошибок
	$err = array();
	# Запросы
	$sql_key = mysql_query("SELECT * FROM `keys` WHERE `key` = '".mysql_real_escape_string($_POST['key'])."'") or die(mysql_error());
	$sql_ban = mysql_query("SELECT * FROM `ban` WHERE `address` = '".mysql_real_escape_string($_POST['ip'])."'") or die(mysql_error());
	$sql_uniq = mysql_query("SELECT * FROM `servers` WHERE `address` = '".mysql_real_escape_string($_POST['ip'])."' AND `type` = '2'") or die(mysql_error());
	$sql_uniq_def = mysql_query("SELECT * FROM `servers` WHERE `address` = '".mysql_real_escape_string($_POST['ip'])."' AND `type` = '1'") or die(mysql_error());
	$sql_uniq_count_def = mysql_query("SELECT * FROM `servers` WHERE `type` = '1'") or die(mysql_error());
	# Узнаем поближе наш сервер
	$srv = mysql_fetch_assoc($sql_uniq);
	# Узнаем поближе наш ключик 
	$row = mysql_fetch_assoc($sql_key);
	if(!preg_match('/^[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}:[0-9]{5}$/i', $_POST['ip'])) {
		$err[]= 'Неверный адрес сервера';
	} else if (mysql_num_rows($sql_key) == 0) {
		$err[]= 'Данного ключа не существует';
	} else if (mysql_num_rows($sql_uniq_def) > 0) {
		$err[]= 'Данный сервер уже в бусте';
	} else if (mysql_num_rows($sql_ban) > 0) {
		$err[]= 'Данный сервер забанен в бусте';
	} else if ($row['type'] != 4 AND $max_servers_def != 0 AND $max_servers_def <= mysql_num_rows($sql_uniq_count_def)) {
		$err[]= 'Достигнуто максимальное количество серверов';
	}
	# Если ошибок нет
	if(count($err) == 0) {
		# Получаем тип ключа
		$keyType = $row['type'];
		# Удаляем ключ
		$sql_delkey = mysql_query("DELETE FROM `keys` WHERE `key`= '".mysql_real_escape_string($_POST['key'])."'") or die(mysql_error());
		# Создаем объект скана сервера
		$newServer = new Checkserver();
		# Сканируем сервер
		$data = $newServer->serverInfo($_POST['ip']);
		# Массив типов времени (сутки, неделя, месяц)
		$timeshift = array(1 => 3600*24, 3600*24*7 , 3600*24*30);
		# Дата окончания буста
		if($keyType == 4) {
			$date_end = 0;
			$boostType = 2;
			if(mysql_num_rows($sql_uniq) == 0) {
				$sql_uniq_count_drop = mysql_query("SELECT * FROM `servers` WHERE `type` = '2'") or die(mysql_error());
				# Если лимит серверов исчерпан, то проверяем дальше
				if(mysql_num_rows($sql_uniq_count_drop) == $max_servers_drop) {
					# Для начала найдем серверы в обратном порядке
					$sql = mysql_query("SELECT * FROM `servers` WHERE `type` = 2 ORDER BY `date_create` ASC") or die(mysql_error());
					# Кидаем в массив полученный результат прогоняя по циклу
					while($row = mysql_fetch_assoc($sql)) {
						$servers[] = $row;
					}
					# Колдуем
					foreach($servers AS $key => $boostservers) {
						# Если количество кругов == 1 то выходим из цикла 
						if($boostservers['rounds'] == 1) { 
							mysql_query("DELETE FROM `servers` WHERE `id` = '{$boostservers['id']}'") or die(mysql_error());
							break;
						} else {
							mysql_query("UPDATE `servers` SET `date_create` =  '".(time()+1)."', `rounds` = `rounds`-1 WHERE `id` = '{$boostservers['id']}'") or die(mysql_error());
						}
					}
				}
				$sql_upd = mysql_query("INSERT INTO `servers` (`id`, `address`, `hostname`, `players`, `maxplayers`, `map`, `status`, `game`, `date_create`, `date_end`, `type`, `rounds`) VALUES (NULL, '".mysql_real_escape_string(trim($_POST['ip']))."', '".mysql_real_escape_string($data['hostname'])."', '".mysql_real_escape_string($data['players'])."', '".mysql_real_escape_string($data['maxplayers'])."', '".mysql_real_escape_string($data['mapname'])."', '".intval($data['status'])."', 'cs16', '".time()."', '{$date_end}', '{$boostType}', '1')") or die(mysql_error());
			} else {
				$sql_upd = mysql_query("UPDATE `servers` SET `rounds` = `rounds`+1 WHERE `id` = '{$srv['id']}'") or die(mysql_error());
			}
		} else {
			$date_end = time()+$timeshift[$keyType];
			$boostType = 1;
			$sql_upd = mysql_query("INSERT INTO `servers` (`id`, `address`, `hostname`, `players`, `maxplayers`, `map`, `status`, `game`, `date_create`, `date_end`, `type`, `rounds`) VALUES (NULL, '".mysql_real_escape_string(trim($_POST['ip']))."', '".mysql_real_escape_string($data['hostname'])."', '".mysql_real_escape_string($data['players'])."', '".mysql_real_escape_string($data['maxplayers'])."', '".mysql_real_escape_string($data['mapname'])."', '".intval($data['status'])."', 'cs16', '".time()."', '{$date_end}', '{$boostType}', '0')") or die(mysql_error());
		}
		switch ($keyType) {
			case 1:
				$srok = 'на сутки в обычный буст';
				break;
			case 2:
				$srok = 'на неделю в обычный буст';
				break;
			case 3:
				$srok = 'на месяц в топ';
				break;
			case 4:
				$srok = 'в буст на вылет';
				break;
			default;
				$srok = 'неизвестно куда';
				break;
		}
		$result = array('status' => 'success', 'result' => 'Сервер добавлен '.$srok);
		echo json_encode($result);
	} else {
		$result = array('status' => 'error', 'result' => $err[0]);
		echo json_encode($result);
	}
}
?>