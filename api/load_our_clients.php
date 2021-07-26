<?php
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT * FROM clients WHERE active='yes';"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();


$num = 1;
foreach($result as $row)
{
  if ($num==1) {
         $output.=' <div class="carousel-item active">';
         $output .= '<div class="row">';
           }
    elseif($num==4||$num==7||$num==10||$num==13||$num==16||$num==19||$num==22){
    $output.=' <div class="carousel-item">';
    $output .= '<div class="row">';
    }


             $output.='
               <div class="col-4">
                      <img src="data:image/jpeg;base64,'.base64_encode($row['client_image'] ).'" 
                     class="img-thumbnail"  alt="'.$row['client_name'].'" />
               </div>';     



        
    if($num==3||$num==6||$num==9||$num==12||$num==15||$num==18||$num==21){
         $output.='</div>';
         $output .= '</div>';
    }      
 
  $num++;

  
 }
 

           

echo $output;
?>