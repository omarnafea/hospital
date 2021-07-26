

                <option class="stat" value="0" >... </option>
                  <?php 
                  session_start();
                      if(!isset($_SESSION['migna_user_id'])){
                        header("location:../index.php");
                        exit();
                      }
                
                  include('../connect.php');
                  $query = "SELECT * FROM categories where parent = 0 AND cat_id !=0 AND cat_id != ?";
                  $statement = $con->prepare($query);
                  $statement->execute( array($_POST['id']));
                  $cats = $statement->fetchAll();
      
                  foreach ($cats as $cat) {
                      echo '<option class="stat" value="'.$cat["cat_id"].'" >'.$cat["cat_name"].'</option>';
                  }
                    ?>
                <option id="option" value="0"></option>