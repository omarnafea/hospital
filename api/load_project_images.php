<?php
include('../connect.php');

$project_id=$_POST['project_id'];
$query = '';
$output = "";
$query .= "SELECT * FROM project_images 
            WHERE project_id = ?;"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute(array($project_id));
$result = $statement->fetchAll();



$num = 1;

foreach($result as $row)
 
{
  if ($num==1) {
    $output .= '<div class="carousel-item active">
                  <img src="../admin/manage_projects/images/'.$row['image_name'] .'" class="d-block w-100" 
                   alt="'.$row['image_name'].'" >
                </div>';
           }
  else{
     $output .= '<div class="carousel-item">
                    <img src="../admin/manage_projects/images/'.$row['image_name'] .'" class="d-block w-100" 
                   alt="'.$row['image_name'].'" >
           
             </div>';
  }
  $num++;
 }
 

           

echo $output;
?>