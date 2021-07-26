<?php
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');

if(isset($_POST['action'])){

if ($_POST['action']=='active') {
  $statement = $con->prepare(
   "UPDATE users 
    SET  active='yes'
    WHERE user_id = :user_id");
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


if ($_POST['action']=='deactive') {

  $statement = $con->prepare(
   "UPDATE users 
    SET  active='no'
    WHERE user_id = :user_id");
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