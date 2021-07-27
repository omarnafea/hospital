<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300); 
include('../connect.php');

session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}

$img_file = addslashes(file_get_contents($_FILES["company_logo"]["tmp_name"]));
 $statement = $con->prepare(
   "UPDATE home_page 
    SET logo ='$img_file'
    WHERE id = 1");
  $result = $statement->execute();
  if(!empty($result))
  {
   echo 'company logo file Updated';
  }
  