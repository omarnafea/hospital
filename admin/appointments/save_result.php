<?php
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../index.php");
    exit();
}
include('../connect.php');



     $file = $_FILES['attachment'];

    $output=array();
    $allowed_extension=array('jpeg','jpg','png', 'pdf');

    $imageName=$file['name'];
    $imageSize=$file['size'];
    $imageTempName=$file['tmp_name'];
    $imageType=$file['type'];

    $image_extension=explode('.',$imageName );
    $image_extension=strtolower(end($image_extension));  // the capital extension may be make an error


    if(!empty($imageName)&&!in_array($image_extension, $allowed_extension)){
        $output[]='This Extension Is Not <strong>Allowed</strong>';
        $output['success']=false;
        $output['error']='This extension Is Not Allowed';
        return  $output;

    }

    if(!empty($imageName)&&$imageSize>4194304){
        $output['success']=false;
        $output['error']='Image Size Must Be Less Than 4MB';
        return  $output;
    }



    $upload_root= "../../uploads/";

    $Image=rand(0,1000000).'_'.strtolower($imageName);
    $Image=str_replace(' ','',$Image);
    move_uploaded_file($imageTempName,  $upload_root.$Image);
    $output['success']=true;
    $output['image']=$Image;




$statement = $con->prepare("
   INSERT INTO test_result (appointment_id , result , attatchment) 
   VALUES (:appointment_id , :result , :attatchment)");
$result = $statement->execute(
    array(
        ':appointment_id'            => $_POST["appointment_id"] ,
        ':result'            => $_POST["result_text"] ,
        ':attatchment' => $Image

    )
);

die(json_encode($output));


