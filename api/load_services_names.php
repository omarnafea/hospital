<?php
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT service_id,service_name
           FROM services WHERE active='yes';"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();



foreach($result as $row)
 
{
 
  
     $output .= '
                <li class="nav-item">
                    <a class="nav-link" href="#" id="'.$row['service_id'].'">'.$row['service_name'].'</a>
                  </li>';

           
  
  
 }
 

           

echo $output;
?>