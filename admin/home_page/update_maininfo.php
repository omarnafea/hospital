<?php
session_start();
include('../connect.php');
 
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}

 if (isset($_POST["operation"])) {
   
  
if ($_POST["operation"]=='home_page') {


  
 $statement = $con->prepare(
   "UPDATE home_page 
    SET home_text_en = :home_text_en, home_text_ar = :home_text_ar
    WHERE id = 1");
  $result = $statement->execute(
   array(
    ':home_text_en'         => $_POST["home_text_en"],
    ':home_text_ar'         => $_POST["home_text_ar"]
   )
  );
  if(!empty($result))
  {
   echo 'home page Data Updated';
  
  }
 
}





if ($_POST["operation"]=='about_page') {
  
 $statement = $con->prepare(
   "UPDATE home_page 
    SET about_en = :about_en, about_ar = :about_ar
    WHERE id = 1");
  $result = $statement->execute(
   array(
    ':about_en'         => $_POST["about_text_en"],
    ':about_ar'         => $_POST["about_text_ar"]
   )
  );
  if(!empty($result))
  {
   echo 'about page Data Updated';
  
  }
 
}

 
 }

?>