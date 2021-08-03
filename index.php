
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

          <h6>Appointments WEB SOLUTIONS </h6>
          <h3>Welcome to my simple project</h3>
          <p>To solve the problem of appointments inside the hospital inside the south, especially the city of Aqaba, as Hashem Hospital serves about six villages around Aqaba, so this site was designed to help this category who comes from far places and also serves the category of special needs that are difficult to reach the hospital to book an appointment.</p>
          <a href="appointment" class="btn btn-light">Appointment Now</a>
          <div class="overlay"></div>

          <div class="carousel-item active">
              <img src="uploads/ThinkstockPhotos-842852832.jpg" class="d-block w-100" alt="Image" >
          </div>

          <div class="carousel-item">
              <img src="uploads/medical-appointment-reminder-people.jpg" class="d-block w-100" alt="Image" >
          </div>
          
          <div class="carousel-item">
              <img src="uploads/MedicalAppointment.dafc7db6805b5541eb843f4870979680500.jpg" class="d-block w-100" alt="Image" >
          </div>
      </div>
	</div>
</div>
<!-- end slider-->


<!--start who we are-->

<!--end hwo we are-->





<!-- start footer-->
<div class="footer">
	<div class="container">
		<div class="row">

            <div class="col-md-4 col-sm-6">
				<div class="helpful-links">
					<h2>Contact Us</h2>
					<ul class="list-unstyled">
						
						<Li id="">address: Jordan / aqaqba </Li>
						<Li id=""> Phone: 0797243170 </Li>

						<Li id="">Email:<a href="mailto:info@appointment.com?subject=contact">abasithaer8@gmail.com</a> </Li>
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