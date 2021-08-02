<?php
session_start();
$_SESSION['page']='contact';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact</title>
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
<?php include "../include/template/navbar.php"?>

<div class="contact-us">
		<div class="container">
			

		<h2 class="text-center h1">Contact</h2>

       <div class="row">
		       	<div class="col-md-6">
		       		<h2 class="text-center">Keep In Touch</h2>
		       		<form>
					  <div class="row">
					    <div class="col">
					      <input type="text" class="form-control" placeholder="First name">
					    </div>
					    <div class="col">
					      <input type="text" class="form-control" placeholder="Last name">
					    </div>
					    <div class="col">
					      <input type="text" class="form-control" placeholder="Last name">
					    </div>
					  </div>

					  <div class="row">
					    <div class="col">
					      <textarea class="form-control" placeholder="Your Message" rows="5" cols="20"></textarea>  
					    </div>
					  </div>
					  <button type="button" class="btn btn-light">SEND MESSAGE</button>
					</form>

		       	</div>

		       	<div class="col-md-6">
			       		<div class="contact-data"> 
			       		<h6>Find us at the office</h6>
			       		<p id="address_1"></p>
			       		<p id="address_2"></p>

			       		<h5>Give us a ring</h5>
			       		<p id="phone">T:5616515615</p>
			       		<p id="tel">T:5616515615</p>
			       		<p id="email">T:5616515615</p>
			       	</div>
		       	</div>
       </div>







         <div class="location">
         	<h2 class="text-center">Our Location</h2>
					<div class="*embed-responsive">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3470.4672598410725!2d35.01342168519308!3d29.561005082060753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15006fc6aac7dcf3%3A0xfe27ac82f0fc3b00!2zQWwgS3V3YWl0IFN0IDEwN9iMINin2YTYudmC2KjYqQ!5e0!3m2!1sar!2sjo!4v1574012345092!5m2!1sar!2sjo" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
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