<?php
session_start();
if(!isset($_SESSION['user_id'])){
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


 <div class="row">
  <div class="col-md-3">
    
      <?php 
        
       $_SESSION['page']='projects_category';
      include "../include/template/dashboard.php"; 
       

      ?>
    
  </div>
  

    <div class="col-md-9">
      
    <h2 class="text-center">Categories page</h2>
 <button type="button" id="add_button" data-toggle="modal" data-target="#catModal" class="btn btn-info btn-lg">Add</button>
     
     <table id="cat_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th scope="col"> Category Image</th>
       <th scope="col">Category Name(EN) </th>
       <th scope="col">Category Name(AR)</th>
       
       <th scope="col"> Category parent</th>
       <th scope="col">Edit</th>
       <th scope="col">Delete</th>
      </tr>
      </thead>
      <tbody></tbody>
     
    </table>

<div id="catModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="cat_add_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
   
     <h4 class="modal-title">Add Category</h4>
    </div>
    <div class="modal-body">
     <label>Category Name</label>
     <input type="text" name="cat_name" id="cat_name" class="form-control" placeholder="Enter Category name" required />
     <br />
     <label>Category Name (AR)</label>
     <input type="text" name="cat_name_ar" id="cat_name_ar" class="form-control" placeholder="Enter Category Description " required/>
     <br />
    <label>Sub Category OF..</label>
    <select   class="form-control select_bx" name='cat_parent' id='cat_parent' required>
             <option class="stat" value="0" >... </option>
                  <?php 
                
                  include('../connect.php');
                  $query = "SELECT * FROM categories where parent = 0 AND cat_id !=0 ";
                  $statement = $con->prepare($query);
                  $statement->execute();
                  $cats = $statement->fetchAll();
                  
              
                      foreach ($cats as $cat) {
                      echo '<option class="stat" value="'.$cat["cat_id"].'" >'.$cat["cat_name"].'</option>';
                      }
                    ?>
                   
             </select>


     <br/>
     <label>Select cat Image</label>
      <input type="file" class="form-control" name="cat_image[]" id="cat_image"   accept=".jpg, .png, .gif" />
    
    </div>
    <div class="modal-footer">
    
     <input type="submit" name="action"  class="btn btn-success" value="Add" />
     <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>


<div id="catEditModal" class="modal fade">
 <div class="modal-dialog">
  <form method="post" id="cat_edit_form" enctype="multipart/form-data">
   <div class="modal-content">
    <div class="modal-header">
   
     <h4 class="modal-title">Edit Category</h4>
    </div>
    <div class="modal-body">
     <label>Category Name</label>
     <input type="text" name="cat_name" id="cat_edit_name" class="form-control" placeholder="Enter Category name" required />
     <br />
     <label>Category Name (AR)</label>
     <input type="text" name="cat_name_ar" id="cat_edit_name_ar" class="form-control" placeholder="Enter Category Description " required/>
     <br />
    <label>Sub Category OF..</label>
    <select   class="form-control select_bx" name='cat_parent' id='cat_edit_parent' required>
             
    </select>


     <br/>
     <label>Select cat Image</label>
      <input type="file" class="form-control" name="cat_image[]" id="cat_edit_image"   accept=".jpg, .png, .gif" />
     <div id="cat_uploaded_image"></div>
    </div>
    <div class="modal-footer">
     <input type="hidden" name="cat_id" id="cat_id" />
     <input type="hidden" name="operation" id="operation" />
     <input type="submit" name="action" id="action" class="btn btn-success" value="Edit" />
     <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
    </div>
   </div>
  </form>
 </div>
</div>

    </div>
  </div>
	
<script  src="ajax.js">


 
 
</script>

</body>
</html>