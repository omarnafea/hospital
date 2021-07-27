<?php
session_start();
include('../connect.php');

if(!isset($_SESSION['user_id'])){
  header("location:../index.php");
  exit();
}




if($_POST["new_password"]!=$_POST["re_new_password"]){
  echo "the passwords not matches !";
  exit();
}
               //check if user Exist in database 
                $stmt=$con->prepare("SELECT
                 user_id, user_name
                 FROM users WHERE password = ? AND user_id = ? AND type='admin' LIMIT 1 ");
                //limit 1 
                  $stmt->execute(array(sha1($_POST["current_password"]),$_SESSION['user_id']));
                  $row=$stmt->fetch();
                  $count=$stmt->rowCount();
      

                  if($count>0){        

                    $statement = $con->prepare(
                                   "UPDATE users 
                                    SET password  = :password
                                    WHERE user_id = :user_id");
                                  $result = $statement->execute(
                                   array(
                                    ':password'             => sha1($_POST["new_password"]),
                                    ':user_id'              => $_SESSION['user_id']
                                   )
                                  );
                                  if(!empty($result))
                                  {
                                   echo 'Your Password has been changed !';
                                  
                                  }   
                    
                    
                  }
                  else{
                    echo "invalid password Plese try again !!";
                  }




  
 
 








?>