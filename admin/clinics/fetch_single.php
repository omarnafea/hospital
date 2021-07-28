<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
  
 
 $output = array();
 $get_maininfo_data = $con->prepare(
  "SELECT * FROM  clinics
    WHERE id = ? LIMIT 1");
 $get_maininfo_data->execute(array($_POST['clinic_id']));
 $result = $get_maininfo_data->fetch();
  $output["name"]           =   $result["name"];
  echo json_encode($output);

?>