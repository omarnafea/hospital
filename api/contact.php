<?php
include '../connect.php';


$statement = $con->prepare("
   INSERT INTO contact (first_name, last_name ,  mobile , message)
                 VALUES (:first_name, :last_name,:mobile,:message)");
$result = $statement->execute(
    array(
        ':first_name'             => $_POST["first_name"],
        ':last_name'           => $_POST["last_name"],
        ':mobile'  => $_POST["mobile"],
        ':message'       => $_POST["message"]

    )
);