// jshint esversion: 6
$("#curr-officers-tbl").DataTable({
	dom: "Bfrtip",
	responsive: true,
	buttons: [
		{
			text: "New Cycle",
			action: function() {
				window.location.href = "new-cycle.php";
			},
			attr: {
				id: "new-cycle"
			}
		},
		{
			extend: "print",
			exportOptions: {
				columns: [1, 2]
			}
		},
		{
			extend: "csv",
			exportOptions: {
				columns: [1, 2]
			}
		}
	],
	order: []
});

$("#curr-officers-tbl").on("click", ".fa-user-slash", function() {
	let $tr = $(this).closest("tr");
	if ($tr.hasClass("child"))
		$tr = $tr.prev();
	let data = $("#curr-officers-tbl").DataTable().row($tr).data();
	$("#officer-id").val(data[0]);
	$("#officer-position").val(data[1]);
	$("#officer-name").val(data[2]);
	$("form[name='terminate-officer']").submit();
});