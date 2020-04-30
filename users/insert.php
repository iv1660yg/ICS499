<?php  

//insert.php

include('database_connection.php');

$message = '';

$form_data = json_decode(file_get_contents("php://input"));

$data = array(
    ':firstname'  => $form_data->firstname,
    ':lastname'  => $form_data->lastname,
    ':password'  => $form_data->password,
    ':email'  => $form_data->email,  
    ':userType'  => $form_data->userType
);

$query = "
 INSERT INTO users 
 (firstname, lastname, password, email, userType) VALUES 
 (:firstname, :lastname, md5(:password), :email, :userType)
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