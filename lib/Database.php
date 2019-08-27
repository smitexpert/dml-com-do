<?php
//include_once ('/../config/Config.php');
require_once __DIR__."/../config/Config.php";
require_once __DIR__."/../includes/data_function.php";
require_once __DIR__."/../lib/vendor/essential.php";

$link="";
$error="";

class Database
{
	public $host= "localhost";
	public $user= "udukhfmy_dml_com";
	public $pass= "dSa5U[8{0aOMIs}3Ga";
	public $database= "udukhfmy_dml_com_bd";


	



//db connection process
	public function connectDB(){
		$this->link = new mysqli($this->host,$this->user,$this->pass,$this->database);
		if (!$this->link) {
			$this->error = "Database connection failed".$this->link->connect_error;
			return false;
		}else{}
	}



//Insert
	public function insert($query){
		$insres=$this->link->query($query)or die($this->link->error.__LINE__);
		if ($insres) {
			return $insres;
		}else{
			return false;
		}
	}





//Select
	public function select($query){
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			if ($result->num_rows > 0) {
				return $result;
			}else{
				return false;
				echo "failed select";
			}
		
	}



//Edit 

	public function Update($query){
		$result = $this->link->query($query)or die($this->link->error.__LINE__);
		if ($result) {
			return $result;
		}else{
			return false;
		}
	}


//delet

	public function Delete($query){
		$deleting=$this->link->query($query);
		if ($deleting) {
			return $deleting;
		}else{
			return false;
		}

	}
    
    
//count
    
    public function Count($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        $row = $result->fetch_row();
        return $row;
    }
    
    
    
    public function CuntMenu($menu){
        $checkMenuQuery = "SELECT id FROM menu_sidebar WHERE menuIndex='$menu'";
        $checkMenu = $this->Count($checkMenuQuery);
        
        if($checkMenu[0] > 0){
            return true;
        }else{
            return false;
        }
    }
    
    
    public function Menus($menu){
        
        $queryMenu = "SELECT * FROM menu_sidebar WHERE menuIndex='$menu'";
            
        $result = $this->link->query($queryMenu) or die($this->link->error.__LINE__);
        if ($result->num_rows > 0) {
            return $result;
        }else{
            return false;
            echo "failed select";
        }
    }
    
    
    public function MenuUser($url, $userId){
        $query = "SELECT * FROM menu_$userId WHERE menuUrl='$url'";
        
        $count = $this->Count($query);
        
        if($count[0] > 0){
            return 'checked';
        }else{
            return '';
        }
    }
    
    
    public function getUserName($userid){
        $query = "SELECT name FROM user WHERE userId='$userid'";
        $result = $this->link->query($query);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    
    public function getCountryName($tags){
        $query = "SELECT country_name FROM tbl_country WHERE country_tag='$tags'";
        $result = $this->link->query($query);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    
    public function getPrincipalName($id){
        $query = "SELECT principal_name FROM principals_name WHERE id='$id'";
        $result = $this->link->query($query);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    
    public function getCurrency($name){
        $query = "SELECT currency_rate FROM currency WHERE currency_name='$name'";
        $result = $this->link->query($query);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    
    public function getCurrencyName($id){
        $query = "SELECT currency FROM principals_name WHERE id='$id'";
        $result = $this->link->query($query);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    
    public function getConsignmentWeight($tracking_id){
        $query = "SELECT g_weight FROM consignment_booking WHERE tracking_id='$tracking_id'";
        $result = $this->link->query($query);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    
    public function converttousd($pid, $ammount){
        $base = $this->getCurrencyName($pid);
        $price = $this->getCurrency($base);
        $rate = $price*$ammount;
        $usd = $this->getCurrency("USD");
        
        return number_format($rate/$usd, 2);
        
    }
    
    
    public function converttobdt($based, $ammount){
        $currency = $this->getCurrency($based);
        return number_format($currency*$ammount, 2);
    }
    
    
    
    public function getFuelCost($id, $price){
        
        $query = "SELECT * FROM principals_name WHERE id='$id'";
        $result = $this->link->query($query);
        $row = $result->fetch_assoc();
        
        /*$based = $row['based'];*/
        $currency = $row['currency'];
        $fuel_cost = $row['fuel_cost'];
        $airlines_cost = $row['airlines_cost'];
        
        $base_currency = $this->getCurrency($currency);
        $usd = $this->getCurrency('USD');
        
        
        $final_costing = ((($price*$base_currency)/$usd)+((($price*$base_currency)/$usd)*$fuel_cost)/100);
        return number_format($final_costing, 2);
        
        
    }
    
    
    
    public function getPrincipalCosting($id, $price, $unit){
        
        $query = "SELECT * FROM principals_name WHERE id='$id'";
        $result = $this->link->query($query);
        $row = $result->fetch_assoc();
        
        /*$based = $row['based'];*/
        $currency = $row['currency'];
        $fuel_cost = $row['fuel_cost'];
        $airlines_cost = $row['airlines_cost'];
        
        $base_currency = $this->getCurrency($currency);
        $usd = $this->getCurrency('USD');
        
        $unit = $unit/0.5;
        
        
        $final_costing = ((($price*$base_currency)/$usd)+((($price*$base_currency)/$usd)*$fuel_cost)/100)+($unit*$airlines_cost);
        return number_format($final_costing, 2);
        
        
    }
    
    function __construct()
	{
        
        $this->connectDB();
		test_Database();    
	}
    
    
    public function getClientEmail($id){
        $query = "SELECT email FROM corporate_clients WHERE id='$id'";
        $result = $this->link->query($query);
        $row = $result->fetch_row();
        return $row[0];
    }
    
    public function checkRemoteArea($country, $zip, $city, $principal){
        
        $sql = "SELECT * FROM remote_area WHERE principal_id='$principal' AND country='$country' AND city='$city' AND zip_code='$zip'";
        $query = $this->link->query($sql);
        if($query->num_rows > 0){
            return "YES";
        }else{
            return "NO";
        }
    }


}

?>