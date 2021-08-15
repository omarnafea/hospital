<?php
session_start();
$_SESSION['page']='appointment';



include '../connect.php';







$statement = $con->prepare("SELECT clinics.* , users.name as doctor 
                              FROM clinics inner join  users on users.clinic_id = clinics.id and users.privilege_id = 1");
$statement->execute();
$clinics = $statement->fetchAll();




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





<div class="contact-us app-page">
		<div class="container-fluid">


		<h2 class="text-center h1">Appointments</h2>

<div id="patient_data" class="d-none my-3">
    <div class="row">
        <div class="col text-info"> Name :  <span class="name"></span> </div>
        <div class="col text-info"> ID Number :  Name :  <span class="id_number"></span> </div>
        <div class="col text-info"> Mobile :  <span class="mobile"></span> </div>
    </div>
</div>

<div id="my_appointments">
    <h2 class="text-primary text-center">My Appointments</h2>
    <table id="appointments_table" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Clinic</th>
            <th scope="col">Date</th>
            <th scope="col">From Time</th>
            <th scope="col">To Time</th>
            <th scope="col">Tests</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<div id="edit_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="update_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title">Edit appointment</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <label> Clinic</label>
                        <select id="edit_clinic_id" class="form-control" name="clinic_id" title="clinic">
                            <option value="-1">Select clinic</option>
                            <?php
                            foreach ($clinics as $clinic){?>
                                <option value='<?=$clinic['id']?>'><?=$clinic['name']?></option>
                            <?php } ?>

                        </select>
                    </div>



                    <div class="form-group">
                        <label> Appointment Date</label>
                        <input type="date" class="form-control" id="edit_appointment_date"
                               name="appointment_date" placeholder="Select date" min="1997-01-01" max="2030-12-31" required>
                    </div>

                    <div class="form-group">
                        <label> From time</label>
                        <input type="time" class="form-control" id="edit_from_time" name="from_time" placeholder="From Time" required>
                    </div>

                    <div class="form-group">
                        <label> To Time</label>
                        <input type="time" class="form-control" id="edit_to_time" name="to_time" placeholder="To Time" required>
                    </div>


                </div>
                <div class="modal-footer">
                    <input type="hidden" name="appointment_id" id="edit_appointment_id" />
                    <input type="submit" name="action"  class="btn btn-success" value="Update" />
                    <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="book">

    <form method="post" id="appointment_form" enctype="multipart/form-data">
<h2 class="text-primary text-center"> Add Appointment</h2>
    <div class="row">

        <div class="col-md-4 my-2" id="personal_data">

            <h4 class="text-center text-info">Personal Data</h4>
            <div class="form-group">
                <label> Name</label>
                <input type="Text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
            </div>

            <div class="form-group">
                <label> mobile</label>
                <input type="Text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile" required>
            </div>

            <div class="form-group">
                <label> Place of living</label>
                <input type="Text" class="form-control" id="place_of_living" name="place_of_living" placeholder="Enter place of living" required>
            </div>

            <div class="form-group">
                <label> Birth date</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Enter birth date" required>
            </div>

            <div class="form-group">
                <label> ID Number</label>
                <input type="number" class="form-control" id="id_number" name="id_number" placeholder="Enter ID Number" required>
            </div>


            <div class="my-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="male" value="male" name="gender" checked>
                    <label class="form-check-label" for="male">Male</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="female" value="female" name="gender">
                    <label class="form-check-label" for="female">Female</label>
                </div>
            </div>

            <div class="my-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="have_insurance" value="1" name="have_insurance">
                    <label class="form-check-label" for="have_insurance">Have Insurance</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="not_have_insurance" value="0" name="have_insurance" checked>
                    <label class="form-check-label" for="not_have_insurance">Not have Insurance</label>
                </div>
            </div>

            <button class="btn btn-info w-50" type="button" id="next_to_appointments">NEXT</button>
        </div>

        <div class="col-md-4 my-2" id="appointment_data">

            <h4 class="text-center text-info"> Appointment Data</h4>
            <div class="form-group">
                <label> Clinic</label>
                <select id="clinic_id" class="form-control" name="clinic_id" title="clinic">
                    <option value="-1">Select clinic</option>
                    <?php
                     foreach ($clinics as $clinic){?>
                         <option value='<?=$clinic['id']?>'><?=$clinic['name']?></option>
                     <?php } ?>

                </select>
            </div>



            <div class="form-group">
                <label> Appointment Date</label>
                <input type="date" class="form-control" id="appointment_date" name="appointment_date" placeholder="Select date" required>
            </div>

            <div class="from-group">
                <label> Available Times </label>
                <select id="select_time" class="form-control" name="select_time" title="time">
                    <option value="-1">Select Time</option>

                </select>
            </div>


            <div class="form-group">
                <label> From time</label>
                <input type="time" class="form-control" id="from_time" name="from_time" placeholder="From Time" required>
            </div>

            <div class="form-group">
                <label> To Time</label>
                <input type="time" class="form-control" id="to_time" name="to_time" placeholder="To Time" required>
            </div>

            <div class="row">
                <button class="btn btn-info w-40" type="button" id="next_to_payment">NEXT</button>
                <button class="btn btn-warning w-40" type="button" id="back_to_personal">BACK</button>
            </div>

        </div>


        <div class="col-md-6 my-2" id="payment_data">

            <h4 class="text-center text-info"> Enter credit card details </h4>


            <div class="row">
                <div class="form-group col-8">
                    <label> credit card number</label>
                    <input type="number" class="form-control" id="card_number" name="card_number" placeholder="Card number" required>
                </div>

                <div class="form-group col-2">
                    <label> Expires : </label>
                    <input type="number" class="form-control" id="exp_month" name="exp_month" placeholder="MM" required>
                </div>

                <div class="form-group col-2">
                    <label class=""> </label>
                    <input type="number" class="form-control mt-2" id="exp_year" name="exp_year" placeholder="YY" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-8">
                    <label> Name on card</label>
                    <input type="number" class="form-control" id="name_on_card" name="name_on_card" placeholder="Name on card" required>
                </div>

                <div class="form-group col-2">
                    <label>CVC : </label>
                    <input type="number" class="form-control" id="cvc" name="cvc" placeholder="cvc" required>
                </div>

            </div>


            <div class="row">
                <button class="btn btn-info w-40" type="button" id="next_to_payment" onclick="submit_appointment_from()">Save</button>
                <button class="btn btn-warning w-40" type="button" id="back_to_appointment">BACK</button>
            </div>

        </div>


    </div>


    </form>
</div>



         </div>





</div>



<div id="login_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="login_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                    <input type="button" name=""  class="btn btn-info" value="Signup" onclick="show_signip()" />

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label> ID Number</label>
                        <input type="number" class="form-control" id="login_id_number" name="id_number" placeholder="Enter ID Number" required>
                    </div>

                    <div class="form-group">
                        <label> Password</label>
                        <input type="password" class="form-control" id="login_password" name="password" placeholder="Enter Password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="action"  class="btn btn-success" value="Login" />
                    <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="signup_modal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="signup_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sign Up</h4>
                    <input type="button" name=""  class="btn btn-info" value="Login" onclick="show_login()" />
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="mb-0"> ID Number</label>
                        <input type="number" class="form-control" id="login_id_number" name="id_number" placeholder="Enter ID Number" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-0"> Full Name</label>
                        <input type="text" class="form-control"  name="name" placeholder="Enter Your Full Name" required>
                    </div>

                    <div class="form-group">
                        <label class="mb-0"> Mobile</label>
                        <input type="number" class="form-control"  name="mobile" placeholder="Enter Your Mobile" required>
                    </div>

                    <div class="form-group">
                        <label class="mb-0"> Password</label>
                        <input type="password" class="form-control"  name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-0"> Confirm Password</label>
                        <input type="password" class="form-control"  name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" name="action"  class="btn btn-success" value="Save" />
                    <button type="button" class="btn btn-default close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>


</script>


<?php include "../include/template/footer.php"?>
            <script src="../layout/js/footer.js"></script>
        	<script src="../layout/js/main.js" ></script>
<?php
if(!isset($_SESSION['patient_id'])){?>
    <script>
        $("#login_modal").modal('show');
        $(".app-page").hide();

        console.log('ok');

        $(document).on('submit', '#login_form', function(event){
            event.preventDefault();
            $.ajax({
                url:"../api/patient_login.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                dataType  : 'json',
                success:function(data)
                {
                    if(data.success){
                       window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            });

        });
        $(document).on('submit', '#signup_form', function(event){
            event.preventDefault();
            $.ajax({
                url:"../api/sign_up.php",
                method:'POST',
                data:new FormData(this),
                contentType:false,
                processData:false,
                dataType  : 'json',
                success:function(data)
                {
                    if(data.success){
                       window.location.reload();
                    }else{
                        alert(data.message);
                    }
                }
            });

        });


        function show_login() {
            $("#login_modal").modal('show');
            $("#signup_modal").modal('hide');
        }
        function show_signip() {
            $("#signup_modal").modal('show');
            $("#login_modal").modal('hide');
        }

    </script>

<?php } ?>
</body>
</html>