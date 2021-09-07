
<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
include ('../include/functions/functions.php');
$output = "";
$query = "SELECT * FROM patients; "; // db query
$params = [];
if(is_doctor()){
    $clinic_id = get_current_user_data()['clinic_id'];
    $params = [$clinic_id];
    $query = "SELECT patients.* FROM  patients
              INNER  JOIN appointments ON appointments.clinic_id = ? group by patients.id; "; // db query

}

$statement = $con->prepare($query);  // prepare query
$statement->execute($params);
$result = $statement->fetchAll();


$i = 0;
foreach($result as $row)
{

    $i++;
    $have_insurance = $row['have_insurence'] == 1  ? 'Yes' : 'No';

    $details = "";
    if(!is_admin()){
        $details = '<a href="../appointments/index.php?patient_id='.$row["id"].'"  class="btn btn-info mt-1"><i class="fa fa-info-circle"></i> Details</a>';
    }

 $output .= '<tr>
               <td>'.$i.'</td>
               <td>'.$row['name'].'</td>
               <td>'.$row['mobile'].'</td>
               <td>'.$row['place_of_living'].'</td>
               <td>'.$row['birth_date'].'</td>
               <td>'.$row['id_number'].'</td>
               <td>'.$row['gender'].'</td>
               <td>'.$have_insurance.'</td>
               <td>
              '.$details.'
               
               </td>
               
               ';

               
 $output .= '</tr>';
           }

echo $output;
?>