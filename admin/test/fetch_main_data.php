
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
    $query = "SELECT tests.*  , clinics.name as clinic FROM tests 
         inner join clinics on clinics.id = tests.clinic_id ";
}else{

    $params[] = get_current_user_data()['clinic_id'];
    $query = "SELECT tests.*  , clinics.name as clinic FROM tests 
         inner join clinics on clinics.id = tests.clinic_id
       where tests.clinic_id = ?  ";

}

$statement = $con->prepare($query);  // prepare query
$statement->execute($params);
$result = $statement->fetchAll();

foreach($result as $row)
{

    $clinic_td = "";

    if(is_admin()){
        $clinic_td = "   <td>{$row['clinic']}</td>";
    }

 $output .= '<tr>
               <td>'.$row['id'].'</td>
               <td>'.$row['name'].'</td>
               <td>'.$row['price'].'</td>
                '.$clinic_td.'
               <td><button type="button" name="update" id="'.$row["id"].'" class="btn btn-primary update">Edit</button></td>
              
               ';
               
 $output .= '</tr>';
           }

echo $output;
?>