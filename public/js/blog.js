$(function() {

	// Ajax call while Adding Category

	$("#postcategory-form").on("submit", function(e) {
		e.preventDefault();

		let data = $(this).serialize();
		$.ajax({
			url: "/admin/blog/categories",
			method: "POST",
			headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
			data: data,
			dataType: 'json',
			success: function(data) {
				$("div table tbody").prepend(data.success);
				$("#postcategory-form")[0].reset();
			}
		});
	});

	// Admin Post Validation

	$("#create-post").on("submit", function(e) {
		e.preventDefault();

		let title = $("#create-post input[name='title']").val();
		let excerpt = $("#create-post input[name='excerpt']").val();
		let body = $("#create-post #postcontent").val();
		let tags = $("#create-post input[name='tags']").val();
		let category_id = $("#create-post select[name='category_id']").val();

		if(title.length < 50 || title.length > 150) {
			$(".title-error").css("display", "block");
			return false;
		}
		if( excerpt.length != 0 && (excerpt.length < 100 || excerpt.length > 1000)) {
			$(".excerpt-error").css("display", "block");
			return false;
		}
		if(body.length < 500 || body.length > 10000) {
			$(".body-error").css("display", "block");
			return false;
		}
		if(tags.length !=0 && (tags.length < 4 || tags.length > 100)) {
			$(".tags-error").css("display", "block");
			return false;
		}
		if(category_id == 0) {
			$(".category-error").css("display", "block");
			return false;
		}
		return true;
	});

});