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
				$("#contactForm div p.home-email-input").css("display", "none");
				$("#contactForm div p.home-message-input").css("display", "none");
			},
			fail:function(data) {
				$("#form_output").html(data.fail);
				$("#contactForm")[0].reset();
				$("#contactForm div p.home-email-input").css("display", "none");
				$("#contactForm div p.home-message-input").css("display", "none");
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

	$('.container + .alert-danger,.container + .alert-success').delay(3000).fadeOut(500, function() {
		$('.container + .alert-danger,.container + .alert-success').css('display', 'none');
	});


	//  Filter Form

	$("select[name='category']").on("change", function() {
		if($(this).val() != ""){
			if($("select[name='place']").val() == "") {
				window.open("/jobs/"+$(this).val(),"_top");
			}else {
				window.open("/"+$("select[name='place']").val()
					+"-jobs/"+$("select[name='category']").val(),"_top");
			}
		}else{
			if($("select[name='place']").val() != "") {
				window.open("/"+$("select[name='place']").val()+"-jobs","_top");
			}else {
				window.open("/jobs","_top");
			}
			
		}
	});
	$("select[name='place']").on("change", function() {
		if($(this).val() != ""){
			if($("select[name='category']").val() == "") {
				window.open("/"+$("select[name='place']").val()+"-jobs","_top");
			}else {
				window.open("/"+$("select[name='place']").val()
					+"-jobs/"+$("select[name='category']").val(),"_top");
			}
		}else {
			if($("select[name='category']").val() != "") {
				window.open("/jobs/"+$("select[name='category']").val(),"_top");
			}else{
				window.open("/jobs","_top");
			}	
		}

	});

});