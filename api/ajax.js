$(document).ready(function(){


  

  load_slider();
    function load_slider()
    {   
        
        $.ajax({
         url:"load_images.php",
         method:"POST",
         data:{},
         success:function(data)
         {
         
          $('.carousel-inner').html(data);
         }
        })
    }

    


 

 

 
 
});