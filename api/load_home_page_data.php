<?php
include('../connect.php');
 
 $output = array();
 $get_maininfo_data = $con->prepare(
  "SELECT * FROM  home_page
    WHERE id = 1
     LIMIT 1");
 $get_maininfo_data->execute();
 $home_page = $get_maininfo_data->fetch();




 $get_maininfo_data = $con->prepare(
  "SELECT * FROM  website_info
    WHERE website_id = 1
     LIMIT 1");
 $get_maininfo_data->execute();
 $main_info = $get_maininfo_data->fetch();

 $clients_count = $con->prepare(
  "SELECT COUNT(client_id) as clients_count FROM  clients ");
 $clients_count->execute();
 $clients = $clients_count->fetch();

 $clients_count = $con->prepare(
  "SELECT COUNT(project_id) as projects_count FROM  projects");
 $clients_count->execute();
 $projects = $clients_count->fetch();

 
  




 
  $output["home_text_en"]     =   $home_page["home_text_en"];
  $output["home_text_ar"]     =   $home_page["home_text_ar"];
  $output["about_text_en"]    =   $home_page["about_en"];
  $output["about_text_ar"]    =   $home_page["about_ar"];
  $output["logo"]             =   '<img src="data:image/jpeg;base64,'.base64_encode($home_page["logo"]).'" 
                                         class="img-thumbnail"  alt="company logo" />';



  $output["company_ar_name"]     =   $main_info["company_ar_name"];
  $output["company_en_name"]     =   $main_info["company_en_name"];
  $output["catalog_status"]      =   $main_info["catalog_status"];
  $output["tel_number"]          =   $main_info["tel_number"];
  $output["mobile_number"]       =   $main_info["mobile_number"];
  $output["address_en"]          =   'Address 1 : '.$main_info["address_en"];
  $output["address_ar"]          =   'Address 2 : '. $main_info["address_ar"];
  $output["fax_number"]          =   $main_info["fax_number"];
  $output["email_address"]       =   $main_info["email_address"];
  $output["keep_en"]             =   $main_info["about_en"];
  $output["keep_ar"]             =   $main_info["about_ar"];

  $output["footer_email"]        = $main_info["email_address"];
  $output["full_company_name"]   = $main_info["company_en_name"] . ' ' .  $main_info["company_ar_name"];

  $output["clients_count"]       = $clients["clients_count"];
  $output["projects_count"]      = $projects["projects_count"];
  
  

 
  echo json_encode($output);

?>