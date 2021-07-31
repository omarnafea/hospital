<?php

include '../connect.php';
$response = [];
$response['success'] = false;


$patient_id = isset($_COOKIE['patient_id']) ? $_COOKIE['patient_id'] : null;
$id_number =  isset($_POST['id_number']) && !empty($_POST['id_number'])  ?   $_POST['id_number'] : null;


if(!$id_number && !$patient_id){
    $response['success'] = false;
    $response['message'] = 'missing data';
    die(json_encode($response));
}


if(isset($id_number)){
    $stmt =  $con->prepare(
        "SELECT * FROM  patients
    WHERE id_number = ? LIMIT 1");

    $result= $stmt->execute(array(trim($id_number)));
    $patient = $stmt->fetch();
    $check_patient = $stmt->rowCount();

    if($check_patient   > 0){
        $patient_id = $patient['id'];
    }else{
        $response['success'] = false;
        $response['message'] = 'Patient not found';
        die(json_encode($response));
    }
}

$patient = null;

if(isset($patient_id)){

    $stmt =  $con->prepare(
        "SELECT * FROM  patients
    WHERE id = ? LIMIT 1");

    $result= $stmt->execute(array($patient_id));
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    setcookie("patient_id", $patient_id, time()+31536000,'/');


    $query = "Select appointments.*  , clinics.name as clinic_name , tests.name as test_name
              from appointments 
              inner join clinics on  appointments.clinic_id = clinics.id 
              Left join tests on  tests.id = appointments.test_id 
               WHERE patient_id = ? 
              ";

    $params = [$patient_id];

    $check_appointment = $con->prepare($query);
    $result = $check_appointment->execute($params);
    $data = $check_appointment->fetchAll(PDO::FETCH_ASSOC);

    $table = '';
    if(!empty($data)){

        $i = 1;
        foreach ($data as $row){
            $test = isset($row['test_name']) ? $row['test_name'] : "N/A";

            $is_canceled = $row['is_canceled'] == '1';
            $is_confirmed = $row['is_confirmed'] == '1';
            $status = '<span class="text-warning">Need to Confirm</span>';

            if($is_confirmed){
                $status = "<span class='text-success'>Confirmed</span>";
            }

            if($is_canceled){
                $status = "<span class='text-danger'>Canceled</span>";
            }



            $cancel_btn = ' <button type="button"  class="btn btn-danger cancel-appointment"  onclick="cancel_appointment('.$row["id"].')">Cancel</button>';

            if($is_canceled)
            $cancel_btn = ' <button type="button"  class="btn btn-success cancel-appointment"  onclick="cancel_appointment('.$row["id"].' , 0)">Un Cancel</button>';



            $table .= '<tr id="'.$row["id"].'">
               <td>'.$i.'</td>
               <td>'.$row['clinic_name'].'</td>
               <td>'.$row['appointment_date'].'</td>
               <td>'.$row['from_time'].'</td>
               <td>'.$row['to_time'].'</td>
               <td>'.$test.'</td>
               <td>'.$status.'</td>
               <td>
                   <button type="button"  class="btn btn-primary update-appointment" onclick="update_appointment('.$row["id"].')">Edit</button>
                   '.$cancel_btn.'
               </td>';
            $i ++;
        }
    }
    $response['success'] = true;
    $response['data'] = $data;
    $response['table'] = $table;
    $response['patient'] = $patient;



}



die(json_encode($response));