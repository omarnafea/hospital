<?php


include "../connect.php";


$query = "Select appointments.*  , clinics.name as clinic_name , tests.name as test_name
              from appointments 
              inner join clinics on  appointments.clinic_id = clinics.id 
              Left join tests on  tests.id = appointments.test_id 
               WHERE appointments.id = ? 
              ";

$params = [$_POST['id']];

$check_appointment = $con->prepare($query);
$result = $check_appointment->execute($params);
$data = $check_appointment->fetch(PDO::FETCH_ASSOC);
die(json_encode($data));