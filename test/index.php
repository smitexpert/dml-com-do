<?php
require_once(__DIR__ . '/php-tracking-urls.php');

$errors = false;

$tracking = '478290518578';
$url = get_tracking($tracking);
echo $url;

?>