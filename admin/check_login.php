<?php

	session_start();
			
include "connect.php";
// check if user comming from http post request
if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $password=sha1($_POST['password']);
//check if user Exist in database
    $stmt=$con->prepare("SELECT
      id, user_name,password
     FROM users WHERE user_name = ? AND password = ? 
       AND is_active=1 LIMIT 1 ");
        $stmt->execute(array($username,$password));
        $row=$stmt->fetch();
        $count=$stmt->rowCount();
        if($count>0){
            $_SESSION['username']=$username;      // Regester Session Name
            $_SESSION['user_id']=$row['id'];  // Regester Session ID
         echo 'ok';
        }
        else{
            echo "<div class='alert alert-danger'>Invalid Credential </div> ";
        }
    } // end if  sheck method =post
?>