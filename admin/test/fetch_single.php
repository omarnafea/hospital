<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
  
 
 $output = array();
 $get_maininfo_data = $con->prepare(
  "SELECT * FROM  tests
    WHERE id = ? LIMIT 1");
 $get_maininfo_data->execute(array($_POST['test_id']));
 $result = $get_maininfo_data->fetch();
  $output["name"]           =   $result["name"];
  $output["price"]           =   $result["price"];
  echo json_encode($output);

?>