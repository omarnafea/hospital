<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../index.php");
    exit();
}

include('../connect.php');

$statement = $con->prepare("select * from contact");  // prepare query
$statement->execute();
$contacts = $statement->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>main aside</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../layout/js/jquery-3.4.1.min.js" ></script>
    <script src="../layout/js/bootstrap.min.js" ></script>
    <script src="https://kit.fontawesome.com/9bb4e0493f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../layout/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../layout/css/main.css">
</head>
<body>


<div class="manage_users">
    <div class="row">
        <div class="col-md-3">

            <?php
            $_SESSION['page']='dashboard';
            include "../include/template/dashboard.php";
            ?>

        </div>
        <div class="col-md-9">
            <h2 class="text-center">Contacts</h2>


            <table id="patient_data" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Message</th>
                </tr>
                </thead>
                <tbody>

                <?php

                foreach ($contacts as $contact){
                    $i = 1;
                    ?>
                    <tr>
                        <td><?=$i?></td>
                        <td><?=$contact['first_name']?></td>
                        <td><?=$contact['last_name']?></td>
                        <td><?=$contact['mobile']?></td>
                        <td><?=$contact['message']?></td>
                    </tr>

                <?php }?>


                </tbody>
            </table>



        </div>


    </div>

</div>

<script  src="ajax.js">



</script>

</body>
</html>