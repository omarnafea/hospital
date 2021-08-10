<?php

include '../connect.php';
include '../include/functions/functions.php';
$response = [];
$response['success'] = false;

   $params = [];

    if(isset($_POST['from_date']) && !empty($_POST['from_date']) && isset($_POST['to_date']) && !empty($_POST['to_date']))  {
        $condition = " AND appointments.appointment_date BETWEEN ? AND ? ";
        $params[] = $_POST['from_date'];
        $params[] = $_POST['to_date'];
    }else{

        if(isset($_POST['from_date']) && !empty($_POST['from_date'])){
            $condition = " AND appointments.appointment_date  = ? ";
            $params[] = $_POST['from_date'];

        }else{
            $condition = " AND appointments.appointment_date >= now()";
        }

    }

    if(is_doctor()){
        $clinic_id = get_current_user_data()['clinic_id'];
        $params[] = $clinic_id;
        $condition .= " AND appointments.clinic_id = ? ";
    }





    $query = "Select appointments.*  , clinics.name as clinic_name , tests.name as test_name , patients.name as patient
              from appointments 
              inner join clinics on  appointments.clinic_id = clinics.id 
              inner join patients on patients.id  = appointments.patient_id 
              Left join tests on  tests.id = appointments.test_id 
              WHERE 1  {$condition}
              ";


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



            $cancel_btn = ' <button type="button"  class="btn btn-danger cancel-appointment d-block mb-1"  onclick="cancel_appointment('.$row["id"].')">Cancel</button>';

            if($is_canceled)
            $cancel_btn = ' <button type="button"  class="btn btn-success cancel-appointment d-block mb-1"  onclick="cancel_appointment('.$row["id"].' , 0)">Un Cancel</button>';


            $confirm_btn = '';

            if(!$is_confirmed && !$is_canceled){
                $confirm_btn = ' <button type="button"  class="btn btn-success cancel-appointment d-block mb-1"  onclick="confirm_appointment('.$row["id"].')">Confirm</button>';

            }

            $table_date = "<div>{$row['appointment_date']}</div>";
            $table_from = substr($row['from_time'], 0, -3);
            $to_from = substr($row['to_time'], 0, -3);

            $table_date.= "<div>From : {$table_from}</div>";
            $table_date.= "<div>To : {$to_from}</div>";

            $test_result_button = '';

            if(isset($row['test_name'])){
                $test_result_button = ' <button type="button"  class="btn btn-warning d-block mb-1"  onclick="show_test_result_form('.$row["id"].')">Test Result</button>';
            }




            $table .= '<tr id="'.$row["id"].'">
               <td>'.$i.'</td>
               <td>'.$row['patient'].'</td>
               <td>'.$row['clinic_name'].'</td>
               <td>'.$table_date.'</td>
               <td>'.$test.'</td>
               <td>'.$status.'</td>
               <td>
                   <button type="button"   class="btn btn-primary update-appointment d-block mb-1" onclick="update_appointment('.$row["id"].')">Edit</button>
                   '.$cancel_btn.'
                   '.$confirm_btn.'
                   '.$test_result_button.'
               </td>';
            $i ++;
        }
    }
    $response['success'] = true;
    $response['data'] = $data;
    $response['table'] = $table;







die(json_encode($response));