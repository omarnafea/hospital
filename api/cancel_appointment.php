<?php

include '../connect.php';
$appointment_id = $_POST['id'];
$canceled = $_POST['canceled'];

if($canceled == '0'){
    //check appointment date

    $query = "Select * from appointments  WHERE id = ?";
    $check_appointment = $con->prepare($query);
    $result = $check_appointment->execute([$appointment_id]);
    $appointment = $check_appointment->fetch(PDO::FETCH_ASSOC);


    $query = "Select * from appointments WHERE appointment_date = ? 
          AND clinic_id = ? AND is_canceled = 0 AND   (? BETWEEN to_time AND from_time) OR 
   (? BETWEEN to_time AND from_time) OR (? <= from_time AND ? >= to_time) AND id != ?";

    $check_appointment = $con->prepare($query);
    $result = $check_appointment->execute(array($appointment['appointment_date']  , $appointment['clinic_id'] , $appointment['from_time'] ,  $appointment['to_time'], $appointment['from_time'] ,  $appointment['to_time'] , $appointment_id));
    $data = $check_appointment->fetchAll();

    if(!empty($data)){
        $response['success'] = false;
        $response['message'] = "This appointment date not available , please try another date";
    }

}


$statement = $con->prepare("
   UPDATE appointments
    SET is_canceled = ?
    where id = ?");
$result = $statement->execute(
    [$canceled  ,  $appointment_id]
);
$response['success'] = true;

die(json_encode($response));
