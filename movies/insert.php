<?php  

//insert.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$data = array(
    ':movie_title'  => $form_data->movie_title,
    ':releaseyear'  => $form_data->releaseyear,
    ':moviedb_id'  => $form_data->moviedb_id,
    ':imdb_id'  => $form_data->imdb_id,  
);

$query = "
 INSERT INTO movies 
 (movie_title, releaseyear, moviedb_id, imdb_id) VALUES 
 (:movie_title, :releaseyear, moviedb_id, :imdb_id)
";

$statement = $connect->prepare($query);

if($statement->execute($data))
{
 $message = 'Data Inserted';
}else {
    
    $message = 'Error unable to insert data';

}


$output = array(
 'message' => $message
);

echo json_encode($output);

?>