<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../index.php");
    exit();
}
include('../connect.php');


$statement = $con->prepare(
    "UPDATE clinics 
    SET is_active = :is_active
    WHERE id = :clinic_id");
$result = $statement->execute(
    array(
        ':is_active'     => $_POST["active"],
        ':clinic_id'     => $_POST["clinic_id"]
    )
);
if(!empty($result))
{
    echo 'Clinic Data Updated';

}










?>