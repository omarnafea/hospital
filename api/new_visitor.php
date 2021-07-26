<?php
$cookie_name = "elevenvisitor";
$cookie_value = "elevenvisitor";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30 * 7), "/"); // 86400 = 1 day

if(!isset($_COOKIE[$cookie_name])) {
   setcookie($cookie_name, $cookie_value, time() + (86400 * 30 * 7), "/"); // 86400 = 1 day
  include('../connect.php');

	 $statement = $con->prepare(
	  "SELECT total FROM visitors WHERE website_id = 1 " );
	 $statement->execute();
	 $result = $statement->fetch();
	 $visit_number=$result['total'];
	 $visit_number++;

	  $statement2 = $con->prepare(
	  "UPDATE visitors SET total =".$visit_number."  WHERE website_id = 1 " );
	  $statement2->execute();





} 
?>