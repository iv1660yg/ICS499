<?php  

//edit.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$data = array(
 ':firstname'  => $form_data->firstname,
 ':lastname'  => $form_data->lastname,
 ':password'  => $form_data->password,
 ':email'  => $form_data->email,
 ':userType'  => $form_data->userType,
 ':user_id'    => $form_data->user_id
);

$query = "
 UPDATE users 
 SET firstname = :firstname, lastname = :lastname, password = md5(:password), email = :email, userType = :userType   
 WHERE user_id = :user_id
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