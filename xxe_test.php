<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml = file_get_contents('php://input');
}
else{
    $xml = @$_GET['input'];
}

if($xml){
    $data = simplexml_load_string($xml, null, LIBXML_NOENT);
    $title = $data->title;
    echo $data;
}
else{
    die('Please specify xml by raw post data or input query string.');
}
/*
Cette vulnérabilité XXE est bien présente mais ne fonctionne que sur des anciennes versions de php (ex : 7.4)
Avec le temps imparti, il n'a pas été possible de la faire fonctionner avec une autre version de php.

Cette XXE est donc bien présente mais pas exploitable
*/
?>
