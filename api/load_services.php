<?php
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT service_id,service_name,service_image
           FROM services
           WHERE active='yes';"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();

$num = 1;

foreach($result as $row)
 
{
 
 if($num % 3 == 1 ){
 $output .= '<div class="row">';

 }
  
     $output .= '<div class="col-md-4">
                  <div class="service">
                  <span><img src="data:image/jpeg;base64,'.base64_encode($row['service_image'] ).'"
                             class="rounded-circle" /></span>
                   <span class="service-name"><a href="services?service_id='.$row['service_id'].'">'.$row['service_name'].'</a></span>
                   </div>
                  </div>';

 if($num % 3 == 0 ){
 $output .= '</div>';

 }
           
  
  $num ++;
 }
 

           

echo $output;
?>