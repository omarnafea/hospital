<?php
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');

$pass='';
  
 $statement = $con->prepare(
   "UPDATE users 
    SET first_name = :first_name,last_name = :last_name ,user_name = :user_name ,password = :password,type=:type
    WHERE user_id = :user_id");
  $result = $statement->execute(
   array(
    ':first_name'        => $_POST["first_name"],
    ':last_name'         => $_POST["last_name"],
    ':user_name'         => $_POST["user_name"],
    ':last_name'         => $_POST["last_name"],
    ':password'          => sha1($_POST["password"]),
    ':type'              => $_POST["user_type"],
    ':user_id'           => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'User Data Updated';
  
  }
 







  

?>