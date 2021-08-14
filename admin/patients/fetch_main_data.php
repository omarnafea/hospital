
<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
$output = "";
$query = "SELECT * FROM patients; "; // db query
$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();


foreach($result as $row)
{

    $have_insurance = $row['have_insurence'] == 1  ? 'Yes' : 'No';

 $output .= '<tr>
               <td>'.$row['id'].'</td>
               <td>'.$row['name'].'</td>
               <td>'.$row['mobile'].'</td>
               <td>'.$row['place_of_living'].'</td>
               <td>'.$row['birth_date'].'</td>
               <td>'.$row['id_number'].'</td>
               <td>'.$row['gender'].'</td>
               <td>'.$have_insurance.'</td>
               <td><button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary update">Edit</button></td>
               <td>
               <button type="button" name="action" id="'.$row["id"].'" class="btn btn-primary action">Action</button>
               <a href="../appointments/index.php?patient_id='.$row["id"].'"  class="btn btn-info mt-1"><i class="fa fa-info-circle"></i> Details</a>
               
               </td>
               
               ';

               
 $output .= '</tr>';
           }

echo $output;
?>