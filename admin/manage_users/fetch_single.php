<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
  
 
 $output = array();
 $get_maininfo_data = $con->prepare(
  "SELECT users.* , clinics.id as clinic_id , clinics.name as clinic_name FROM  users 
            LEFT JOIN  clinics on clinics.id = users.clinic_id           
    WHERE users.id = ? LIMIT 1");
 $get_maininfo_data->execute(array($_POST['user_id']));
 $result = $get_maininfo_data->fetch(PDO::FETCH_ASSOC);


$statement = $con->prepare("select clinics.* from clinics
where clinics.id NOT IN (SELECT users.clinic_id from users where users.clinic_id = clinics.id )");  // prepare query
$statement->execute();
$clinics = $statement->fetchAll();

$response  = [
    'user'=>$result,
    'clinics'=>$clinics
];

  echo json_encode($response);

?>