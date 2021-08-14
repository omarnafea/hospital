<?php

if(session_id() === "") session_start();



function get_patient_data(){
    global $con;

    if(!isset($_SESSION['patient_id'])){
        return null;
    }

    $query = "SELECT *  from patinets  WHERE id = ? ";
    $params = [$_SESSION['patient_id']];
    $stmt=$con->prepare($query);
    $stmt->execute($params);
    $patient = $stmt->fetch();
    return $patient;
}




function patient_login ($id_number = null , $password = null){
    global $con;

    if(!isset($_SESSION['patient_id'])){
        return null;
    }

    $query = "SELECT *  from patinets  WHERE id_number = ? AND password = ? ";
    $params = [$id_number , sha1($password) ];
    $stmt=$con->prepare($query);
    $stmt->execute($params);
    $patient = $stmt->fetch();
    return $patient;
}

?>









