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

$times  = [];
for ( $i = 8 ;   $i <= 18 ;   $i++){
    $from = strlen(strval($i))< 2 ? "0".strval($i) : $i;
    $to =  strlen(strval($i+1))< 2 ? "0".($i+1) : $i+1 ;
    array_push( $times  , ['from'=>  "{$from}" .  ":00" , 'to'=>  "{$to}" .  ":00"]);
}

$available = [];

foreach ($times as $time){


    $is_bocked = false;
    $av = ['from' => $time['from'] , 'to'=>$time['to']];

    foreach ($data as $booked){

            $booked_from = new DateTime($booked['from_time']);
            $booked_to = new DateTime($booked['to_time']);
            $time_from = new DateTime($time['from']);
            $time_to = new DateTime($time['to']);

            if($booked_from >= $time_from && $booked_to <= $time_to){
                $is_bocked = true;
                 break;
            }
    }

    if(!$is_bocked)
        array_push($available ,$av );
}


$html = '';

foreach ($available as $time){

    $html .= "<option data-from='".$time['from']."' data-to='".$time['to']."'>
                   ".$time['from']." -  ".$time['to']." 
            </option>";
}

echo $html;
