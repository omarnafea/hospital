<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location:../index.php");
    exit();
}

$_SESSION['page']='tests';

include('../connect.php');

$query = "SELECT * FROM clinics where is_active = 1; "; // db query
$statement = $con->prepare($query);  // prepare query
$statement->execute();
$clinics = $statement->fetchAll();

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
            <h2 class="text-center">Manage Tests</h2>
            <button type="button" id="add_button" data-toggle="modal" data-target="#test_add_modal" class="btn btn-info btn-lg">
                Add Test</button>

            <table id="test_data" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Test Name</th>
                    <th scope="col">Price</th>
                    <?php if(is_admin()){ ?>
                        <th scope="col">Clinic</th>
                    <?php }?>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>



            <div id="test_add_modal" class="modal fade">
                <div class="modal-dialog">
                    <form method="post" id="test_add_form" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h4 class="modal-title">Add Test</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label> Name</label>
                                    <input type="Text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                                </div>
                                <div class="form-group">
                                    <label> Price</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
                                </div>

                                <?php if(is_admin()){ ?>
                                    <div class="form-group">
                                        <label> Clinic</label>
                                        <select id="clinic_id" class="form-control" name="clinic_id" title="clinic">
                                            <option value="-1">Select clinic</option>
                                            <?php
                                            foreach ($clinics as $clinic){?>
                                                <option value='<?=$clinic['id']?>'><?=$clinic['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php }else{?>
                                    <input type="hidden" name="clinic_id" value="<?=get_current_user_data()['clinic_id']?>"/>
                                <?php }?>


                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="m_id" id="m_id" />
                                <input type="submit" name="action"  class="btn btn-success" value="Add" />
                                <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>




            <div id="test_edit_modal" class="modal fade">
                <div class="modal-dialog">
                    <form method="post" id="test_edit_form" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Test</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label> Name</label>
                                    <input type="Text" class="form-control" id="edit_test_name" name="name" placeholder="Enter  name" required>
                                </div>

                                <div class="form-group">
                                    <label> Price</label>
                                    <input type="number" class="form-control" id="edit_test_price" name="price" placeholder="Enter  price" required>
                                </div>

                                <?php if(is_admin()){ ?>
                                    <div class="form-group">
                                        <label> Clinic</label>
                                        <select id="edit_clinic_id" class="form-control" name="clinic_id" title="clinic">
                                            <option value="-1">Select clinic</option>
                                            <?php
                                            foreach ($clinics as $clinic){?>
                                                <option value='<?=$clinic['id']?>'><?=$clinic['name']?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php }else{?>
                                    <input type="hidden" id="edit_clinic_id" name="clinic_id" value="<?=get_current_user_data()['clinic_id']?>"/>
                                <?php }?>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="test_id" id="edit_test_id" />
                                <input type="submit" name="action"  class="btn btn-success" value="Edit" />
                                <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>


    </div>

</div>

<script  src="ajax.js">



</script>

</body>
</html>