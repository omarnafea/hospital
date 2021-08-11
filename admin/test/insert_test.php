<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../index.php");
    exit();
}
include('../connect.php');

$stmt=$con->prepare("SELECT id FROM tests WHERE name = ? LIMIT 1 ");
        $stmt->execute(array( $_POST["name"]));
        $row=$stmt->fetch();
        $count=$stmt->rowCount();
        if($count > 0){
            echo 'This test  already exist';
            exit();
        }


$statement = $con->prepare("
   INSERT INTO tests (name  , price , clinic_id) 
   VALUES (:name , :price , :clinic_id)");
$result = $statement->execute(
    array(
        ':name'            => $_POST["name"],
        ':price'           => $_POST["price"],
        ':clinic_id'       => $_POST['clinic_id']
    )
);
if(!empty($result))
{
    echo 'test Data inserted';
}else {
    echo 'there are some errors'."<br>";

}