<?php
include('../connect.php');
 $project_id =$_POST['project_id'];

 $output = array();
 $get_maininfo_data = $con->prepare(
  "SELECT * FROM  projects
    WHERE project_id = ?
     LIMIT 1");
 $get_maininfo_data->execute(array($project_id));
 $projects = $get_maininfo_data->fetch();

  $output["peoject_name"]        =   $projects["project_name"];
  $output["project_name_ar"]     =   $projects["project_name_ar"];
  $output["desc_en"]             =   $projects["project_desc"];
  $output["desc_ar"]             =   $projects["project_desc_ar"];
  $output["project_image"]       =   '<img src="data:image/jpeg;base64,'.base64_encode($projects["project_image"]).'" 
                                         class="img-fluid"  alt="project_image" />';
  
  

 
  echo json_encode($output);

?>