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
				$("#form_output").html(data.success);
				$("#contactForm")[0].reset();		
			},

		});

	});	



	// Uploading User Picture

	$("#uplaodButton").click(function() {
		if($("#uplaodButton").text() === 'Update picture') {
			$("#uploadBox").trigger('click');
		}
	});

	$("#uploadBox").on('change', function() {
		$("#uplaodButton").text("Save picture");
		$("#uplaodButton").attr("class", "btn btn-success btn-sm");
	});

	$("#uplaodButton").click(function() {

		if($("#uplaodButton").text() === 'Save picture') {
			$(this).next("form").submit();
		}

	});

	// Hiding alert after 3 seconds 

	$('.container + .alert-danger,.container + .alert-success').delay(3000).fadeOut(500);

});