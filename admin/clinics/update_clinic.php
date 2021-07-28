<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../index.php");
    exit();
}
include('../connect.php');


$stmt=$con->prepare("SELECT id FROM clinics WHERE name = ? AND id  != ? LIMIT 1 ");
        $stmt->execute(array( $_POST["name"] , $_POST["clinic_id"]));
        $row=$stmt->fetch();
        $count=$stmt->rowCount();
        if($count > 0){
            echo 'This clinic already exist';
            exit();
        }



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