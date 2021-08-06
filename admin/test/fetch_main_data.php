
<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
$output = "";
$query = "SELECT * FROM tests; "; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();


foreach($result as $row)
{
 
 $output .= '<tr>
               <td>'.$row['id'].'</td>
               <td>'.$row['name'].'</td>
               <td>'.$row['price'].'</td>
               <td><button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary update">Edit</button></td>
               ';
               
 $output .= '</tr>';
           }

echo $output;
?>