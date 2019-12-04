<?php
function dhl_tracking($awn){
    ?>
<style>
    #myframe {
        width: 100%;
        height: 100vh;
    }
</style>
<iframe src="https://www.dhl.com/en/hidden/component_library/express/local_express/dhl_de_tracking/en/tracking_dhlde.html?AWB=<?php echo $awn; ?>&brand=DHL" frameborder="0" id="myframe"></iframe>
    <?php
}

?>