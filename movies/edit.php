<?php  

//edit.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$data = array(
 ':movie_title'  => $form_data->movie_title,
 ':releaseyear'  => $form_data->releaseyear,
 ':moviedb_id'  => $form_data->moviedb_id,
 ':imdb_id'  => $form_data->imdb_id,
 ':movie_id'    => $form_data->movie_id
);

$query = "
 UPDATE movies 
 SET movie_title = :movie_title, releaseyear = :releaseyear, moviedb_id = :moviedb_id, imdb_id = :imdb_id   
 WHERE movie_id = :movie_id
";

$statement = $connect->prepare($query);
if($statement->execute($data))
{
 $message = 'Data Edited';
}else {
    
    $message = 'Error unable to edit data';

}


$output = array(
 'message' => $message
);

echo json_encode($output);

?>