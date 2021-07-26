
<?php
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT * FROM users;"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();


foreach($result as $row)
{
 
 $output .= '<tr>
               <td>'.$row['first_name'].'</td>
               <td>'.$row['last_name'].'</td>
               <td>'.$row['user_name'].'</td>
               <td>'.$row['type'].'</td>
               <td><button type="button" name="update" id="'.$row["user_id"].'" class="btn btn-primary update">Edit</button></td>
               ';


               if($row['active']=='yes'){
                $output .= ' <td><button type="button" name="deactive" id="'.$row["user_id"].'" class="btn btn-danger deactive">DeActivate</button></td>';

               }else{

                 $output .= ' <td><button type="button" name="active" id="'.$row["user_id"].'" class="btn btn-success
                 active">Activate</button></td>';

               }


          

               
 $output .= '</tr>';
           }

echo $output;
?>