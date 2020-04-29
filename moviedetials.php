<?php

// set barcode
if (!empty($_GET['id'])) {

    $moviedb_ID=$_GET['id'];



    //set upc api url
    $url = "https://api.themoviedb.org/3/movie/".$moviedb_ID."?api_key=5a846dc3f5db35f3d5590b415612624c";

    echo $url;
    
    
    //call api
    $json = file_get_contents($url);
    $json = json_decode($json);
    
    
    
    echo $jsondb->original_title;

    echo $jsondb->overview;
}



?>