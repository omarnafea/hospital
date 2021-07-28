<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../index.php");
    exit();
}
include('../connect.php');

$pass='';

$statement = $con->prepare(
    "UPDATE clinics 
    SET name = :name
    WHERE id = :clinic_id");
$result = $statement->execute(
    array(
        ':name'        => $_POST["name"],
        ':clinic_id'     => $_POST["clinic_id"]
    )
);
if(!empty($result))
{
    echo 'Clinic Data Updated';

}










?>