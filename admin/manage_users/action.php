<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');

if(isset($_POST['action'])){

if ($_POST['action']=='active') {
  $statement = $con->prepare(
   "UPDATE users 
    SET  is_active= 1
    WHERE id = :user_id");
  $result = $statement->execute(
   array(
    ':user_id'           => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'User Activated';
  
  }
 
}


if ($_POST['action']=='deactive') {

  $statement = $con->prepare(
   "UPDATE users 
    SET  is_active= 0
    WHERE id = :user_id");
  $result = $statement->execute(
   array(
    ':user_id'           => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'User DeActivated';
  
  }
 
}



}
  
 
 







  

?>