<?php

// set barcode
if (!empty($_POST['isbn_input'])) {

    $barcode=$_POST['isbn_input'];



    //set upc api url
    $url = "http://api.upcdatabase.org/product/".$barcode."?apikey=67BDE043D668B6EE5508863B7441C873";
    
    
    
    //call api
    $json = file_get_contents($url);
    $json = json_decode($json);
    
    $title=$json->description;
    
    echo $title;

}



?>