<?php

function getTrackUrl($val, $awn){
    $url = [
        'DHL'=> [
            'name'  => 'DHL',
            'url'   => 'http://www.dhl.com/content/g0/en/express/tracking.shtml?brand=DHL&AWB='.$awn,
        ],
        'FEDEX' => [
            'name'  => 'FEDEX',
            'url'   => 'http://www.fedex.com/Tracking?language=english&cntry_code=us&tracknumbers='.$awn,
        ],
        'ARAMEX' => [
            'name'  => 'ARAMEX',
            'url'   => 'https://www.aramex.com/track/results?mode=1&ShipmentNumber='.$awn,
        ],
        'FIRSTFLIGHT' => [
            'name'  => 'FIRST FLIGHT',
            'url'   => 'http://www.firstflightme.com/Track-Shipment?awb='.$awn,
        ],
        'NICEEXPRESS' => [
            'name'  => 'NICE EXPRESS',
            'url'   => 'http://www.niceexpress.net/billStatusSearch.do?code='.$awn,
        ],
        'DPEX' => [
            'name'  => 'DPEX',
            'url'   => 'https://ws01.ffdx.net/v4/etrack_blank.aspx?stid=dpex&version=dpex&txtinput=hide&reqpod=hide&option=,8,&cn='.$awn,
        ],
        'DPD' => [
            'name'  => 'DPD',
            'url'   => 'https://tracking.dpd.de/parcelstatus?query='.$awn.'&locale=en_D2',
        ],
        'SKYNET' => [
            'name'  => 'SKYNET',
            'url'   => 'https://sky.skynet.net/public/Tracking.aspx?guide='.$awn,
        ],
        'OCS' => [
            'name'  => 'OCS',
            'url'   => 'https://webcsw.ocs.co.jp/csw/ECSWG0201R00003P.do?edtAirWayBillNo='.$awn,
        ],
        'BLUEDART' => [
            'name'  => 'BLUE DART',
            'url'   => '',
        ],
        'TNT' => [
            'name'  => 'TNT',
            'url'   => 'https://www.tnt.com/express/en_bd/site/shipping-tools/tracking.html?searchType=con&cons='.$awn,
        ],
        'SF' => [
            'name'  => 'SF EXPRESS',
            'url'   => 'http://www.sf-express.com/cn/sc/dynamic_function/waybill/#search/bill-number/'.$awn,
        ],
        'AIRBORNE' => [
            'name'  => 'ELITE AIR BORNE',
            'url'   => 'https://www.eliteairborne.com/tracking_details.php?id='.$awn,
        ],
    ];
    
    
    
    if(isset($url[$val])){
        $sen= [
            'name' => $url[$val]['name'],
            'url' => $url[$val]['url'],
        ];
        return $sen;
    }else{
        return false;
    }
}

?>