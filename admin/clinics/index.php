<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}

$_SESSION['page']='clinics';

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
       $_SESSION['page']='dashboard';
      include "../include/template/dashboard.php"; 
      ?>
    
  </div>
  <div class="col-md-9">
    <h2 class="text-center">Manage Clinics</h2>
    <button type="button" id="add_button" data-toggle="modal" data-target="#user_add_modal" class="btn btn-info btn-lg">
      Add Clinic</button>

    <table id="patient_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th scope="col">#</th>
       <th scope="col">Clinic Name</th>
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

                          <h4 class="modal-title">Add Clinic</h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <label> Name</label>
                              <input type="Text" class="form-control" id="name" name="name" placeholder="Enter name" required>
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



  
<div id="clinic_edit_modal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="clinic_edit_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
     <h4 class="modal-title">Edit Clinic</h4>
    </div>
    <div class="modal-body">
     <div class="form-group">
        <label> Name</label>
        <input type="Text" class="form-control" id="edit_clinic_name" name="name" placeholder="Enter clinic name" required>
      </div>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="clinic_id" id="edit_clinic_id" />
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