<?php

         include "db.php";

     
              function checkItem($select,$from,$value){      
               global $con;
               $statment =$con->prepare("SELECT $select FROM  $from WHERE $select=? ");
               $statment->execute(array($value));
               
               $count=$statment->rowCount();
               return $count;
              }		




                  /*
				** count number of items function V1.0 
				** Function to count number of items Rows
				** $item  =the item to count 
				** $table =the table to choose from
				*/		

				function countItems($item,$table,$where=''){
                
                global $con;

                $stmt=$con->prepare("SELECT COUNT($item) FROM $table $where   ");
                $stmt->execute();

                return $stmt->fetchColumn();

				}

        function pharmacy_name(){
                
                global $con;

                $stmt=$con->prepare("SELECT  ph_name FROM pharmacy WHERE ph_id=1");
                $stmt->execute();
                return $stmt->fetchColumn();

        }



				 
                      

                    






?>









