// jshint esversion: 6
$("table:not(#archived-residents-tbl)").DataTable({
	dom: "Bfrtip",
	responsive: true,
	buttons: [
		{
			extend: "print"
		},
		{
			extend: 'csv'
		}
	],
	order: []
});

$("#archived-residents-tbl").DataTable({
	dom: "Bfrtip",
	responsive: true,
	buttons: [
		{
			extend: "print",
			exportOptions: [0, 1, 2, 3, 4, 5, 6]
		},
		{
			extend: 'csv',
			exportOptions: [0, 1, 2, 3, 4, 5, 6]
		}
	],
	order: []
});

$("#archived-residents-tbl").on("click", ".fa-trash-restore", function() {
	let $tr = $(this).closest("tr");
	if ($tr.hasClass("child"))
		$tr = $tr.prev();

	let data = $("#archived-residents-tbl").DataTable().row($tr).data();
	$("#resident-id-to-be-restored").val(data[0]);
	let ans = confirm("Restore resident record?");
	if (ans)
		$("#restore-resident").submit();
});