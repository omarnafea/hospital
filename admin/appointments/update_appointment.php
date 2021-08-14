<?php
include '../connect.php';


$response = [];
$appointment_date = $_POST['appointment_date'];
$from_time = $_POST['from_time'];
$to_time = $_POST['to_time'];
$clinic_id = $_POST['clinic_id'];
$test_ids = $_POST['test_ids'] ;
$appointment_id = $_POST['appointment_id'];





$query = "Select * from appointments  
WHERE appointment_date = ? AND clinic_id = ? AND is_canceled = 0 AND  (  (? BETWEEN to_time AND from_time) OR 
   (? BETWEEN to_time AND from_time) OR (? <= from_time AND ? >= to_time) ) AND id != ?";

$check_appointment = $con->prepare($query);
$result = $check_appointment->execute(array($appointment_date  , $clinic_id , $from_time , $to_time,$from_time , $to_time , $appointment_id));
$data = $check_appointment->fetchAll();

if(empty($data)){
    $statement = $con->prepare("
   UPDATE appointments
    SET clinic_id = ? , appointment_date = ? ,  from_time = ? , to_time = ?  , notes = ?
    where id = ?");
    $result = $statement->execute(
        [$clinic_id ,$appointment_date , $_POST["from_time"] ,  $_POST["to_time"]  , $_POST["notes"]  ,  $appointment_id]
    );
    $response['success'] = true;
    //send SMS using SMS service


    $old_tests = getTests($appointment_id);

    foreach ($test_ids as $new_test){
        if(!in_array($new_test , $old_tests )){
            add_test($new_test , $appointment_id);
        }
    }
    foreach ($old_tests as $old_test){
        if(!in_array($old_test  , $test_ids)){
            delete_test($old_test , $appointment_id);
        }
    }

}else{

    $response['success'] = false;
    $response['message'] = "This appointment date not available , please try another date";
}

die(json_encode($response));



function getTests($app_id){
global $con;
    $query = "Select 	appointment_tests.*  , tests.name as test_name
              from appointment_tests 
              inner join tests on  appointment_tests.test_id = tests.id
              WHERE appointment_tests.appointment_id = ?";
    $get_tests = $con->prepare($query);
    $result = $get_tests->execute([$app_id]);
    $tests = $get_tests->fetchAll(PDO::FETCH_ASSOC);
    return array_column($tests , 'test_id');
}

function add_test($test_id , $app_id){
    global $con;
    $statement = $con->prepare("
   INSERT INTO appointment_tests (appointment_id , test_id) 
   VALUES (:appointment_id , :test_id)");
    $result = $statement->execute(
        array(
            ':appointment_id'  => $app_id ,
            ':test_id'         => $test_id
        )
    );
}

function delete_test($id , $app_id){
    global $con;
    $statement = $con->prepare("
   Delete from appointment_tests WHERE test_id = ? AND  appointment_id = ? ");
    $result = $statement->execute(
        array($id , $app_id)
    );
}