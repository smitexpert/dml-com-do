<?php

include("lib/Database.php");
include("lib/Session.php");

Session::checkLogin();

function agent_login($email, $password){
    $password = md5($password);
    $db = new Database();
    
    $sql = "SELECT * FROM agent_clients WHERE email='$email' AND password='$password' AND status='1'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            Session::set('agent_login', true);
            Session::set('agent_email', $row['email']);
            Session::set('agent_name', $row['name']);
            Session::set('agent_company', $row['company_name']);
        }
        header('Location: agent/');
    }else{
        return "0";
    }
}

?>