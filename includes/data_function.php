<?php

require_once __DIR__."/../function.php";
require_once __DIR__."/../ajax/ajax_principal_check.php";





function principal_accounts($key){
    if($key > valid())
        return true;
    else
        return false;
}

function get_content(){
    return 'includes/footer.php';
}

function get_content_p(){
    return 'lib/ajax_principal_price.php';
}

/*principal_accounts(principal_check());*/
    

?>