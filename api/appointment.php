<?php
include '../connect.php';


$stmt =  $con->prepare(
    "SELECT id FROM  patients
    WHERE id_number = ? LIMIT 1");

$result= $stmt->execute(array(trim($_POST['id_number'])));
$patient = $stmt->fetch();
$check_patient = $stmt->rowCount();

if($check_patient   > 0){
    $patient_id = $patient['id'];
}else{

    $statement = $con->prepare("
   INSERT INTO patients (name, mobile,place_of_living,birth_date,id_number , gender , have_insurence)
                 VALUES (:name, :mobile,:place_of_living,:birth_date , :id_number , :gender , :have_insurence)");
    $result = $statement->execute(
        array(
            ':name'             => $_POST["name"],
            ':mobile'           => $_POST["mobile"],
            ':place_of_living'  => $_POST["place_of_living"],
            ':birth_date'       => $_POST["birth_date"],
            ':id_number'        => $_POST["id_number"],
            ':gender'           => $_POST["gender"],
            ':have_insurence'   => $_POST["have_insurance"]

        )
    );
    $patient_id = $con->lastInsertId();
}

setcookie("patient_id", $patient_id, time()+31536000,'/');



$response = [];
$appointment_date = $_POST['appointment_date'];
$from_time = $_POST['from_time'];
$to_time = $_POST['to_time'];
$clinic_id = $_POST['clinic_id'];
$test_id = $_POST['test_id'] != '-1' ? $_POST['test_id'] : null;

//$time_check = " AND   ? >= from_time AND  ? <= to_time";
$time_check = " AND   (? BETWEEN to_time AND from_time) OR 
   (? BETWEEN to_time AND from_time) OR (? <= from_time AND ? >= to_time)";



$query = "Select * from appointments  WHERE appointment_date = ? AND clinic_id = ? 
    AND is_canceled = 0 $time_check";


$check_appointment = $con->prepare($query);
$result = $check_appointment->execute(array($appointment_date  , $clinic_id , $from_time , $to_time,$from_time , $to_time));

$data = $check_appointment->fetchAll();

if(empty($data)){

    $statement = $con->prepare("
   INSERT INTO appointments (patient_id, clinic_id,appointment_date,from_time,to_time , test_id)
                 VALUES (:patient_id, :clinic_id,:appointment_date,:from_time , :to_time , :test_id)");
    $result = $statement->execute(
        array(
            ':patient_id'        => $patient_id ,
            ':clinic_id'         => $clinic_id,
            ':appointment_date'  => $appointment_date,
            ':from_time'         => $_POST["from_time"],
            ':to_time'           => $_POST["to_time"],
            ':test_id'           => $test_id
        )
    );
    $response['success'] = true;
    //send SMS using SMS service
}else{

    $response['success'] = false;
    $response['message'] = "This appointment date not available , please try another date";
}

die(json_encode($response));