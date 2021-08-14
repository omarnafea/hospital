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



$(document).on('submit', '#test_result_form', function(event){
    event.preventDefault();
    $.ajax({
        url:"save_result.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType : "json" ,
        success:function(data)
        {

            if(data.success){
                alert("Result saved successfully");
                $('#test_result_form')[0].reset();
                $('#test_result_modal').modal('hide');
                get_appointments();

            }else{
                alert(data.error);

            }
        }
    });

});


$(document).on('submit', '#edit_test_result_form', function(event){
    event.preventDefault();
    $.ajax({
        url:"update_result.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        dataType : "json" ,
        success:function(data)
        {
            if(data.success){
                alert("Result saved successfully");
                $('#edit_test_result_form')[0].reset();
                $('#edit_test_result_modal').modal('hide');
                get_appointments();
            }else{
                alert(data.error);
            }
        }
    });

});



function show_update_result_form(result_id){

    $.ajax({
        url:"get_result.php",
        method:'POST',
        data:{id : result_id},
        dataType  : 'json',
        success:function(data)
        {
            $("#edit_test_result_modal").modal("show");
            $("#edit_test_result_text").val(data.data.result);
            $("#edit_result_id").val(result_id);
            $(".view-attachment").attr("href", "../../uploads/" + data.data.attachment)
            if(data.success){
                console.log(data.data);
            }else{
                    alert(data.message);
            }
        }
    });
    console.log(result_id);
}
$(document).on('submit', '#appointment_form', function(event){
    event.preventDefault();
    $.ajax({
        url:"appointment.php",
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

function filter_date(){

    var from_date = $("#filter_from_date").val();
    var to_date = $("#filter_to_date").val();
    get_appointments(null ,from_date ,  to_date);
}
function get_appointments(id_number = null , from_date = null , to_date = null){

    var data = {id_number : id_number , from_date :from_date , to_date : to_date };
    $.ajax({
        url:"get_appointments.php",
        method:'POST',
        data:data,
        dataType  : 'json',
        success:function(data)
        {
            if(data.success){
                $("#appointments_table tbody").html('');


                if(data.table !== ''){
                    $("#appointments_table tbody").html(data.table);
                    $("#appointments_table").DataTable();
                }
            }else{
                if(id_number !== null)
                    alert(data.message);
            }
        }
    });
}

function show_test_result_form(id){
$("#test_result_modal").modal("show");
$("#test_result_appointment_id").val(id);

}

$("#appointment_date").change(function () {

    $.ajax({
        url:"get_available_appointments.php",
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
        url:"get_single_appointment.php",
        method:'POST',
        data:{id : id},
        dataType  : 'json',
        success:function(data)
        {
            $("#edit_modal").modal();
            $("#edit_modal #edit_clinic_id").val(data.appointment.clinic_id);

            let test_ids = data.tests_ids ;

            console.log(test_ids);
            $("#edit_modal #edit_test_id").val(test_ids);
            $("#edit_modal #edit_appointment_date").val(data.appointment.appointment_date);
            $("#edit_modal #edit_from_time").val(data.appointment.from_time);
            $("#edit_modal #edit_to_time").val(data.appointment.to_time);
            $("#edit_modal #edit_appointment_id").val(data.appointment.id);
            $("#edit_modal #edit_notes").val(data.appointment.notes);


        }
    });
}


function cancel_appointment(id , canceled = 1){
    let cancel = canceled ? 'cancel' : 'Un Cancel';
    if (window.confirm("Are you sure?  , you want to "+cancel+" this appointment ")) {
        $.ajax({
            url:"cancel_appointment.php",
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


function confirm_appointment(id){
    if (window.confirm("Are you sure?  , you want to confirm this appointment ")) {
        $.ajax({
            url:"confirm.php",
            method:'POST',
            data:{id : id},
            dataType  : 'json',
            success:function(data)
            {
                if(data.success){
                    alert("appointment confirmed");
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
        url:"update_appointment.php",
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


$("#patient_id").change(function () {


    $.ajax({
        url:"get_patient.php",
        method:'POST',
        data: {id : $(this).val()},
        dataType  : 'json',
        success:function(data)
        {
            $("#patient_data .name").text(data.name);
            $("#patient_data .id_number").text(data.id_number);
            $("#patient_data .mobile").text(data.mobile);

            $("#name").val(data.name);
            $("#mobile").val(data.mobile);
            $("#place_of_living").val(data.place_of_living);
            $("#birth_date").val(data.birth_date);
            $("#id_number").val(data.id_number);

            if(data.gender === 'male'){
                $("#male").prop('checked' , true);
            }else{
                $("#female").prop('checked' , true);
            }
            if(data.have_insurence === '0'){
                $("#not_have_insurance").prop('checked' , true);
            }else{
                $("#have_insurance").prop('checked' , true);
            }
        }
    });

});

function go_to_new() {
    window.location.href = "#appointment_form";
}