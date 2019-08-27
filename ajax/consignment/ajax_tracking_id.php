<?php
require '../../lib/Session.php';
require "../../lib/Database.php";
require "../../lib/Traking.php";

Session::checkSession();

$db = new Database();
$dbn = new Database();

getTrackingId();

?>