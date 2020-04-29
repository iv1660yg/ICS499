<?php

// set barcode
if (!empty($_GET['id'])) {

    $moviedb_ID=$_GET['id'];



    //set upc api url
    $url = "https://api.themoviedb.org/3/movie/".$moviedb_ID."?api_key=5a846dc3f5db35f3d5590b415612624c";

    
    
    //call api
    $json = file_get_contents($url);
    $json = json_decode($json);
    
    
    
    
}



?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<table class="moviedetail"">
  <tr>
    <th colspan="2"><h2>Movie Details</h2></th>

  </tr>
  <tr>
    <td>Movie Titles</td>
    <td><?php echo $json->original_title ?></td>
  </tr>
  <tr>
    <td>Movie Poster</td>
    <td><img class="resize" src="https://image.tmdb.org/t/p/w500<?php echo $json->poster_path ?>"></td>
  </tr>
  <tr>
    <td>Cast</td>
    <td><?php echo $cast ?></td>
  </tr>
  <tr>
    <tr>
    <td>Genre</td>
    <td><?php echo $json->genres[0]->name ?></td>
  </tr>
  <tr>
    <tr>
    <td>Release Year</td>
    <td><?php echo $json->release_date ?></td>
  </tr>
  <tr>
    <tr>
    <td>Runtime</td>
    <td><?php echo $json->runtime ?></td>
  </tr> 
  <tr>
    <tr>
    <td>Movie Plot</td>
    <td><?php echo $json->overview ?></td>
  </tr>  

</table>
 
</body>
</html>