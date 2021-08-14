<?php


include "../connect.php";


$query = "Select appointments.*  , clinics.name as clinic_name
              from appointments 
              inner join clinics on  appointments.clinic_id = clinics.id 
               WHERE appointments.id = ? 
              ";

$params = [$_POST['id']];

$check_appointment = $con->prepare($query);
$result = $check_appointment->execute($params);
$data = $check_appointment->fetch(PDO::FETCH_ASSOC);


$query = "Select 	appointment_tests.*  , tests.name as test_name
              from appointment_tests 
              inner join tests on  appointment_tests.test_id = tests.id
              WHERE appointment_tests.appointment_id = ?";
$get_tests = $con->prepare($query);
$result = $get_tests->execute($params);
$tests = $get_tests->fetchAll(PDO::FETCH_ASSOC);


$result = [];
$tests_ids = [];



if(!empty($tests)){
    $tests_ids = array_column($tests , 'test_id');
}

$result['appointment'] = $data;
$result['tests'] = $tests;
$result['tests_ids'] = $tests_ids;
die(json_encode($result));