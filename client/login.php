<?php

include("lib/Database.php");
include("lib/Session.php");



function agent_login($table_id, $password, $client_id){
    Session::checkLogin();
    $password = md5($password);
    $db = new Database();
    
    $sql = "SELECT * FROM agent_clients WHERE id='$table_id' AND password='$password' AND status='1'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        while($row = $query->fetch_assoc()){
            Session::set('agent_login', true);
            Session::set('agent_id', $client_id);
            Session::set('client_table_id', $row['id']);
            Session::set('agent_email', $row['email']);
            Session::set('agent_name', $row['name']);
            Session::set('agent_company', $row['company_name']);
            Session::set('contact', $row['contact']);
            Session::set('address', $row['address']);
            Session::set('type', "agent");
        }
        header('Location: /client/');
    }else{
        return "0";
    }
}

function client_login($client_id, $password){
    $db = new Database();
    $sql = "SELECT * FROM client_table WHERE client_id='$client_id'";
    $query = $db->link->query($sql);
    if($query->num_rows > 0){
        $row = $query->fetch_assoc();
        if($row['client_type'] == 'agent'){
            $table_id = $row['table_id'];
            if(agent_login($table_id, $password, $client_id) == '0'){
                return "0";
            }
        }else{
            return "0";
        }
    }else{
        return "0";
    }
}

?>