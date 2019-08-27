<?php


class Accountsummery extends Database {
    
    /*private $db;

	public function __construct(){
		$this->db = new Database();
	}*/
    
    public function totalConsignment($todate, $fromdate){
        $sum = 0;
        
        $fromdate = date('Y-m-d', strtotime('+1 day'));
        
        $sql2 = "SELECT COUNT(id) FROM consignment_booking WHERE date BETWEEN DATE('$todate') AND DATE('$fromdate')";
        $res2 = $this->link->query($sql2);
        $row2 = $res2->fetch_array();
        $sum += $row2[0];
        
        $sql3 = "SELECT COUNT(id) FROM consignment_booking_history WHERE delivered_date BETWEEN DATE('$todate') AND DATE('$fromdate')";
        $res3 = $this->link->query($sql3);
        $row3 = $res3->fetch_array();
        $sum += $row3[0];
        
        return $sum;
        
    }
    
    public function totalDelivered($todate, $fromdate){
        $fromdate = date('Y-m-d', strtotime('+1 day'));
        $sql = "SELECT COUNT(id) FROM consignment_booking_history WHERE shipment_status='DELIVERED' AND delivered_date BETWEEN DATE('$todate') AND DATE('$fromdate')";
        $res = $this->link->query($sql);
        $row = $res->fetch_array();
        return $row[0];
    }
    
    public function totalConsignmentsCharge($todate, $fromdate){
        $sum = 0;
        $fromdate = date('Y-m-d', strtotime('+1 day'));
        $sql1 = "SELECT SUM(booking_price) FROM consignment_booked WHERE date BETWEEN DATE('$todate') AND DATE('$fromdate')";
        $res1 = $this->link->query($sql1);
        $row1 = $res1->fetch_array();
        $sum += $row1[0];
        
        $sql2 = "SELECT SUM(g_shipment_charge) FROM consignment_booking WHERE date BETWEEN DATE('$todate') AND DATE('$fromdate')";
        $res2 = $this->link->query($sql2);
        $row2 = $res2->fetch_array();
        $sum += $row2[0];
        
        $sql3 = "SELECT SUM(booking_price) FROM consignment_booking_history WHERE delivered_date BETWEEN DATE('$todate') AND DATE('$fromdate')";
        $res3 = $this->link->query($sql3);
        $row3 = $res3->fetch_array();
        $sum += $row3[0];
        
        return number_format($sum, 2);
    }
    
    public function totalCredit($todate, $fromdate){
        $sum = 0;
        $fromdate = date('Y-m-d', strtotime('+1 day'));
        $sql = "SELECT SUM(amount) FROM accounts WHERE transaction_type='1' AND (transaction_mode='cash' OR transaction_mode='check') AND transaction_date BETWEEN '$todate' AND '$fromdate'";
        $result = $this->link->query($sql);
        $row = $result->fetch_array();
        $sum += $row[0];
        return number_format($sum, 2);
    }
    
    public function totalDebit($todate, $fromdate){
        $sum = 0;
        $fromdate = date('Y-m-d', strtotime('+1 day'));
         $sql = "SELECT SUM(amount) FROM accounts WHERE transaction_type='0' AND (transaction_mode='cash' OR transaction_mode='check') AND transaction_date BETWEEN '$todate' AND '$fromdate'";
        $result = $this->link->query($sql);
        $row = $result->fetch_array();
        $sum += $row[0];
        return number_format($sum, 2);
    }
    
    public function totalProfit($todate, $fromdate){
        $sum = 0;
        $fromdate = date('Y-m-d', strtotime('+1 day'));
        $sql1 = "SELECT SUM(amount) FROM accounts WHERE transaction_type='1' AND (transaction_mode='cash' OR transaction_mode='check') AND transaction_date BETWEEN '$todate' AND '$fromdate'";
        $res1 = $this->link->query($sql1);
        $row1 = $res1->fetch_array();
        
        $sql2 = "SELECT SUM(amount) FROM accounts WHERE transaction_type='0' AND (transaction_mode='cash' OR transaction_mode='check') AND transaction_date BETWEEN '$todate' AND '$fromdate'";
        $res2 = $this->link->query($sql2);
        $row2 = $res2->fetch_array();
        
        $net = $row1[0] - $row2[0];
        
        
        $sum += $net;
        return number_format($sum, 2);
    }
    
}

?>