<?php

if(session_id() === "") session_start();



function get_patient_data(){
    global $con;

    if(!isset($_SESSION['patient_id'])){
        return null;
    }

    $query = "SELECT *  from patients  WHERE id = ? ";
    $params = [$_SESSION['patient_id']];
    $stmt=$con->prepare($query);
    $stmt->execute($params);
    $patient = $stmt->fetch();
    return $patient;
}




function patient_login ($id_number = null , $password = null){
    global $con;



    $query = "SELECT *  from patients  WHERE id_number = ? AND password = ? ";
    $params = [$id_number , sha1($password) ];
    $stmt=$con->prepare($query);
    $stmt->execute($params);
    $patient = $stmt->fetch();
    return $patient;
}

function get_by_id_number ($id_number){
    global $con;
    $query = "SELECT *  from patients  WHERE id_number = ?";
    $params = [$id_number];
    $stmt=$con->prepare($query);
    $stmt->execute($params);
    $patient = $stmt->fetch();
    return $patient;
}
function get_by_mobile ($mobile ){
    global $con;
    $query = "SELECT *  from patients  WHERE mobile = ?";
    $params = [$mobile];
    $stmt=$con->prepare($query);
    $stmt->execute($params);
    $patient = $stmt->fetch();
    return $patient;
}

?>









