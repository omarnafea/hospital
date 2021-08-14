<?php
include "../connect.php";
$response = [];

if(patient_login ($_POST['id_number'] , $_POST['password'])){
$response['success'] = true;
}else{
    $response['success'] = false;
    $response['message'] = "Invalid Login";
}



echo json_encode($response);