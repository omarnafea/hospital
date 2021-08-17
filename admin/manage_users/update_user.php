<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');

$clinic_id = $_POST['clinic_id'] === '-1' ? null : $_POST['clinic_id'];

$pass='';

$params =    array(
    ':name'              => $_POST["name"],
    ':email'             => $_POST["email"],
    ':user_name'         => $_POST["user_name"],
    ':clinic_id'         => $clinic_id,
    ':privilege_id'      => $_POST["privilege_id"],
    ':user_id'           => $_POST["user_id"],


);

if(trim($_POST['password'])  !== ""){

    $pass='password = :password,';

    $params[':password'] = sha1($_POST["password"]);
}


$statement = $con->prepare(
   "UPDATE users 
    SET name = :name,email = :email ,user_name = :user_name ,{$pass}clinic_id=:clinic_id,privilege_id=:privilege_id
    WHERE id = :user_id");
  $result = $statement->execute($params);
  if(!empty($result))
  {
   echo 'User Data Updated';
  
  }
 







  

?>