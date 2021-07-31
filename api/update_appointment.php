<?php
include '../connect.php';


$response = [];
$appointment_date = $_POST['appointment_date'];
$from_time = $_POST['from_time'];
$to_time = $_POST['to_time'];
$clinic_id = $_POST['clinic_id'];
$test_id = $_POST['test_id'] != '-1' ? $_POST['test_id'] : null;
$appointment_id = $_POST['appointment_id'];

$query = "Select * from appointments  
WHERE appointment_date = ? AND clinic_id = ? AND ? >= from_time AND  ? <= to_time 
AND id != ?  AND is_canceled = 0";

$check_appointment = $con->prepare($query);
$result = $check_appointment->execute(array($appointment_date  , $clinic_id , $from_time , $to_time ,$appointment_id));
$data = $check_appointment->fetchAll();

if(empty($data)){

    $statement = $con->prepare("
   UPDATE appointments
    SET clinic_id = ? , appointment_date = ? ,  from_time = ? , to_time = ? , test_id = ?
    where id = ?");
    $result = $statement->execute(
        [$clinic_id ,$appointment_date , $_POST["from_time"] ,  $_POST["to_time"]  ,$test_id ,  $appointment_id]
    );
    $response['success'] = true;
    //send SMS using SMS service
}else{

    $response['success'] = false;
    $response['message'] = "This appointment date not available , please try another date";
}

die(json_encode($response));