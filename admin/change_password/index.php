<?php
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>main aside</title>
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../layout/js/jquery-3.4.1.min.js" type="text/javascript"></script>	
	<script src="../layout/js/bootstrap.min.js" type="text/javascript"></script>
	 <script src="https://kit.fontawesome.com/9bb4e0493f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../layout/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../layout/css/main.css">
</head>
<body>


<div class="change_password">
  
 <div class="row">
  <div class="col-md-3">
    
      <?php 
       $_SESSION['page']='change_password';
      include "../include/template/dashboard.php"; 
       

      ?>
    
  </div>
  <div class="col-md-4">
    <h2>Change Password Page</h2>

    <form id="change_password_form">
        <div class="form-group">
          <label> Current password</label>
          <input type="password" class="form-control" id="current_password" name="current_password"
            placeholder="Enter new Current password">
        </div>
        <div class="form-group">
          <label >New password</label>
          <input type="password" class="form-control"  id="new_password" name="new_password" placeholder="Enter new password">
        </div>
         <div class="form-group">
          <label >Reenter new password</label>
          <input type="password" class="form-control"  id="re_new_password" name="re_new_password" placeholder=" RE Enter new password">
        </div>
        <input type="submit"  class="btn btn-primary" value="Change" />
        <input type="hidden"   name="operation" value="main_info" id="operation" />
  
</form>
     
    </div>

    <div class="col-md-4">
    
     
    </div>
  </div>
  </div>

	
<script type="text/javascript" src="ajax.js">
 
</script>

</body>
</html>