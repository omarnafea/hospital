<?php

include '../connect.php';
$response = [];
$response['success'] = false;


$patient_id = $_SESSION['patient_id'];


$patient = null;

if(isset($patient_id)){

    $stmt =  $con->prepare(
        "SELECT * FROM  patients
    WHERE id = ? LIMIT 1");

    $result= $stmt->execute(array($patient_id));
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    setcookie("patient_id", $patient_id, time()+31536000,'/');


    $query = "Select appointments.*  , clinics.name as clinic_name 
              from appointments 
              inner join clinics on  appointments.clinic_id = clinics.id 
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

            $tests_query =  "Select appointment_tests.*  , tests.name as test_name 
              from appointment_tests
              inner join tests on  tests.id = appointment_tests.test_id 
               WHERE  appointment_id= ? 
              ";

            $check_tests = $con->prepare($tests_query);
            $result = $check_tests->execute([$row['id']]);
            $tests = $check_tests->fetchAll(PDO::FETCH_ASSOC);

            $tests_names = "N/A";
            $show_result_btn = "";
            if(!empty($tests)){
                $tests_names = implode(',' ,array_column($tests , 'test_name') );
                $show_result_btn =  '<button type="button"  class="btn btn-info"  onclick="show_result('.$row["id"].')">Show tests result</button>';
            }


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
               <td>'.$tests_names.'</td>
               <td>'.$row['notes'].'</td>
               <td>'.$status.'</td>
               <td>
                   <button type="button"  class="btn btn-primary update-appointment" onclick="update_appointment('.$row["id"].')">Edit</button>
                   '.$cancel_btn.'
                   '.$show_result_btn.'
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