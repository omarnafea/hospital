<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../index.php");
    exit();
}
include('../connect.php');


$statement = $con->prepare("
   INSERT INTO clinics (name) 
   VALUES (:name)");
$result = $statement->execute(
    array(
        ':name'            => $_POST["name"]
    )
);
if(!empty($result))
{
    echo 'Clinic Data inserted';
}else {
    echo 'there are some errors'."<br>";

}