<?php

// set barcode
$bar=$_POST['isbn_input'];

echo $bar;
//set upc api url
$url = "https://api.upcdatabase.org/product/".$bar."?apikey=67BDE043D668B6EE5508863B7441C873";

//call api
$json = file_get_contents($url);
$json = json_decode($json);

echo $json;

?>