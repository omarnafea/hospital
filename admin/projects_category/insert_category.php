<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300); 
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');


$image_file = addslashes(file_get_contents($_FILES["cat_image"]["tmp_name"][0]));
$statement = $con->prepare("
   INSERT INTO categories (cat_name, cat_name_ar, cat_image,parent) 
   VALUES (:cat_name, :cat_name_ar, '$image_file',:cat_parent)
  ");
  $result = $statement->execute(
   array(
    ':cat_name' => $_POST["cat_name"],
    ':cat_name_ar' => $_POST["cat_name_ar"],
    
    ':cat_parent'=>$_POST["cat_parent"]
   ) );
  if(!empty($result))
  {
   echo ' Category Data inserted';
  }else {
    echo 'there are some errors'."<br>";
   
  }