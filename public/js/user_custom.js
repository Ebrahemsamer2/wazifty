$(function() {

	// Search input

	$(".fa-search").click(function() {
		$(".search-form").fadeToggle(300, function() {
			$(".search-form form input").focus();
		});
	});

	$("body").click(function(e) {
		var tagName = e.target.tagName;
		if(tagName !== "I" && tagName !== "INPUT" && tagName !== "FORM"){
			$(".search-form").fadeOut(300);
		}
	});

		

	// Contact Form Validation

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$("#contactForm").submit(function(evt) {

		evt.preventDefault();

		let email = $("#contactForm div #email").val();
		let msg = $("#contactForm div #message").val();

		if(email.length < 10) {
			$("#contactForm div p.home-email-input").css("display", "block");
			return false;
		}
		if(msg.length < 10 || msg.length > 500) {
			$("#contactForm div p.home-message-input").css("display", "block");
			return false;
		}
		
		// Insert By Ajax

		let form_data = $(this).serialize();
		console.log(form_data);
		$.ajax({
			method: 'POST',
			url: "/",
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			data: form_data,
			dataType: 'json',
			success: function(data) {
				if(data.error.length > 0) {
					let errors = "";
					for(let i = 0; i < data.error.length; i++) {
						errors += "<div class='alert alert-danger'>"+data.error[i]+"</div>";
					}
					$("#form_output").html($errors);
				}else {

					$("#form_output").html(data.success);
					$("#contactForm")[0].reset();
				}
			},

		});

	});	

});