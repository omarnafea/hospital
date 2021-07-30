<?php

include '../connect.php';
$appointment_id = $_POST['id'];
$canceled = $_POST['canceled'];
$statement = $con->prepare("
   UPDATE appointments
    SET is_canceled = ?
    where id = ?");
$result = $statement->execute(
    [$canceled  ,  $appointment_id]
);
$response['success'] = true;

die(json_encode($response));
