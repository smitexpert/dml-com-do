<?php

function airborne_tracking($org){
    $ch = curl_init("https://www.eliteairborne.com/tracking_details.php?id=".$org);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    $content = curl_exec($ch);
    curl_close($ch);
    
    $output = preg_replace('<img src="./images/AirborneLogo_100px.jpg">', 'img src="https://www.eliteairborne.com/images/AirborneLogo_100px.jpg"',$content);
    $output = str_replace("position: absolute; margin: auto; width:100vw; top:50px;", '',$output);
    
    echo $output;
}



?>