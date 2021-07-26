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
         dataType:"json",
         success:function(data)
         {
          $('#home_text_en').val(data.home_text_en);
          $('#home_text_ar').val(data.home_text_ar);
          $('#about_text_en').val(data.about_text_en);
          $('#about_text_ar').val(data.about_text_ar);
          $('#logo').html(data.logo);
          

         }
        })
    }

          

    



 $(document).on('submit', '#home_page_form', function(event){
  event.preventDefault();
  
   $.ajax({
    url:"update_maininfo.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     
    }
   });
 
 });


 $(document).on('submit', '#about_page_form', function(event){
  event.preventDefault();
  
   $.ajax({
    url:"update_maininfo.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     
    }
   });
 
 });




$(document ).on('change','#company_logo' , function(){ 

 var formData = new FormData();
formData.append('company_logo', $('#company_logo')[0].files[0]);


 $.ajax({

    url:"update_logo.php",
    method:'POST',
    data:formData,
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     load_main_data();
     
    }
   });

 
});






















 
 
});