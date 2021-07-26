<?php
include('../connect.php');
 $service_id =$_POST['service_id'];

 $output = array();
 $get_maininfo_data = $con->prepare(
  "SELECT * FROM  services
    WHERE service_id = ?
     LIMIT 1");
 $get_maininfo_data->execute(array($service_id));
 $services = $get_maininfo_data->fetch();

  $output["service_name"]        =   $services["service_name"];
  $output["service_name_ar"]     =   $services["service_name_ar"];
  $output["desc_en"]             =   $services["service_desc"];
  $output["desc_ar"]             =   $services["service_desc_ar"];
  $output["info_en"]             =   $services["service_info"];
  $output["info_ar"]             =   $services["service_info_ar"];
  $output["service_image"]       =   '<img src="data:image/jpeg;base64,'.base64_encode($services["service_image"]).'" 
                                         class="img-fluid"  alt="service_image" />';
  
  

 
  echo json_encode($output);

?>