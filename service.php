<?php 
# Подключение конфига
define ('BOOST', true);
require_once "config.php";
?>
<?php
			# Хедер :D
			require_once "include/header.php";
?>
<div class="content"> 
<form name="search" method="post" action="search.php">
    <input type="search" name="query" placeholder="Поиск">
    <button type="submit">Найти</button> 
</form>
    <div class="main_fix"></div></div>
