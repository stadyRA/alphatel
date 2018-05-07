<?php 

require_once 'UserTools.class.php';
require_once 'DB.class.php';

class User {

public $id;
public $firsname;
public $hashedPasport;
public $numcart;
public $hashedPi;
public $username;
public $hashedPassword;
public $email;
public $joinDate;

function __construct($data) {
	        $this->id = (isset($data['Id_users'])) ? $data['Id_users'] : "";
    
            $this->firstname = (isset($data['FIO'])) ? $data['FIO'] : "";
    
            $this->hashedPasport = (isset($data['id_pasport'])) ? $data['id_pasport'] : "";
    
            $this->numcart = (isset($data['numder_cart'])) ?  $data['number_cart'] : "";
    
            $this->hashedPi = (isset($data['pin'])) ?  $data['pin'] : "";
    
			$this->username = (isset($data['username'])) ? $data['username'] : "";
    
			$this->hashedPassword = (isset($data['user_password'])) ? $data['user_password'] : "";
    
			$this->email = (isset($data['e-mail'])) ? $data['e-mail'] : "";
    
			$this->joinDate = (isset($data['join_date'])) ? $data['join_date'] : "";
}
public function save($isNewUser = false) {
	$db = new Database(HOST,USER,PASS,DB);

	if(!$isNewUser) {

		$data = array(
            "FIO"=>"'$this->firstname'",
            "id_pasport"=>"'$this->hashedPasport'",
            "number_cart"=>"'$this->numcart'",
            "pin"=>"'$this->hashedPi'",
            "username"=>"'$this->username'",
            "user_password"=>"'$this->hashedPassword'",
            "e-mail"=>"'$this->email'"
		);

		$db->update($data, 'users','Id_users = '.$this->id);
	}else {

		$data = array(
            "FIO"=>"'$this->firstname'",
            "id_pasport"=>"'$this->hashedPasport'",
            "number_cart"=>"'$this->numcart'",
            "pin"=>"'$this->hashedPi'",
			"username"=>"'$this->username'",
            "user_password"=>"'$this->hashedPassword'",
            "e-mail"=>"'$this->email'",
            "join_date" => "'".date("Y-m-d H:i:s",time())."'"
		);

		$this->id = $db->insert($data, 'users');
		$this->joinDate = time();
	}
	return true;
}
}
?>