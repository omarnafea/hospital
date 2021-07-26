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

  

          

    



 $(document).on('submit', '#change_password_form', function(event){
  event.preventDefault();

  var password =  $('#current_password').val();
  var new_password =  $('#new_password').val();
  var re_new_password =  $('#re_new_password').val();

  if(new_password==''||new_password==''||re_new_password==''){
    alert("please fill all fields");
    return;
  }

  if(new_password!=re_new_password){
    alert("the passwords not mathches");
    return;
  }
 
   $.ajax({
    url:"change_password.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
    $('#change_password_form')[0].reset();
     alert(data);
     
    }
   });
 
 });



















 
 
});