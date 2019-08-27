<?php

class Database
{
	public $host= "localhost";
	public $user= "udukhfmy_dml_com";
	public $pass= "dSa5U[8{0aOMIs}3Ga";
	public $database= "udukhfmy_dml_com_bd";
    
    function __construct()
	{
        
        $this->connectDB();  
	}
    
    //db connection process
	public function connectDB(){
		$this->link = new mysqli($this->host,$this->user,$this->pass,$this->database);
		if (!$this->link) {
			$this->error = "Database connection failed".$this->link->connect_error;
			return false;
		}else{}
	}
}


?>