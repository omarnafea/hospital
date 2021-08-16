<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../index.php");
    exit();
}
include('../connect.php');


$stmt=$con->prepare("SELECT id FROM tests WHERE name = ? AND id  != ? and clinic_id = ?LIMIT 1 ");
        $stmt->execute(array( $_POST["name"] , $_POST["test_id"]  , $_POST['clinic_id']));
        $row=$stmt->fetch();
        $count=$stmt->rowCount();
        if($count > 0){
            echo 'This test already exist';
            exit();
        }



$statement = $con->prepare(
    "UPDATE tests 
    SET name = :name , price  = :price , clinic_id = :clinic_id
    WHERE id = :test_id");
$result = $statement->execute(
    array(
        ':name'       => $_POST["name"],
        ':price'      => $_POST["price"],
        ':clinic_id'      => $_POST["clinic_id"],
        ':test_id'    => $_POST["test_id"]
    )
);
if(!empty($result))
{
    echo 'Clinic Data Updated';

} ?>