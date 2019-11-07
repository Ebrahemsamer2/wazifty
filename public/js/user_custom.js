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


	//  Job Filter Form

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


	
	function hideModal() {
		$('#addquestion').modal('toggle');
	}

	// Job Form Validation
	$("#newjobform").submit(function() {
		let title = $("#newjobform #input-title").val();
		let subtitle = $("#newjobform #input-subtitle").val();
		let job_description = $("#newjobform #input-job-desc").val();
		let job_type = $("#newjobform #input-job-type").val();
		let exp_from = $("#newjobform #input-exp-from").val();
		let exp_to = $("#newjobform #input-exp-to").val();
		let responsibility = $("#newjobform #input-responsibility").val();
		let requirements = $("#newjobform #input-requirements").val();
		let skills = $("#newjobform #input-skills").val();
		let salary = $("#newjobform #input-salary").val();
		let work_place = $("#newjobform #input-work-place").val();
		let category_id = $("#newjobform #input-category-id").val();

		if(title.length < 20 || title.length > 100) {
			$(".title-error").css("display", "block");
			hideModal();
			return false;
		}
		if( subtitle.length > 0 && ( subtitle.length < 20 || subtitle.length > 200)){
			$(".subtitle-error").css("display", "block");
			hideModal();
			return false;
		}
		if(job_description.length < 20 || job_description.length > 1000) {
			$(".job-description-error").css("display", "block");
			hideModal();
			return false;
		}
		if(job_type.length <= 0) {
			$(".job-type-error").css("display", "block");
			hideModal();
			return false;
		}
		if(exp_from == "") {
			$(".job-exp-from-error").css("display", "block");
			hideModal();
			return false;
		}
		if(exp_to == "" || exp_to <= exp_from) {
			$(".job-exp-to-error").css("display", "block");
			hideModal();
			return false;
		}
		if(responsibility.length < 20 || responsibility.length > 1000) {
			$(".job-responsibility-error").css("display", "block");
			hideModal();
			return false;
		}
		if(requirements.length < 20 || requirements.length > 1000) {
			$(".job-requirements-error").css("display", "block");
			hideModal();
			return false;
		}
		if(skills.length < 20 || skills.length > 1000) {
			$(".job-skills-error").css("display", "block");
			hideModal();
			return false;
		}
		if(salary.length < 4 || salary.length > 50) {
			$(".job-salary-error").css("display", "block");
			hideModal();
			return false;
		}
		if(work_place.length < 4 || work_place.length > 50) {
			$(".job-work-place-error").css("display", "block");
			hideModal();
			return false;
		}
		if(category_id == "") {
			$(".job-category-id-error").css("display", "block");
			hideModal();
			return false;
		}
		
		$("#save-job").trigger("click");
		return true;

	});

	// Question Form submition and validation

	$("#questionsFormButton").click(function() {
		$("#questionsForm").trigger('submit');
	});

	$("#questionsForm").submit(function() {
			
		let question1 = $("#question1").val();
		if(question1) {
			if(question1.length < 20 || question1.length > 200){
				$(".question-error1").css("display", "block");
				return false;
			} else {
				$("#question1").attr('name','question1');
			}
		}
		let i = $("#questionsForm input")[1].id.split('question')[1];

		while(i <= 5) {
			if( $("#question"+i).val().length > 0 && ( $("#question"+i).val().length < 20 || $("#question"+i).val().length > 200) ){
				$(".question-error"+i).css("display", "block");
				return false;
			}else {
				if($("#question"+i).val().length != 0) {
					$("#question"+i).attr('name','question'+i);
				}
			}
			i++;
		}
		return true;
	});



	// Sending message using ajax call

	$("#messageForm").on('submit', function(e) {

		e.preventDefault();

		let userid = $("#messageForm input[name='userid']").val();
		let data = $(this).serialize();
		$.ajax({
			url:"/user/"+userid+"/contact",
			method: "POST",
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			data: data,
			dataType: 'json',
			success: function(data) {
				$("#output").html(data.success);
				$("#messageForm")[0].reset();
				$('#output').delay(3000).fadeOut(500, function() {
					$('#output').css('display', 'none');
				});
			},
		});
	});


});