<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}

include('../connect.php');



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
       $_SESSION['page']='patients';
      include "../include/template/dashboard.php"; 
      ?>
    
  </div>
  <div class="col-md-9">
    <h2 class="text-center">Manage Patients</h2>
    <button type="button" id="add_button" data-toggle="modal" data-target="#patient_add_modal" class="btn btn-info btn-lg d-none">
      Add Patient</button>

    <table id="patient_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th scope="col">#</th>
       <th scope="col">Name</th>
       <th scope="col">Mobile</th>
       <th scope="col">Place of Living</th>
       <th scope="col">Birth Date</th>
       <th scope="col">ID Number</th>
       <th scope="col">Gender</th>
       <th scope="col">Have Insurance</th>

        <?php
        if(is_doctor()){?>
            <th scope="col">Details</th>

        <?php } ?>
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
     
     <h4 class="modal-title">Add Patient</h4>
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
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter user password" required>
      </div>



     
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



  
<div id="user_edit_modal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="user_edit_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <h4 class="modal-title">Edit User</h4>
    </div>
    <div class="modal-body">
     <div class="form-group">
        <label> First Name</label>
        <input type="Text" class="form-control" id="edit_first_name" name="first_name" placeholder="Enter user first name" required>
      </div>
      <div class="form-group">
        <label> Last Name</label>
        <input type="Text" class="form-control" id="edit_last_name" name="last_name" placeholder="Enter user last name" required>
      </div>
      <div class="form-group">
        <label> User Name</label>
        <input type="Text" class="form-control" id="edit_user_name" name="user_name" placeholder="Enter user username" required>
      </div>
      <div class="form-group">
        <label> Password</label>
        <input type="password" class="form-control" id="edit_password" name="password" placeholder="Leave Blank in you don't wont to change" required>
      </div>

      <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="user_type" id="edit_normal_user" value="normal">
      <label class="form-check-label" >normal user</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="user_type" id="edit_admin_user" value="admin" >
      <label class="form-check-label" >Adminstrator</label>
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