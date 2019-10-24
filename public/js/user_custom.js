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


	
});