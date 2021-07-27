<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');

  
 $statement = $con->prepare(
   "UPDATE categories 
    SET cat_name = :cat_name,cat_name_ar = :cat_name_ar ,parent= :cat_parent 
    WHERE cat_id = :cat_id");
  $result = $statement->execute(
   array(
    ':cat_name'          => $_POST["cat_name"],
    ':cat_name_ar'       => $_POST["cat_name_ar"],
    ':cat_parent'        => $_POST["cat_parent"],
    ':cat_id'            => $_POST["cat_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Category Data Updated';
  
  }
 







  

?>