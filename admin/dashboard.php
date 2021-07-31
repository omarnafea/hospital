<?php
session_start();


include "connect.php";
include "include/functions/functions.php";


if(!is_user_authorized()){
    header("location:index.php");
    exit();
}

$patients_count = get_patients_count();
$appointments_count = get_appointments_count();
$today_appointments_count = get_today_appointments_count();


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

            <?php if(is_admin()){?>
                <a class="dropdown-item" href="manage_users">Manage users</a>
            <?php }?>
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
      <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-success"><a href="#"><i class="fas fa-list"></i></a> </li>
        <li class="list-group-item pagelink active"><a href="dashboard.php"><i class="fas fa-list"></i> DASHBOARD</a></li>

          <?php
          if(is_admin()){?>

              <li class="list-group-item pagelink"> <a href="manage_users"><i class="fas fa-user"></i> Manage Users</a></li>
              <li class="list-group-item pagelink"> <a href="clinics"><i class="fas fa-sitemap"></i> Clinics</a></li>
          <?php } ?>

          <?php if(is_admin() || is_doctor()){?>
              <li class="list-group-item pagelink"> <a href="tests"><i class="fas fa-sitemap"></i> Tests</a></li>

          <?php }?>



          <li class="list-group-item pagelink"> <a href="patients"><i class="fas fa-user"></i> Patients</a></li>
          <li class="list-group-item pagelink"> <a href="appointments"><i class="fas fa-clock-o"></i> Appointments</a></li>
        <li class="list-group-item pagelink"> <a href="change_password"><i class="fas fa-lock"></i> Change Password</a></li>
        <li class="list-group-item pagelink"><a href="logout.php"> <i class="fas fa-power-off"></i> LOGOUT</a></li>
      </ul>
    
    
  </div>
  <div class="col-md-9">
    
    <div class="row">
                        

                    <div class="col-md-4 col-sm-6 ">
                        <div class="stat st-items">
                               <a href="#"> <i class="fa fa-group"></i></a>            
                             <div class="info">
                             <span class="total"> Total Patients</span>
                              <span class="count">
                                   
                                <a href="supliers/index.php">
                                 <?php echo $patients_count ;  ?>
                                 </a>        
                                   
                              </span>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-4 col-sm-6 ">
                        <div class="stat st-items">
                               <a href="supliers/index.php"> <i class="fa fa-group"></i></a>            
                             <div class="info">
                             <span class="total"> Total Appointments</span>
                              <span class="count">
                                <a href="supliers/index.php">   <?=$appointments_count?></a>
                                   
                              </span>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-4 col-sm-6 ">
                        <div class="stat st-items">
                               <a href="supliers/index.php"> <i class="fa fa-group"></i></a>            
                             <div class="info">
                             <span class="total"> Today Appointments</span>
                              <span class="count">
                                   
                                <a href="supliers/index.php">   <?=$today_appointments_count?></a>
                                   
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