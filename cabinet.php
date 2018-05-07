<?php 
# Создаем сессию
session_start();
# Подключение конфига
define ('BOOST', true);
require_once "config.php";
# Админская проверка $_POST данных
require_once "include/users/admin_validation.php";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Личный Кабинет Пользователя</title>
	<link rel="icon" href="main/img/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="main/img/favicon.ico" type="image/x-icon">
	<link type="text/css" rel="StyleSheet" href="main/css/bootstrap.min.css" />
	<script src="main/js/bootstrap.min.js"></script>
	<script src="main/js/jquery.js"></script>
</head>
<body>
<div class="navbar">
  <div class="navbar-inner">
    <a class="brand" href="index.php">На Главную.</a>
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
					require_once "include/users/admin_auth.php";
				# Ну а уж если авторизован
				} else {
						require_once "include/users/admin_main.php"; 
						require_once "include/users/admin_graph.php"; 
					}	
			?>
		</div>
	</div>
</div>
</body>
</html>