<?php

	session_start();
			
			include "connect.php";
		
					// check if user comming from http post request 

					if($_SERVER['REQUEST_METHOD']=='POST'){
						
								$username=$_POST['username'];
								$password=sha1($_POST['password']);
								
							//check if user Exist in database 
								$stmt=$con->prepare("SELECT
								 user_id, user_name,password
								 FROM users WHERE user_name = ? AND password = ? 
								  AND type='admin' AND active='yes' LIMIT 1 ");
								//limit 1 
									$stmt->execute(array($username,$password));
									$row=$stmt->fetch();
									$count=$stmt->rowCount();
			

									if($count>0){
										$_SESSION['username']=$username;      // Regester Session Name 
										$_SESSION['migna_user_id']=$row['user_id'];  // Regester Session ID
										
                                     echo 'ok';
                                       
										
										
									}
									else{
										echo "<div class='alert alert-danger'>invalid cridental </div> ";
									}

							} // end if  sheck method =post

						?>