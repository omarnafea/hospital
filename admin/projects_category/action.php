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
   "UPDATE categories 
    SET  active='yes'
    WHERE cat_id = :cat_id");
  $result = $statement->execute(
   array(
    ':cat_id'           => $_POST["cat_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Category Activated';
  
  }
 
}


if ($_POST['action']=='deactive') {

  $statement = $con->prepare(
   "UPDATE categories 
    SET  active='no'
    WHERE cat_id = :cat_id");
  $result = $statement->execute(
   array(
    ':cat_id'           => $_POST["cat_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Category DeActivated';
  
  }
 
}



}
  
 
 







  

?>