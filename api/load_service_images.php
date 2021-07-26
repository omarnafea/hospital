<?php
include('../connect.php');

$service_id=$_POST['service_id'];
$query = '';
$output = "";
$query .= "SELECT * FROM service_images 
            WHERE service_id = ?;"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute(array($service_id));
$result = $statement->fetchAll();



$num = 1;

foreach($result as $row)
 
{
  if ($num==1) {
    $output .= '<div class="carousel-item active">
                  <img src="../admin/manage_services/images/'.$row['image_name'] .'" class="d-block w-100" 
                   alt="'.$row['image_name'].'" >
                </div>';
           }
  else{
     $output .= '<div class="carousel-item">
                    <img src="../admin/manage_services/images/'.$row['image_name'] .'" class="d-block w-100" 
                   alt="'.$row['image_name'].'" >
           
             </div>';
  }
  $num++;
 }
 

           

echo $output;
?>