
<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
$output = "";
$query = "SELECT * FROM clinics; "; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();


$i = 1;

foreach($result as $row)
{
 $active = $row['is_active'] == 1  ? 'Yes' : 'No';

 if($row['is_active'] == 1){

     $active_btn = '<td><button type="button" data-id="'.$row["id"].'"   class="btn btn-danger deactivate">De Activate</button></td>';

 }else{
     $active_btn = '<td><button type="button" data-id="'.$row["id"].'"   class="btn btn-success activate">Activate</button></td>';

 }

 $output .= '<tr>
               <td>'.$i.'</td>
               <td>'.$row['name'].'</td>
               <td>'.$active.'</td>
               <td><button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary update">Edit</button></td>
               '.$active_btn.'
               ';
 $output .= '</tr>';
 $i++;
           }

echo $output;
?>