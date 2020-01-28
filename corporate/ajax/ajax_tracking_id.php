<?php
require '../../lib/Session.php';
require "../../lib/Database.php";
require "../../lib/Traking.php";

Session::checkCorporateSession();

$db = new Database();
$dbn = new Database();

getTrackingId();

?>