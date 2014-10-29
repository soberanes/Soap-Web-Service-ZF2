$(function(){
	console.log('ok');

	$('#ga_main').on('click', function(e){
		e.preventDefault();
	});

	$('#ga_config').on('click', function(e){
		e.preventDefault();

		var g_user_id  = $('#g_user').attr('data-user-id');
		var g_resource = $(this).attr('data-resource');

		$.ajax({
            type:"POST",
            // URL : / name of the controller for the site / name of the action to be                         
            //                                                 executed
            url:"google/config",
            data:'g_user_id='+g_user_id+'&g_resource='+g_resource,
            beforeSend: function(){
            	$('.right_panel').css({'opacity':'.5'});
				$('.spinner').show();
			},
            success: function(data){
				//The callback function, that is going to be executed 
				//after the server response. data is the data returned
				//from the server.

				// Show the returned text
				$("#g_content_panel").html(data);
				$("#text-profile").val(g_user_id);
				$(".resource_name").text(g_resource);

			},
			complete: function(){
				$('.spinner').hide();
				$('.right_panel').css({'opacity':'1'});
			}
        });
	});

	$('#ga_report').on('click', function(e){
		e.preventDefault();

		var g_user_id  = $('#g_user').attr('data-user-id');

		$.ajax({
            type:"POST",
            // URL : / name of the controller for the site / name of the action to be                         
            //                                                 executed
            url:"google/ga-report",
            data:'g_user_id='+g_user_id,
            beforeSend: function(){
            	$('.right_panel').css({'opacity':'.5'});
				$('.spinner').show();
			},
            success: function(data){
				//The callback function, that is going to be executed 
				//after the server response. data is the data returned
				//from the server.

				// Show the returned text
				$("#g_content_panel").html(data);

			},
			complete: function(){
				$('.spinner').hide();
				$('.right_panel').css({'opacity':'1'});
			}
        });
	});

});