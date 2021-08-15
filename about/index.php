<?php
session_start();
$_SESSION['page']='about';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>About</title>
	<meta charset="utf-8">
	<link rel="icon" href="../layout.img/logo.jpeg">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="description" content="eleven one web house solutions">
   <meta name="robots" content="index, follow">
   <meta name="copyright" content=" Copyright 2019 Eleven One all rghts reserved">
   <meta name="keywords" content="eleven,eleven one,web,web solutions,wed design,web jordan , web development">
	<script src="../layout/js/jquery-3.4.1.min.js" ></script>	
	<script src="../layout/js/bootstrap.min.js" ></script>
	 <script src="https://kit.fontawesome.com/9bb4e0493f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../layout/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../layout/css/main.css">
</head>
<body>
<?php
include ("../connect.php");

include "../include/template/navbar.php";

?>

<div class="about-us">
		<div class="container">
			

		<h1 class="text-center" id="full_company_name">About Us</h1>
		<div ><a href="../" id="logo"></a></div>

       <div class="row">
		       	<div class="col-md-6">
		       		<h2 class="text-center">About Us</h2>
		       		<p class="lead" id="about_en"></p>

		       	</div>


		       	<div class="col-md-6">
		       		<h2 class="text-center">عن الشركة</h2>
		       		<p class="lead" id="about_ar"></p>
		       		

		       	</div>

		       
       </div>





		</div>
         

         


</div>



<?php include "../include/template/footer.php"?>
<script src="../layout/js/footer.js"></script>
<script>
	
	$(document).ready(function(){

  var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop){
       
       $(".navbar").css("padding", "0px");
       $(".navbar-brand > span").css("font-size", "20px");

      
       
   } else {
      $(".navbar").css("padding", "3px");
      $(".navbar-brand > span").css("font-size", "30px");
   }
   lastScrollTop = st;
});

new_visitor();
    function new_visitor()
    {   
        
        $.ajax({
         url:"../api/new_visitor.php",
         method:"POST",
         data:{},
         success:function(data)
         {
            
         

         }
        })
    }





});
</script>
</body>
</html>