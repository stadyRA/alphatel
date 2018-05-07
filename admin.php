<?php 
# Создаем сессию
session_start();
# Подключение конфига
define ('BOOST', true);
require_once "config.php";
# Админская проверка $_POST данных
require_once "include/admin/admin_validation.php";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Панель управления | admin panel</title>
	<link rel="icon" href="main/img/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="main/img/favicon.ico" type="image/x-icon">
	<link type="text/css" rel="StyleSheet" href="main/css/bootstrap.min.css" />
	<script src="main/js/bootstrap.min.js"></script>
	<script src="main/js/jquery.js"></script>
</head>
<body>
<div class="navbar">
  <div class="navbar-inner">
    <a class="brand" href="index.php">Альфател документация</a>
  </div>
</div>
<div class="container-fluid content"> 
	<div class="row-fluid">
		<div class="span12">
			<?php 
				# Информационное сообщение
				if(isset($showmsg)) { echo $showmsg; }
				# Если пользователь не авторизован
				if(isset($_COOKIE["adminhash"]) AND $_COOKIE["adminhash"] != $auth[2] OR !isset($_COOKIE["adminhash"])) {
					require_once "include/admin/admin_auth.php";
				# Ну а уж если авторизован
				} else {
					# Управление документами
					if(isset($_GET['doc'])) {
						require_once "include/admin/admin_server.php";
					}
                }
			?>
		</div>
	</div>
</div>
</body>
</html>