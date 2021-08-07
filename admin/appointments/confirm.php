<?php

include '../connect.php';
$appointment_id = $_POST['id'];


$statement = $con->prepare("
   UPDATE appointments
    SET is_confirmed = 1
    where id = ?");
$result = $statement->execute(
    [ $appointment_id]
);
$response['success'] = true;

die(json_encode($response));
