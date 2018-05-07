<?php 

	class Database{
		public $db;//свойство класса
		//метод описывающий подключение к базе данных
		public function __construct($host,$user,$pass,$db){
			$this->db = mysql_connect ($host,$user,$pass);
			if (!$this->db) {
				
				exit('lost connetction');
			}
			if (!mysql_select_db($db,$this->db)) {
				
				exit('No table');
			}

			mysql_query("SET NAMES utf8");
			return $this->db;
		}
	}
	

/*	class db{
		//protected $db_name='my_db';
		//protected $db_user='root';
		//protected $db_pass='';
		//protected $db_host='localhost';
		//взять объект результата mysql и конвертировать его в ассоциативный массив, в котором ключами являются название колонок.
		//Функция проходит по каждому ряду и функция mysql_fetch_assoc() преобразовывает каждый ряд в массив.
		//Ряд далее передается массиву и возвращается с помощью функции.
		//Существует второй аргумент $singleRow, который содержит значение по умолчанию.
		//Если значение true, выводится только один ряд вместо массива. Это очень полезно, если Вы ожидаете получить один результат.
		//public function connect(){
			//$connection=mysql_connect($this->db_host, $this->db_user, $this->db_pass);
			//mysql_select_db($this->db_name);
			//return true;
		//}
		public function processRowSet($RowSet, $SingleRow=false){
			$resultArray=array();
			while ( $row=mysql_fetch_assoc($RowSet) ) {
				array_push($resultArray, $row);
			}
			if ($SingleRow===true) {
				return $resultArray[0];
			}
			return $resultArray;
		}
		//
		public function select($table, $where){
			$sql="SELECT * FROM $table WHERE $where";
			$result=mysql_query($sql);
			if (mysql_num_rows($result)==1) {
				return $this->processRowSet($result, true);
			}
			return $this->processRowSet($result);
		}
		//
		public function update($data, $table, $where){
			foreach ($data as $column => $value) {
				$sql = "UPDATE $table SET $column = $value WHERE $where";
				mysql_query($sql) or die(mysql_error());
			}
			return true;
		}
		//
		public function insert($data, $table){
			$columns = "";
			$values = "";
			foreach($data as $column => $value){
				$columns .= ($columns == "") ? "" : ", ";
				$columns .= $column;
				$values .= ($values == "") ? "" : ", ";
				$values .= $value;
			}
			$sql = "INSERT INTO $table ($columns) VALUES ($values)";
			mysql_query($sql) or die(mysql_error());
			//
			return mysql_insert_id();
		}
	}

 ?>*/