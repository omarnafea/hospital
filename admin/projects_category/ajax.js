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

          

    



 $(document).on('submit', '#cat_add_form', function(event){
  event.preventDefault();
   $.ajax({
    url:"insert_category.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
     $('#catModal').modal('hide');
      $('#cat_add_form')[0].reset();
      load_main_data();
     
    }
   });
 
 });


 $(document).on('click', '.update', function(){
  var cat_id = $(this).attr("id");  
  load_parents_cat_data(cat_id);
  $.ajax({
   url:"fetch_single.php",
   method:"POST",
   data:{cat_id:cat_id},
   dataType:"json",
   success:function(data)
   {
    $('#catEditModal').modal('show');
    $('#catEditModal #cat_id').val(data.cat_id);
    $('#catEditModal #cat_edit_name').val(data.cat_name);
    $('#catEditModal #cat_edit_name_ar').val(data.cat_name_ar);
    $('#catEditModal #cat_uploaded_image').val(data.cat_image);
    
    $('#catEditModal #option').html(data.parent_name);
    $("#catEditModal #option").val(data.parent_id).attr('selected','selected');
   }
  })
 });

 function load_parents_cat_data(id)
    { 
        $.ajax({
         url:"load_parents_cat_data.php",
         method:"POST",
         data:{id:id},
         success:function(data)
         {
          $('#catEditModal #cat_edit_parent').html(data);
         }
        })
    }


 $(document).on('submit', '#catEditModal #cat_edit_form', function(event){
  event.preventDefault();
  
   $.ajax({
    url:"update_category.php",
    method:'POST',
    data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     
    $('#catEditModal').modal('hide');
    load_main_data();
    alert(data);
    }
   });
 
 });


$(document ).on('change','#cat_edit_image' , function(){ 

 var formData = new FormData();
formData.append('cat_edit_image', $('#cat_edit_image')[0].files[0]);
formData.append('cat_id', $('#cat_id').val());


 $.ajax({

    url:"update_image.php",
    method:'POST',
    data:formData,
    contentType:false,
    processData:false,
    success:function(data)
    {
     alert(data);
    
     
    }
   });

 
});





 $(document).on('click', '.deactive', function(){
  var cat_id = $(this).attr("id");  
  var action ='deactive';
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{cat_id:cat_id,action:action},
   success:function(data)
   {
    alert(data);
    load_main_data();
   }
  })
 });

 $(document).on('click', '.active', function(){
  var cat_id = $(this).attr("id");  
  var action ='active';
  
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{cat_id:cat_id,action:action},
   success:function(data)
   {
    alert(data);
    load_main_data();
   }
  })
 });

 
 
});