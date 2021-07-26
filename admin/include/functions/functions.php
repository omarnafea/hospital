<?php
         include "connect.php";
				function count_visitors(){
                
                global $con;

                $stmt=$con->prepare("SELECT total FROM visitors where website_id = 1;");
                $stmt->execute();
                $count = $stmt->fetch();
                return $count['total'];

				}
?>