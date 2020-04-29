<?php

//create short variable names
$barcode =$_POST['isbn_input'];

$url = "https://api.upcdatabase.org/product/'".$barcode."'?apikey=67BDE043D668B6EE5508863B7441C873";

//call api
$json = file_get_contents($url);
$json = json_decode($json);

echo $json;

?>