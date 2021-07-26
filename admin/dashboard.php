<?php
session_start();
if(!isset($_SESSION['migna_user_id'])){
  header("location:index.php");
  exit();
}
include "include/functions/functions.php";
?>
<!DOCTYPE html>
<html>
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<script src="layout/js/jquery-3.4.1.min"></script>
  <link rel="stylesheet" href="layout/css/bootstrap.min.css"/>
  <script src="https://kit.fontawesome.com/9bb4e0493f.js" crossorigin="anonymous"></script>
  <script src="layout/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="layout/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="layout/css/main.css">


	<title>Dashboard</title>
</head>
<body lang="en">
  <!-- start Nav-bar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container text-right">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php
        
         echo $_SESSION['username'];?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="manage_users">Manage users</a>
          <a class="dropdown-item" href="change_password">change password</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">LogOut</a>
        </div>
      </li>
     
    </ul>
    
  </div>
  </div>
</nav>



<!-- end Nav-bar-->

  
    <div class="row">
  <div class="col-md-3">
    
      <h3></h3>
      <ul class="list-group list-group-flush"> 
        <li class="list-group-item list-group-item-success"><a href="#"><i class="fas fa-list"></i></a> </li>
        <li class="list-group-item pagelink active"><a href="dashboard.php"><i class="fas fa-list"></i> DASHBOARD</a></li>
        <li class="list-group-item pagelink"> <a href="projects_category"><i class="fas fa-sitemap"></i> Projects Category</a></li>
        <li class="list-group-item pagelink"> <a href="change_password"><i class="fas fa-lock"></i> Change Password</a></li>
        <li class="list-group-item pagelink"><a href="logout.php"> <i class="fas fa-power-off"></i> LOGOUT</a></li>
      </ul>
    
    
  </div>
  <div class="col-md-9">
    
    <div class="row">
                        

                    <div class="col-md-3 col-sm-6 ">
                        <div class="stat st-items">
                               <a href="#"> <i class="fa fa-group"></i></a>            
                             <div class="info">
                             <span class="total"> Total visitors</span>
                              <span class="count">
                                   
                                <a href="supliers/index.php">
                                 <?php echo count_visitors();  ?>
                                 </a>        
                                   
                              </span>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3 col-sm-6 ">
                        <div class="stat st-items">
                               <a href="supliers/index.php"> <i class="fa fa-group"></i></a>            
                             <div class="info">
                             <span class="total"> Today Visitors</span>
                              <span class="count">
                                   
                                <a href="supliers/index.php">   10</a>        
                                   
                              </span>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-3 col-sm-6 ">
                        <div class="stat st-items">
                               <a href="supliers/index.php"> <i class="fa fa-group"></i></a>            
                             <div class="info">
                             <span class="total">  Last mounth visitors</span>
                              <span class="count">
                                   
                                <a href="supliers/index.php">   10</a>        
                                   
                              </span>
                            </div>
                        </div>
                    </div>


                    
                   

                        

                         
  </div>

    
  </div>

<script>


$(document).ready(function(){


$(document).on('click', '.list-group-item-success', function(event){
$( ".pagelink" ).toggle(1500);
});

if ($(window).width() < 768) {
     $( ".pagelink" ).fadeOut(1000);
  }else{
    
  }

  $(window).resize(function() {
  if ($(window).width() < 768) {
     $( ".pagelink" ).fadeOut(1000);
  }
 else {
     $( ".pagelink" ).fadeIn(1000);
 }
});

});

 
</script>



</body>
</html>