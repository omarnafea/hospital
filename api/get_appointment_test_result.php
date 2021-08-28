<?php

include '../connect.php';
$response = [];
$response['success'] = true;

$tests_query =  "Select appointment_tests.*  , tests.name as test_name 
              from appointment_tests
              inner join tests on  tests.id = appointment_tests.test_id 
               WHERE  appointment_id= ? 
              ";

$check_tests = $con->prepare($tests_query);
$result = $check_tests->execute([$_POST['id']]);
$tests = $check_tests->fetchAll(PDO::FETCH_ASSOC);

$response['data'] = $tests;
die(json_encode($response));