
<?php

include('../connect.php');
 
 session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
} 
 
 $output = array();
 $get_maininfo_data = $con->prepare(
  "SELECT * FROM  home_page
    WHERE id = 1
     LIMIT 1");
 $get_maininfo_data->execute();
 $result = $get_maininfo_data->fetch();

 
  $output["home_text_en"]     =   $result["home_text_en"];
  $output["home_text_ar"]     =   $result["home_text_ar"];
  $output["about_text_en"]      =   $result["about_en"];
  $output["about_text_ar"]          =   $result["about_ar"];
  
  

 
if($result["logo"] != '')
  {
   $output['logo'] = '<img src="data:image/jpeg;base64,'.base64_encode($result['logo'] ).'" class="img-thumbnail"/>';
  }
  else
  {
   $output['logo'] = '<input type="hidden" name="hidden_user_image" value="" />';
  }
 
  echo json_encode($output);

?>