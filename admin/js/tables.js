// jshint esversion: 6
$("table").on("page.dt", function() {
	let id = $(this).attr("id");
	let tableWrapper = "#" + id + "_wrapper.dataTables_wrapper";
	$("html, body").animate({
		scrollTop: $(tableWrapper).parent().offset().top
	}, "slow");
});