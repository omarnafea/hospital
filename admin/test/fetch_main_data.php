
<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include ('../include/functions/functions.php');
include('../connect.php');
$output = "";


$params = [];
if(is_admin()){
    $query = "SELECT * FROM tests; ";
}else{

    $params[] = get_current_user_data()['clinic_id'];
    $query = "SELECT * FROM tests where clinic_id = ?  ";

}

$statement = $con->prepare($query);  // prepare query
$statement->execute($params);
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