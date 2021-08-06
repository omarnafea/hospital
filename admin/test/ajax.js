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







    $(document).on('submit', '#test_add_form', function(event){
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
            url:"insert_test.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                alert(data);
                $('#test_add_modal').modal('hide');
                $('#test_add_form')[0].reset();
                load_main_data();

            }
        });

    });


    $(document).on('click', '.update', function(){
        var test_id = $(this).attr("id");
        $.ajax({
            url:"fetch_single.php",
            method:"POST",
            data:{test_id:test_id},
            dataType:"json",
            success:function(data)
            {
                $('#test_edit_modal').modal('show');
                $('#test_edit_form #edit_test_name').val(data.name);
                $('#test_edit_form #edit_test_id').val(test_id);
                $('#test_edit_form #edit_test_price').val(data.price);
            }
        })
    });


    $(document).on('submit', '#test_edit_modal #test_edit_form', function(event){
        event.preventDefault();

        $.ajax({
            url:"update_test.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                alert(data);

                $('#test_edit_modal').modal('hide');
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