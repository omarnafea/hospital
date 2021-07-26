
$(document).ready(function(){
load_social_links();
    function load_social_links()
    {   
        
        $.ajax({
         url:"../api/load_social_links.php",
         method:"POST",
         data:{},
         success:function(data)
         {
            
          $('#social_links').html(data);

         }
        })
    }


     load_home_page_data();
    function load_home_page_data()
    {   
        $.ajax({
         url:"../api/load_home_page_data.php",
         method:"POST",
         data:{},
         dataType:"json",
         success:function(data)
         {
          $('#head_tel_no').html(data.mobile_number);
          $('#head_email').html(data.email_address);

          $('#about_text').html(data.about_text_en);
          $('#footer_address_1').html(data.address_en);
          $('#footer_address_2').html(data.address_ar);
          $('#footer_phone_1').html("TEL : "+data.mobile_number);
          $('#footer_phone_2').html("TEL : "+data.tel_number);

          $('#footer_email a').text(data.footer_email);
          $('#footer_company_name').html(data.full_company_name);

          $('#projects_count').text(data.projects_count);
          $('#clients_count').html(data.clients_count);

         
         
          
         }
        })
    }






    });