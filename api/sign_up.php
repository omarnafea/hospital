<?php
include "../connect.php";
$response = [];


if($_POST['password'] != $_POST['confirm_password']){
    $response['success'] = false;
    $response['message'] = "Passwords not Matches";
     echo json_encode($response);
}

if(get_by_id_number($_POST['id_number'])){
    $response['success'] = false;
    $response['message'] = "This ID Number Already exist";
    echo json_encode($response);
}

if(get_by_mobile($_POST['mobile'])){
    $response['success'] = false;
    $response['message'] = "This  Mobile Already exist";
    echo json_encode($response);
}

$statement = $con->prepare("
   INSERT INTO patients (id_number , mobile, name ,password)
                 VALUES (:id_number, :mobile,:name,:password  )");
$result = $statement->execute(
    array(
        ':id_number'   =>  $_POST["id_number"] ,
        ':mobile'      =>  $_POST["mobile"],
        ':name'        =>  $_POST["name"],
        ':password'    => sha1($_POST["password"])
    )
);
$response['success'] = true;

$patient_id = $con->lastInsertId();
$_SESSION['patient_id'] = $patient_id;
$_SESSION['name'] = $_POST['name'];


echo json_encode($response);