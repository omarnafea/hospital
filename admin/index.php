<!DOCTYPE html>
<html lang="en">
<head>
	<title>main aside</title>
	<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="layout/js/jquery-3.4.1.min.js" type="text/javascript"></script>	
	<script src="layout/js/bootstrap.min.js" type="text/javascript"></script>
	 <script src="https://kit.fontawesome.com/9bb4e0493f.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="layout/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="layout/css/main.css">
</head>
<body>

<div class="login" id="login_form">
  <div class="container">
  	<h1 class="text-center"> AMDIN LOGIN </h1>
    <form  method="post">
           <div class="form-group">
			    <label for="exampleInputEmail1">User Name</label>
			    <input type="text" id="username" placeholder="Enter username" name="username" class="form-control">
		  </div>
        
           <div class="form-group">
			    <label for="exampleInputPassword1">Password</label>
			    <input type="password" id="password" placeholder="Enter password" name="password" class="form-control">
		   </div>
        <input type="button" id="submit" value="Login" name="login" class="btn btn-primary" >
        <div id="text"></div>
        <p id="message"></p>
     
   </form>
  </div>
</div>
		
	
<script type="text/javascript">

$(document).ready(function(){

     $(document).on('click', '#submit', function(){

        var username = $("#username").val();
        var password = $("#password").val();

     if(username.length == 0 || password.length == 0){
        $("#message").html("please fill out this field first").fadeIn();
        $("#message").addClass("error");
         return false;
    }else{
        $.ajax({
          type : 'POST',
          url  : 'check_login.php',
          data : {username:username,password:password},
          success : function(feedback){
             $("#text").html(feedback);

             if (feedback=='ok') {
              window.location = "dashboard.php";
             }
           }
          });
       }
    });

    $(".email_error_text").hide();
    $(".password_error_text").hide();

    var error_email = false;
    var error_password = false;



});
 
 
</script>

</body>
</html>