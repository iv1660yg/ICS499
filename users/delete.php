<?php

//delete.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$query = "DELETE FROM users WHERE user_id = '".$form_data->user_id."'";

$statement = $connect->prepare($query);
if($statement->execute())
{
 $message = 'Data Deleted';
}else {
    
    $message = 'Error unable to delete data';

} 


$output = array(
 'message' => $message
);

echo json_encode($output);

?>