





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

  if($("#clinic_id").val() === '-1'){
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
    $('#user_edit_modal').modal('show');
    $('#user_edit_modal #edit_first_name').val(data.first_name);
    $('#user_edit_modal #edit_last_name').val(data.last_name);
    $('#user_edit_modal #edit_user_name').val(data.user_name);
   
    $('#user_edit_modal #edit_user_id').val(data.user_id);
     $('#user_edit_modal #edit_password').val(data.password);

          if (data.user_type =='admin') {
            
            $("#user_edit_modal #edit_admin_user").attr('checked', 'checked');
          }else{
             $("#user_edit_modal #edit_normal_user").attr('checked', 'checked');
          }
    
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