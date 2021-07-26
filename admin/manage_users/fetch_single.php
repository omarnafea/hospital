<?php
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
  
 
 $output = array();
 $get_maininfo_data = $con->prepare(
  "SELECT * FROM  users
    WHERE user_id = ? LIMIT 1");
 $get_maininfo_data->execute(array($_POST['user_id']));
 $result = $get_maininfo_data->fetch();

 
  $output["first_name"]     =   $result["first_name"];
  $output["last_name"]      =   $result["last_name"];
  $output["user_name"]      =   $result["user_name"];
  $output["user_id"]        =   $result["user_id"];
  $output["user_type"]      =   $result["type"];
  $output["password"]       =   $result["password"];
  
 
  echo json_encode($output);

?>