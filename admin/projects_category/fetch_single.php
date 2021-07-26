<?php
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
  
 
 $output = array();
 $get_maininfo_data = $con->prepare(
  "SELECT * FROM  categories
    WHERE cat_id = ? LIMIT 1");
 $get_maininfo_data->execute(array($_POST['cat_id']));
 $result = $get_maininfo_data->fetch();

 $get_catname = $con->prepare(
  "SELECT cat_name FROM  categories
    WHERE cat_id = ? LIMIT 1");
 $get_catname->execute(array($result['parent']));
 $parent = $get_catname->fetch();


 
  $output["cat_name"]      =   $result["cat_name"];
  $output["cat_name_ar"]   =   $result["cat_name_ar"];
  $output["cat_image"]     ='<img src="data:image/jpeg;base64,'.base64_encode($result["cat_image"] ).'" height="200px"/>';
  $output["cat_id"]        =   $result["cat_id"];
  $output["parent_id"]     =   $result["parent"];

  $output["parent_name"]   =   $parent["cat_name"];
  
  
 
  echo json_encode($output);

?>