<?php

include '../connect.php';
$response = [];
$response['success'] = false;

$stmt =  $con->prepare(
    "SELECT * FROM  appointments 
    WHERE appointment_date = ? AND is_canceled = 0");

$result= $stmt->execute(array($_POST['date']));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

//24
$times = [
    [ 'from' =>   '00:00' , 'to' =>'01:00' ],
    [ 'from' =>   '01:00' , 'to' =>'02:00' ],
    [ 'from' =>   '02:00' , 'to' =>'03:00' ],
    [ 'from' =>   '03:00' , 'to' =>'04:00' ],
    [ 'from' =>   '04:00' , 'to' =>'05:00' ]
];

$available = [];

foreach ($times as $time){
    foreach ($data as $booked){

        $booked_from = new DateTime($booked['from_time']);
        $booked_to = new DateTime($booked['to_time']);

        $time_from = new DateTime($time['from']);
        $time_to = new DateTime($time['to']);

        if($booked_from >= $time_from && $booked_to <= $time_to){
            break;
        }else{
            $av = ['from' => $time['from'] , 'to'=>$time['to']];
            array_push($available ,$av );
            break;
        }
    }
}


$html = '';
foreach ($available as $time){

    $html .= "<option data-from='".$time['from']."' data-to='".$time['to']."'>
                   ".$time['from']." -  ".$time['to']." 
            </option>";
}

echo $html;
