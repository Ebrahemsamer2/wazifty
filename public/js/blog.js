$(function() {

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



});