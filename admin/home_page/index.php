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
	<script src="../layout/js/jquery-3.4.1.min.js"></script>	
	<script src="../layout/js/bootstrap.min.js"></script>
	 <script src="https://kit.fontawesome.com/9bb4e0493f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../layout/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../layout/css/main.css">
</head>
<body>


<div class="home-page">
 <div class="row">
  <div class="col-md-3">
    
      <?php 
       
       $_SESSION['page']='home_page';
      include "../include/template/dashboard.php"; 
       

      ?>
    
  </div>
  <div class="col-md-4">
    <h2>Home Page info</h2>

    <form id="home_page_form" enctype="multipart/form-data">
      <div class="form-group">
        <label>select company logo</label>
        <div id="logo"></div>
        <input type="file" class="form-control" name="company_logo[]" id="company_logo"   accept=".jpg, .png, .gif" />
      </div>
      <div class="form-group">
        <label > Company Home Text(EN)</label>
        <textarea class="form-control" id="home_text_en" name="home_text_en" cols="50" rows="7" 
                        placeholder="Enter home text in engish" ></textarea>  
        
      </div>
      <div class="form-group">
        <label > Company Home Text(AR)</label>
        <textarea class="form-control" id="home_text_ar" name="home_text_ar" cols="50" rows="7" 
                        placeholder="Enter home text in arabic" ></textarea>  
      </div>
      <input type="submit"  class="btn btn-primary" value="Update" />
      <input type="hidden"   name="operation" value="home_page"  />
  
</form>
     
    </div>

    <div class="col-md-4">
    <h2>About Page info</h2>

    <form id="about_page_form" enctype="multipart/form-data">
     
      <div class="form-group">
        <label >About Text(EN)</label>
        <textarea class="form-control" id="about_text_en" name="about_text_en" cols="50" rows="11" 
                        placeholder="Enter about text in engish" ></textarea>  
        
      </div>
      <div class="form-group">
        <label > About Text(AR)</label>
        <textarea class="form-control" id="about_text_ar" name="about_text_ar" cols="50" rows="7" 
                        placeholder="Enter home text in arabic" ></textarea>  
      </div>
      <input type="submit"  class="btn btn-primary" value="Update" />
      <input type="hidden"   name="operation" value="about_page" />
  
</form>
     
    </div>
  </div>

  </div>
	
<script  src="ajax.js">

 
 
</script>

</body>
</html>