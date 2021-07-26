
<?php
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
include('../connect.php');
$query = '';
$output = "";
$query .= "SELECT * FROM categories WHERE cat_id !=0;"; // db query

$statement = $con->prepare($query);  // prepare query
$statement->execute();
$result = $statement->fetchAll();


foreach($result as $row)
{
 
 $output .= '<tr>
               <td><img src="data:image/jpeg;base64,'.base64_encode($row['cat_image'] ).'" height="100px" /></td>
               <td>'.$row['cat_name'].'</td>
               <td>'.$row['cat_name_ar'].'</td>';

               if($row['parent']=='0'){
                $output .= '<td>No Parent</td>';
               }else{
                $statement = $con->prepare(
                  "SELECT cat_name FROM categories
                  WHERE cat_id = '".$row["parent"]."' 
                  LIMIT 1"
                 );
                 $statement->execute();
                 $parent_name = $statement->fetch();
                  $output .= '<td>'.$parent_name['cat_name'].'</td>';
               
               }
               
              $output .= ' <td><button type="button" name="update" id="'.$row["cat_id"].'" class="btn btn-primary update">Edit</button></td>
               ';

             


               if($row['active']=='yes'){
                $output .= ' <td><button type="button" name="deactive" id="'.$row["cat_id"].'" class="btn btn-danger deactive">DeActivate</button></td>';

               }else{

                 $output .= ' <td><button type="button" name="active" id="'.$row["cat_id"].'" class="btn btn-success
                 active">Activate</button></td>';

               }


          

               
 $output .= '</tr>';
           }

echo $output;
?>