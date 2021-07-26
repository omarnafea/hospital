<?php
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT * FROM projects WHERE active='yes';"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();



foreach($result as $row)
{
              /* $output.='
               <div class="col-sm-4 col-md-2 client">
                      <img src="data:image/jpeg;base64,'.base64_encode($row['client_image'] ).'" 
                     class="img-fluid"  alt="'.$row['client_name'].'" />
                      <div class="overlay"></div>
               </div>';     */

               $output.='<div class="col-sm-12 col-md-4">
					        <div class="card" >
					         <img src="data:image/jpeg;base64,'.base64_encode($row['project_image'] ).'" class="card-img-top" alt="'.$row['project_name'].'">
					          <div class="card-body">
					            <h5 class="card-title">'.$row['project_name'].'</h5>
					            <p class="card-text">'.$row['project_desc'].'</p>
					            <a href="project_details.php?project_id='.$row['project_id'].'" class="btn btn-primary">Read more</a>
					          </div>
					        </div>
					      </div>';  
 }
 

           

echo $output;
?>

