

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

var elements = ["Saab", "Volvo", "BMW"];
console.log(elements[0]);

    $('.carousel').carousel({
		  interval: 3000
		 
		});


$(document).on('mouseenter', '.work', function(event){
  event.preventDefault();
 $(".work-name", this).fadeIn( 500 );
});

 
$(document).on('mouseleave', '.work', function(event){
  event.preventDefault();
 $(".work-name", this).fadeOut( 500 );
});



  load_slider();
    function load_slider()
    {   
        
        $.ajax({
         url:"api/load_slider.php",
         method:"POST",
         data:{},
         success:function(data)
         {
         
          $('.slider .carousel-inner').html(data);
         }
        })
    }



    load_social_links();
    function load_social_links()
    {
        $.ajax({
         url:"api/load_social_links.php",
         method:"POST",
         data:{},
         success:function(data)
         {
            
          $('#social_links').html(data);

         }
        })
    }

});