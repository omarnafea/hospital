<?php
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT project_id,project_name,project_image FROM projects
           WHERE active='yes'
           ORDER BY project_id DESC LIMIT 3 ;"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();


foreach($result as $row)
{
 
   $output .= '<div class="col-sm-12 col-md-4">
				<div class="work"> 
                    <a href="projects?pro_id='.$row['project_id'].'">
                    <img src="data:image/jpeg;base64,'.base64_encode($row['project_image'] ).'" 
                     class="img-thumbnail"  alt="'.$row['project_name'].'" /></a>
                    <div class="work-name">'.$row['project_name'].'</div>
				</div>
			</div>';
  
     


 }
 

           

echo $output;
?>