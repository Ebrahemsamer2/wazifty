$(function() {

	// Job Form Validation
	$("#create-job").submit(function() {
		let title = $("#create-job #input-title").val();
		let subtitle = $("#create-job #input-subtitle").val();
		let job_description = $("#create-job #input-job-desc").val();
		let job_type = $("#create-job #input-job-type").val();
		let exp_from = $("#create-job #input-exp-from").val();
		let exp_to = $("#create-job #input-exp-to").val();
		let responsibility = $("#create-job #input-responsibility").val();
		let requirements = $("#create-job #input-requirements").val();
		let skills = $("#create-job #input-skills").val();
		let salary = $("#create-job #input-salary").val();
		let category_id = $("#create-job #input-category-id").val();

		if(title.length < 10 || title.length > 100) {
			$(".title-error").css("display", "block");
			return false;
		}
		if( subtitle.length > 0 && ( subtitle.length < 20 || subtitle.length > 200)){
			$(".subtitle-error").css("display", "block");
			return false;
		}
		if(job_description.length < 20 || job_description.length > 1000) {
			$(".job-description-error").css("display", "block");
			return false;
		}
		if(job_type.length <= 0) {
			$(".job-type-error").css("display", "block");
			return false;
		}
		if(exp_from == "") {
			console.log(exp_from);
			$(".job-exp-from-error").css("display", "block");
			return false;
		}
		if(exp_to == "" || exp_to <= exp_from) {
			console.log(exp_to);
			$(".job-exp-to-error").css("display", "block");
			return false;
		}
		if(responsibility.length < 20 || responsibility.length > 1000) {
			$(".job-responsibility-error").css("display", "block");
			return false;
		}
		if(requirements.length < 20 || requirements.length > 1000) {
			$(".job-requirements-error").css("display", "block");
			return false;
		}
		if(skills.length < 20 || skills.length > 1000) {
			$(".job-skills-error").css("display", "block");
			return false;
		}
		if(salary.length < 4 || salary.length > 50) {
			$(".job-salary-error").css("display", "block");
			return false;
		}
		if(category_id == "") {
			console.log(category_id);
			$(".job-category-id-error").css("display", "block");
			return false;
		}
		return true;
	});

});