<?php

//create short variable names
$barcode =$_POST['isbn_input'];

$url = "https://api.upcdatabase.org/product/'".$barcode."'?apikey=67BDE043D668B6EE5508863B7441C873";

$myJSON = json_encode($url);

echo $myJSON;

?>