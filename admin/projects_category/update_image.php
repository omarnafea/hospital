<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300); 
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');

$img_file = addslashes(file_get_contents($_FILES["cat_edit_image"]["tmp_name"]));
 $statement = $con->prepare(
   "UPDATE categories 
    SET cat_image ='$img_file'
    WHERE cat_id = ?");
  $result = $statement->execute(array($_POST['cat_id']));
  if(!empty($result))
  {
   echo 'cat file Updated';
  }
  