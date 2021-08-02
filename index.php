
<?php

include 'connect.php';

$statement = $con->prepare("SELECT clinics.* , users.name as name 
                              FROM clinics inner  join  users on users.clinic_id = clinics.id and users.privilege_id = 1");
$statement->execute();
$clinics = $statement->fetchAll();

$statement = $con->prepare("SELECT * from tests");
$statement->execute();
$tests = $statement->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Appointment System</title>
	<link rel="icon" href="layout/img/logo.jpeg">
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="eleven one web house solutions">
   <meta name="robots" content="index, follow">
   <meta name="copyright" content=" Copyright 2019 Eleven One all rghts reserved">
   <meta name="keywords" content="eleven,eleven one,web,web solutions,wed design,web jordan , web development">

	<script src="layout/js/jquery-3.4.1.min.js" ></script>	
	<script src="layout/js/bootstrap.min.js" ></script>
	<script src="https://kit.fontawesome.com/9bb4e0493f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="layout/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="layout/css/main.css">


</head>
<body>
<?php include "include/template/home_navbar.php"?>


<div class="slider">
	<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
	  <div class="carousel-inner">

          <h6>Appointments WEB SOLUTIONS</h6>
          <h3>Your Partner in Growth</h3>
          <p>You have goals, you need results, we have the way to get you there. We create digital solutions that will convert your visitors into real clients.</p>
          <a href="appointment" class="btn btn-light">Appointment Now</a>
          <div class="overlay"></div>

          <div class="carousel-item active">
              <img src="uploads/slider1.jpg" class="d-block w-100" alt="Image" >
          </div>

          <div class="carousel-item">
              <img src="uploads/slider2.jpg" class="d-block w-100" alt="Image" >
          </div>
      </div>
	</div>
</div>
<!-- end slider-->


<!--start who we are-->
<div class="who-we-are">
	<div class="container">
		<h6 class="text-center">WHO WE ARE</h6>
		<p class="text-center" id="about_text">Who we are here</p>

	</div>
</div>
<!--end hwo we are-->





<!-- start footer-->
<div class="footer">
	<div class="container">
		<div class="row">

            <div class="col-md-4 col-sm-6">
				<div class="helpful-links">
					<h2>Contact Us</h2>
					<ul class="list-unstyled">
						<Li id="">address: Jordan / amman </Li>
						<Li id=""> Phone: 0797243170 </Li>

						<Li id="">address2: Jordan / amman </Li>
						<Li id=""> Phone: 0797243170 </Li>

						<Li id="">Email:<a href="mailto:info@appointment.com?subject=contact">info@appointment.com</a> </Li>
					</ul>
					
				</div>
			</div>


			<div class="col-md-4 col-sm-6">
				<div class="helpful-links">
					<h2>Quick Links</h2>
					<div class="row">
						<div class="col">
							<ul class="list-unstyled">
								<li><a href="#">Home</a> </li>
                                <li><a href="contact">Contact us</a></li>
							</ul>
						</div>
						
					</div>
					
				</div>
			</div>

			<div class="col-md-4 col-sm-6">
				<div class="helpful-links">
					<h2>About</h2>
					<div class="row">
						<div class="col">
							<ul class="list-unstyled">
								<li><a href="about"> The Company</a></li>
							</ul>
						</div>
					
						
					</div>
					
				</div>
			</div>

			
			

		</div>
	</div>
</div>

<div class="copy-right">
	<div class="container">
		<div class="row ">
			<div class="col-sm-8  text-center text-sm-left text-uppercase">
                Copyright 2021 <span id="">Appointment System</span> &copy; all rights reserved</div>
			<div class="col-sm-4 text-center text-sm-right">
				<ul class="list-unstyled" id="social_links">

					


				</ul>
			</div>
		</div>
	</div>
</div>

<!-- end footer-->

<script src="layout/js/main.js"></script>

</body>
</html>