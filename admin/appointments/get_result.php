<?php

include "../connect.php";

$query = "Select * from appointment_tests  WHERE id = ? ";

$params = [$_POST['id']];
$get_patient = $con->prepare($query);
$result = $get_patient->execute($params);
$data = $get_patient->fetch(PDO::FETCH_ASSOC);
$output = ['success'=> true , 'data'=> $data];
die(json_encode($output));