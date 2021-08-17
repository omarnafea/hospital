<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300); 
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');

$clinic_id = $_POST['clinic_id'] === '-1' ? null : $_POST['clinic_id'];


$statement = $con->prepare("
   INSERT INTO users (name, email,user_name,password,privilege_id , clinic_id) 
   VALUES (:name, :email, :user_name,:password,:privilege_id , :clinic_id)");
  $result = $statement->execute(
   array(
    ':name'            => $_POST["name"],
    ':email'           => $_POST["email"],
    ':user_name'       => $_POST["user_name"],
    ':password'        => sha1($_POST["password"]),
    ':privilege_id'    => $_POST["privilege_id"],
    ':clinic_id'       => $clinic_id
   )
  );
  if(!empty($result))
  {
   echo ' User Data inserted';
  }else {
    echo 'there are some errors'."<br>";
   
  }