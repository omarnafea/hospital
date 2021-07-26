<?php
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT * FROM clients WHERE active='yes';"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();



foreach($result as $row)
{
               $output.='
               <div class="col-sm-4 col-md-2 client">
                      <img src="data:image/jpeg;base64,'.base64_encode($row['client_image'] ).'" 
                     class="img-fluid"  alt="'.$row['client_name'].'" />
                      <div class="overlay"></div>
               </div>';     
 }
 

           

echo $output;
?>