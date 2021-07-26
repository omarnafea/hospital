<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300); 
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');

$statement = $con->prepare("
   INSERT INTO users (first_name, last_name,user_name,password,type) 
   VALUES (:first_name, :last_name, :user_name,:password,:type)");
  $result = $statement->execute(
   array(
    ':first_name'     => $_POST["first_name"],
    ':last_name'      => $_POST["last_name"],
    ':user_name'      => $_POST["user_name"],
    ':password'       => sha1($_POST["password"]),
    ':type'           => $_POST["user_type"]
   )
  );
  if(!empty($result))
  {
   echo ' User Data inserted';
  }else {
    echo 'there are some errors'."<br>";
   
  }