<?php
include "../connect.php";
$response = [];

$patient = patient_login($_POST['id_number'] , $_POST['password']);

if ($patient){
$response['success'] = true;
 $_SESSION['patient_id'] = $patient['id'];
 $_SESSION['name'] = $patient['name'];
}else{
    $response['success'] = false;
    $response['message'] = "Invalid Login";
}



echo json_encode($response);