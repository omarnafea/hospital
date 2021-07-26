<?php
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT * FROM social_media where active = 'enabled';"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();



foreach($result as $row)
 
{
     $output .= '<li><a href="'.$row['socialmedia_link'].'"><i class="'.$row['icon'].'"></i></a></li>';
           

 }
 

           

echo $output;
?>