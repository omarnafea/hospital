<?php
include '../connect.php';


$response = [];



$params = [$_POST['result_text']];
$attachment_query = " ";


if(isset($_FILES['attachment'])){

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




    $params[] = $Image;
    $attachment_query = ",  attachment = ?";


}

$params[] = $_POST['result_id'];


$statement = $con->prepare("
   UPDATE  appointment_tests
    SET   result = ? $attachment_query
    where id = ?");
$result = $statement->execute(
    $params
);
$response['success'] = true;

die(json_encode($response));