$(document).ready(function(){

$(document).on('click', '.list-group-item-success', function(event){
  event.preventDefault();

$( ".pagelink" ).toggle(1500);
});

if ($(window).width() < 768) {
     $( ".pagelink" ).fadeOut(1000);
  }

$(window).resize(function() {
  if ($(window).width() < 768) {
     $( ".pagelink" ).fadeOut(1000);
  }
 else {
     $( ".pagelink" ).fadeIn(1000);
 }
});

  load_main_data();
    function load_main_data()
    { 
        $.ajax({
         url:"fetch_main_data.php",
         method:"POST",
         data:{},
         success:function(data)
         {
          $('tbody').html(data);
         }
        })
    }

          

    



 $(document).on('submit', '#user_add_form', function(event){
  event.preventDefault();

  if($("#clinic_id").val() === '-1' && $("#privilege_id").val() === '1' ){
   alert('Please select a clinic');
   return false;
  }
  if($("#privilege_id").val() === '-1'){
   alert('Please select a privilege');
   return false;
  }

   $.ajax({
    url:"insert_user.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     $('#user_add_modal').modal('hide');
       $('#user_add_form')[0].reset();
     load_main_data();
        $(".clinic-id-form").addClass('d-none');
    }
   });
 
 });


 $(document).on('click', '.update', function(){
  var user_id = $(this).attr("id");  
  $.ajax({
   url:"fetch_single.php",
   method:"POST",
   data:{user_id:user_id},
   dataType:"json",
   success:function(data)
   {
    var user = data.user;
    $('#user_edit_modal').modal('show');
    $('#user_edit_modal #edit_name').val(user.name);
    $('#user_edit_modal #edit_user_name').val(user.user_name);
    $('#user_edit_modal #edit_email').val(user.email);
    $('#user_edit_modal #edit_user_id').val(user_id);

     $('#user_edit_modal #edit_privilege_id').val(user.privilege_id);

     var clinics_options = `<option value="-1">Select Clinic</option>`;
     var clinics = data.clinics;
     if(user.privilege_id == '1'){

         clinics_options += `<option selected value="${user.clinic_id}">${user.clinic_name}</option>`;
      for(let i = 0 ; i<clinics.length ; i++){

          clinics_options += `<option  value="${clinics[i].id}">${clinics[i].name}</option>`;
      }

      $(".edit-clinic-id-form").removeClass('d-none');
      $("#edit_clinic_id").val(data.clinic_id);
     }else{
         $(".edit-clinic-id-form").addClass('d-none');
     }

     $("#edit_clinic_id").html(clinics_options);
    
   }
  })
 });


 $(document).on('submit', '#user_edit_modal #user_edit_form', function(event){
  event.preventDefault();
  
   $.ajax({
    url:"update_user.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
    $('#user_edit_modal').modal('hide');
    load_main_data();
    }
   });
 
 });

 $(document).on('click', '.deactive', function(){
  var user_id = $(this).attr("id");  
  var action ='deactive';
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{user_id:user_id,action:action},
   success:function(data)
   {
    alert(data);
    load_main_data();
    
   }
  })
 });

 $(document).on('click', '.active', function(){
  var user_id = $(this).attr("id");  
  var action ='active';
  
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{user_id:user_id,action:action},
   success:function(data)
   {
    alert(data);
    load_main_data();
   }
  })
 });

 
 
});

function onPrevChanged() {
    if($("#privilege_id").val() == '1'){
     $(".clinic-id-form").removeClass('d-none');
    }else{
        $(".clinic-id-form").addClass('d-none');
    }
}

function onEditPrevChanged() {
    if($("#edit_privilege_id").val() == '1'){
        $(".edit-clinic-id-form").removeClass('d-none');
    }else{
        $(".edit-clinic-id-form").addClass('d-none');
    }
}