// jshint esversion: 6
$("#blotter-tbl").DataTable({
	dom: "Bfrtip",
	responsive: true,
	buttons: [
		{
			text: "Add",
			action: function() {
				window.location.href = "add-blotter.php";
			},
			attr: "add-blotter"
		},
		{
			extend: "print",
			exportOptions: {
				columns: [0, 1, 3, 4]
			}
		},
		{
			extend: "csv",
			exportOptions: {
				columns: [0, 1, 3, 4]
			}
		}
	]
});

var modal, modalID = "#settle-blotter-modal";
$("#blotter-tbl").on("click", ".fa-check-circle", function() {
	modal = createModal();
	modal.open();
	$("#settle-blotter-modal").css("display", "block");

	let $tr = $(this).closest("tr");
	if ($tr.hasClass("child"))
		$tr = $tr.prev();
	let data = $("#blotter-tbl").DataTable().row($tr).data();
	$("#blotter-id").val(data[0]);
	$("#complained-resident").val(data[1]);
});