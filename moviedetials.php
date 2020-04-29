<?php

// set barcode
if (!empty($_GET['moviedb'])) {

    $moviedb_ID=$_GET['moviedb'];



    //set upc api url
    $url = "https://api.themoviedb.org/3/movie/".$moviedb_ID."?api_key=5a846dc3f5db35f3d5590b415612624c"

    
    
    
    //call api
    $json = file_get_contents($url);
    $json = json_decode($json);
    
    $title=$json->description;
    
    echo $title;

}



?>