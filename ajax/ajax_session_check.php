<?php
require '../lib/Session.php';
Session::init();

if(Session::get("login") == true){
    echo "1";
}else{
    echo "0";
}

// echo "HEllo";

// if(isset($_POST['checkLogin'])){
    
    
// }