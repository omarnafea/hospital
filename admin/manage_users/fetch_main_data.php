
<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
$output = "";
$query = "SELECT users.* , privileges.privilege as privilege , clinics.name as clinic 
FROM users 
INNER JOIN clinics on clinics.id = users.clinic_id
INNER JOIN privileges on privileges.id = users.privilege_id

; "; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();


foreach($result as $row)
{
 
 $output .= '<tr>
               <td>'.$row['name'].'</td>
               <td>'.$row['user_name'].'</td>
               <td>'.$row['email'].'</td>
               <td>'.$row['clinic'].'</td>
               <td>'.$row['privilege'].'</td>
               <td><button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary update">Edit</button></td>
               ';


               if($row['is_active']== 1){
                $output .= ' <td><button type="button" name="deactive" id="'.$row["id"].'" class="btn btn-danger deactive">DeActivate</button></td>';

               }else{

                 $output .= ' <td><button type="button" name="active" id="'.$row["id"].'" class="btn btn-success
                 active">Activate</button></td>';

               }


          

               
 $output .= '</tr>';
           }

echo $output;
?>