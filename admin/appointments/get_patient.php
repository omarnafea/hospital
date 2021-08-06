<?php

include "../connect.php";

$query = "Select * from patients  WHERE id = ? ";

$params = [$_POST['id']];

$get_patient = $con->prepare($query);
$result = $get_patient->execute($params);
$data = $get_patient->fetch(PDO::FETCH_ASSOC);
die(json_encode($data));