<?php
    function ocs_tracking($org){
        ?>
<iframe id="myIframe" style="width: 100%; min-height: 400px;" src="https://webcsw.ocs.co.jp/csw/ECSWG0201R00003P.do?edtAirWayBillNo=<?php echo $org; ?>" frameborder="0"></iframe>

        <?php
    }
?>