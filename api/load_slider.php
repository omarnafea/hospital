<?php
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT * FROM home_slider;"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();



$output .='
             <h6>ELEVEN ONE WEB SOLUTIONS</h6>
             <h3>Your Partner in Growth</h3>
             <p>You have goals, you need results, we have the way to get you there. We create digital solutions that will convert your visitors into real clients.</p>
             <a href="#what_we_do" class="btn btn-light">Learn More</a>
            <div class="overlay"></div>';
$num = 1;

foreach($result as $row)
 
{
  if ($num==1) {
    $output .= '<div class="carousel-item active">
                  <img src="admin/home_slider/images/'.$row['image_name'] .'" class="d-block w-100" 
                   alt="'.$row['image_name'].'" >
                </div>';
           }
  else{
     $output .= '<div class="carousel-item">
                    <img src="admin/home_slider/images/'.$row['image_name'] .'" class="d-block w-100" 
                   alt="'.$row['image_name'].'" >
           
             </div>';
  }
  $num++;
 }
 

           

echo $output;
?>