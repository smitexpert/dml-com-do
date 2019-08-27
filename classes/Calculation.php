<?php


class Calculation extends Database {
    
    /*private $db;

	public function __construct(){
		$this->db = new Database();
	}*/
    
    public function totalConsignment(){
        $sum = 0;
        
        $sql2 = "SELECT COUNT(id) FROM consignment_booking";
        $res2 = $this->link->query($sql2);
        $row2 = $res2->fetch_array();
        $sum += $row2[0];
        
        $sql3 = "SELECT COUNT(id) FROM consignment_booking_history";
        $res3 = $this->link->query($sql3);
        $row3 = $res3->fetch_array();
        $sum += $row3[0];
        
        return $sum;
        
    }
    
    public function totalDelivered(){
        $sql = "SELECT COUNT(id) FROM consignment_booking_history WHERE shipment_status='DELIVERED'";
        $res = $this->link->query($sql);
        $row = $res->fetch_array();
        return $row[0];
    }
    
    public function totalConsignmentsCharge(){
        $sum = 0;
        $sql1 = "SELECT SUM(booking_price) FROM consignment_booked";
        $res1 = $this->link->query($sql1);
        $row1 = $res1->fetch_array();
        $sum += $row1[0];
        
        $sql2 = "SELECT SUM(g_shipment_charge) FROM consignment_booking";
        $res2 = $this->link->query($sql2);
        $row2 = $res2->fetch_array();
        $sum += $row2[0];
        
        $sql3 = "SELECT SUM(booking_price) FROM consignment_booking_history";
        $res3 = $this->link->query($sql3);
        $row3 = $res3->fetch_array();
        $sum += $row3[0];
        
        return number_format($sum, 2);
    }
    
    public function totalCredit(){
        $sql = "SELECT SUM(amount) FROM accounts WHERE transaction_type='1' AND (transaction_mode='cash' OR transaction_mode='check')";
        $result = $this->link->query($sql);
        $row = $result->fetch_array();
        return $row[0];
    }
    
    public function totalDebit(){
         $sql = "SELECT SUM(amount) FROM accounts WHERE transaction_type='0' AND (transaction_mode='cash' OR transaction_mode='check')";
        $result = $this->link->query($sql);
        $row = $result->fetch_array();
        return $row[0];
    }
    
    public function totalProfit(){
        $sql1 = "SELECT SUM(amount) FROM accounts WHERE transaction_type='1' AND (transaction_mode='cash' OR transaction_mode='check')";
        $res1 = $this->link->query($sql1);
        $row1 = $res1->fetch_array();
        
        $sql2 = "SELECT SUM(amount) FROM accounts WHERE transaction_type='0' AND (transaction_mode='cash' OR transaction_mode='check')";
        $res2 = $this->link->query($sql2);
        $row2 = $res2->fetch_array();
        
        return $row1[0] - $row2[0];
    }
    
}

?>