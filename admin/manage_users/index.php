<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}

include('../connect.php');

$statement = $con->prepare("select clinics.* from clinics
where clinics.id NOT IN (SELECT users.clinic_id from users where users.clinic_id = clinics.id)");  // prepare query
$statement->execute();
$clinics = $statement->fetchAll();



$statement = $con->prepare("select * from privileges");  // prepare query
$statement->execute();
$privileges = $statement->fetchAll();


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
    <h2 class="text-center">Manage Users</h2>
    <button type="button" id="add_button" data-toggle="modal" data-target="#user_add_modal" class="btn btn-info btn-lg">
      Add User</button>

    <table id="patient_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th scope="col">Name</th>
       <th scope="col">User Name</th>
       <th scope="col">Email</th>
       <th scope="col">Clinic</th>
       <th scope="col">Privilege</th>
       <th scope="col">Edit</th>
      </tr>
     </thead>
     <tbody>
     </tbody>
    </table>

   
  
<div id="user_add_modal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_add_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     
     <h4 class="modal-title">Add User</h4>
    </div>
    <div class="modal-body">
     <div class="form-group">
        <label> Name</label>
        <input type="Text" class="form-control" id="name" name="name" placeholder="Enter name" required>
      </div>

      <div class="form-group">
        <label> User Name</label>
        <input type="Text" class="form-control" id="user_name" name="user_name" placeholder="Enter user username" required>
      </div>

        <div class="form-group">
            <label> Email</label>
            <input type="Text" class="form-control" id="email" name="email" placeholder="Enter user email" required>
        </div>

      <div class="form-group">
        <label> Password</label>
        <input type="password" class="form-control" id="password"  autocomplete="new-password" name="password" placeholder="Enter user password" required>
      </div>


        <div class="form-group">
            <label> Privilege</label>

            <select class="form-control" id="privilege_id" name="privilege_id" title="clinic" onchange="onPrevChanged()">
                <option value="-1">Select Privilege</option>
                <?php
                foreach ($privileges as $privilege){?>
                    <option value="<?=$privilege['id']?>"><?=$privilege['privilege']?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group clinic-id-form d-none">
            <label> Clinic</label>

            <select class="form-control" id="clinic_id" name="clinic_id" title="clinic">
                <option value="-1">Select Clinic</option>
                <?php
                foreach ($clinics as $clinic){?>
                    <option value="<?=$clinic['id']?>"><?=$clinic['name']?></option>
                <?php } ?>
            </select>
        </div>



    </div>
    <div class="modal-footer">
     <input type="hidden" name="user_id" id="edit_user_id" />
     <input type="submit" name="action"  class="btn btn-success" value="Add" />
     <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>

<div id="user_edit_modal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_edit_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">

     <h4 class="modal-title">Edit User</h4>
    </div>
    <div class="modal-body">
     <div class="form-group">
        <label> Name</label>
        <input type="Text" class="form-control" id="edit_name" name="name" placeholder="Enter name" required>
      </div>

      <div class="form-group">
        <label> User Name</label>
        <input type="Text" class="form-control" id="edit_user_name" name="user_name" placeholder="Enter user username" required>
      </div>

        <div class="form-group">
            <label> Email</label>
            <input type="Text" class="form-control" id="edit_email" name="email" autocomplete="new-password" placeholder="Enter user email" required>
        </div>

      <div class="form-group">
        <label> Password</label>
          <input type="text" style="display:none;">

          <input type="password" class="form-control" id="edit_password" name="password" autocomplete="new-password" placeholder="Leave empty if you don't need to change it " >
    </div>


        <div class="form-group">
            <label> Privilege</label>

            <select class="form-control" id="edit_privilege_id" name="privilege_id" title="clinic" onchange="onEditPrevChanged()">
                <option value="-1">Select Privilege</option>
                <?php
                foreach ($privileges as $privilege){?>
                    <option value="<?=$privilege['id']?>"><?=$privilege['privilege']?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group edit-clinic-id-form d-none">
            <label> Clinic</label>

            <select class="form-control" id="edit_clinic_id" name="clinic_id" title="clinic">

            </select>
        </div>



    </div>
    <div class="modal-footer">
     <input type="hidden" name="user_id" id="edit_user_id" />
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