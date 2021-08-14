
$("#appointment_data").hide();
$("#payment_data").hide();


$("#next_to_appointments").click(function () {
    //validate appointment form
    if($("#name").val().trim() === ''){
        alert("Please enter your name");
        return false;
    }
    if($("#mobile").val().trim() === ''){
        alert("Please enter your mobile");
        return false;
    }
    
    if($("#mobile").val().trim().length < 10 || $("#mobile").val().trim().length > 12 ){
        alert("Please enter a valid  mobile");
        return false;
    }
    
    
    if($("#place_of_living").val().trim() === ''){
        alert("Please enter your place of living");
        return false;
    }
    if($("#birth_date").val().trim() === ''){
        alert("Please enter your birth date");
        return false;
    }
    if($("#id_number").val().trim() === ''){
        alert("Please enter your id number");
        return false;
    }
    
    if($("#id_number").val().trim().length  != 10){
        alert("Please enter a valid  id number");
        return false;
    }

    $("#personal_data").hide();
    $("#appointment_data").show();

});

$("#next_to_payment").click(function () {

    //validate appointment form
    if($("#clinic_id").val() === '-1'){
        alert("Please Select a clinic");
        return false;
    }

    var appointment_date = $("#appointment_date").val();

    if(appointment_date === ''){
        alert("Please Select a appointment date");
        return false;
    }
    var now_date = new Date();
    var  appointment_date_obj=new Date(appointment_date);

    if(now_date > appointment_date_obj ){
        alert("Appointment date must be in the future");
        return false;
    }
    var from_time = $("#from_time").val();
    var to_time = $("#to_time").val();


    if(from_time.length === 0){
        alert("Please select from time");
        return false;
    }

    if(to_time.length === 0){
        alert("Please select to time");
        return false;
    }

    if(to_time <= from_time){
        alert("Invalid time range");
        return false;
    }



    if($("#not_have_insurance").prop('checked') === true){
        $("#payment_data").show();
        $("#appointment_data").hide();
    }else{
        submit_appointment_from();
    }

});


function submit_appointment_from(){
    $("#appointment_form").submit();
}


$("#back_to_personal").click(function () {
    $("#personal_data").show();
    $("#appointment_data").hide();
});


$("#back_to_appointment").click(function () {
    $("#payment_data").hide();
    $("#personal_data").show();

});



$(document).on('submit', '#appointment_form', function(event){
    event.preventDefault();
    $.ajax({
        url:"../api/appointment.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType  : 'json',
        success:function(data)
        {
            if(data.success){
                alert('You appointment saved successfully');
                get_appointments();
            }else{
                alert(data.message);
            }
        }
    });

});




function search_by_id_number(){

    let id_number =$("#search_id_number").val();
    if(id_number.trim() !== ''){
        get_appointments(id_number);
    }
}
get_appointments();
function get_appointments(id_number = null){

    var data = {id_number : id_number};
    $.ajax({
        url:"../api/get_appointments.php",
        method:'POST',
        data:data,
        dataType  : 'json',
        success:function(data)
        {
            if(data.success){

                $("#patient_data").removeClass('d-none');
                $("#patient_data .name").text(data.patient.name);
                $("#patient_data .id_number").text(data.patient.id_number);
                $("#patient_data .mobile").text(data.patient.mobile);

                $("#name").val(data.patient.name);
                $("#mobile").val(data.patient.mobile);
                $("#place_of_living").val(data.patient.place_of_living);
                $("#birth_date").val(data.patient.birth_date);
                $("#id_number").val(data.patient.id_number);

                if(data.patient.gender === 'male'){
                    $("#male").prop('checked' , true);
                }else{
                    $("#female").prop('checked' , true);
                }

                if(data.patient.have_insurence === '0'){
                    $("#not_have_insurance").prop('checked' , true);
                }else{
                    $("#have_insurance").prop('checked' , true);
                }

                if(data.table !== ''){
                    $("#appointments_table tbody").html(data.table);
                }
            }else{
                if(id_number !== null)
                alert(data.message);
            }
        }
    });
}


$("#appointment_date").change(function () {

    $.ajax({
        url:"../api/get_available_appointments.php",
        method:'POST',
        data:{date : $(this).val()},
        success:function(data)
        {
            $("#select_time").html(data);
        }
    });

});

$("#select_time").change(function () {
   var from_time = $(this).find(':selected').data('from');
   var to_time = $(this).find(':selected').data('to');
   $("#from_time").val(from_time);
   $("#to_time").val(to_time);

});
function update_appointment(id){
    $.ajax({
        url:"../api/get_single_appointment.php",
        method:'POST',
        data:{id : id},
        dataType  : 'json',
        success:function(data)
        {
                $("#edit_modal").modal();
                $("#edit_modal #edit_clinic_id").val(data.clinic_id);


                $("#edit_modal #edit_appointment_date").val(data.appointment_date);
                $("#edit_modal #edit_from_time").val(data.from_time);
                $("#edit_modal #edit_to_time").val(data.to_time);
                $("#edit_modal #edit_appointment_id").val(data.id);


        }
    });
}


function cancel_appointment(id , canceled = 1){
    let cancel = canceled ? 'cancel' : 'Un Cancel';
    if (window.confirm("Are you sure?  , you want to "+cancel+" this appointment ")) {
        $.ajax({
            url:"../api/cancel_appointment.php",
            method:'POST',
            data:{id : id , canceled  : canceled},
            dataType  : 'json',
            success:function(data)
            {
                if(data.success){
                    alert("appointment canceled");
                    get_appointments();
                }else{
                    alert(data.message);
                }
            }
        });
    }

}


$(document).on('submit', '#update_form', function(event){
    event.preventDefault();



    //validate appointment form
    if($("#edit_clinic_id").val() === '-1'){
        alert("Please Select a clinic");
        return false;
    }

    var appointment_date = $("#edit_appointment_date").val();

    if(appointment_date === ''){
        alert("Please Select a appointment date");
        return false;
    }
    var now_date = new Date();
    var  appointment_date_obj=new Date(appointment_date);

    if(now_date > appointment_date_obj ){
        alert("Appointment date must be in the future");
        return false;
    }




    var from_time = $("#edit_from_time").val();
    var to_time = $("#edit_to_time").val();

    if(from_time.length === 0){
        alert("Please select from time");
        return false;
    }

    if(to_time.length === 0){
        alert("Please select to time");
        return false;
    }

    if(to_time <= from_time){
        alert("Invalid time range");
        return false;
    }



    $.ajax({
        url:"../api/update_appointment.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType  : 'json',
        success:function(data)
        {
            if(data.success){
                alert('You appointment saved successfully');
                $("#edit_modal").modal('hide');
                get_appointments();
            }else{
                alert(data.message);
            }
        }
    });

});


$('.carousel').carousel({
    interval: 2500

});




$(document).ready(function(){


  var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop){
       
       $(".navbar").css("padding", "0px");
       $(".navbar-brand > span").css("font-size", "20px");

      
       
   } else {
      $(".navbar").css("padding", "3px");
      $(".navbar-brand > span").css("font-size", "25px");
   }
   lastScrollTop = st;
});


$(document).on('mouseenter', '.work', function(event){
  event.preventDefault();
 $(".work-name", this).fadeIn( 500 );
});

 
$(document).on('mouseleave', '.work', function(event){
  event.preventDefault();
 $(".work-name", this).fadeOut( 500 );
});

});