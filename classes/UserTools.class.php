<?php
require_once 'DB.class.php';

class UserTools {

	public function login($username,$pass)
	{
		$db = new Database(HOST,USER,PASS,DB);
        $hashedPi = md5($pi);
		$hashedPassword = md5($pass);
		$result = mysql_query("SELECT * FROM users WHERE login = '$username' AND pass = '$hashedPassword'");

		if(mysql_num_rows($result) == 0)
		{
			$_SESSION["login"] = serialize(new User(mysql_fetch_assoc($result)));
			$_SESSION["login_time"] = time();
			$_SESSION["logged_in"] = 1;
			return true;
		}else{
			return false;
		}
	}
	
public  function logout(){
	unset($_SESSION["login"]);
	unset($_SESSION["login_time"]);
	unset($_SESSION["logged_in"]);
	session_destroy();
}

public function checkUsernameExists($username) {
	$db = new Database(HOST,USER,PASS,DB);
	$result = mysql_query("select id from users where login='$username'");
	if(mysql_num_rows($result) == 0)
	{
		return false;
	}else{
		return true;
	}
}

public function get($id)
{
	$db = new Database(HOST,USER,PASS,DB);
	$result = $db->select('login',"id = $id");

	return new User($result);
}	
}
?>