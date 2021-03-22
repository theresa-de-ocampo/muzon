$("table").DataTable({
	dom: "Bfrtip",
	responsive: true,
	buttons: [
		{
			text: "Add",
			action: function() {
				window.location.href = "add-edit-post.php?event=insert";
			},
			attr: {
				id: "add-post"
			}
		},
		{
			extend: "print",
			exportOptions: {
				columns: [0, 1, 3]
			}
		},
		{
			extend: 'csv',
			exportOptions: {
				columns: [0, 1, 3]
			}
		}
	],
	order: []
});