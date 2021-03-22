// jshint esversion: 6
$("#resident-tbl").DataTable({
	dom: "Bfrtip",
	responsive: true,
	buttons: [
		{
			text: "Add",
			action: add_resident_modal,
			attr: {
				id: "add-resident"
			}
		},
		{
			extend: "print",
			exportOptions: {
				columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
			}
		},
		{
			extend: "csv",
			exportOptions: {
				columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
			}
		}
	],
	columnDefs: [
		{
			targets: [5],
			width: 100
		}
	]
});

$("#household-tbl").DataTable({
	dom: "Bfrtip",
	responsive: true,
	buttons: [
		{
			extend: "print",
			exportOptions: {
				columns: [0, 1]
			}
		},
		{
			extend: "csv",
			exportOptions: {
				columns: [0, 1]
			}
		}
	],
	order: []
});

var modal, modalID = "#resident-modal";
function add_resident_modal() {
	resident_modal("src/insert-resident.php", "add", $("<h3>Add a Resident</h3>"));
	modal = createModal();
	modal.open();
	$("#fname").focus();
}

$("#resident-tbl").on("click", ".fa-user-edit", function() {
	function formatDate(date) {
		let d = new Date(date);
		let month = '' + (d.getMonth() + 1);
		let day = '' + d.getDate();
		let year = d.getFullYear();

		if (month.length < 2) 
			month = '0' + month;
		if (day.length < 2) 
			day = '0' + day;

		return [year, month, day].join('-');
	}

	resident_modal("src/edit-resident.php", "edit", $("<h3>Edit a Resident Record</h3>"));
	let $tr = $(this).closest("tr");
	if ($tr.hasClass("child"))
		$tr = $tr.prev();

	let data = $("#resident-tbl").DataTable().row($tr).data();
	let i = 1;
	$("#resident-modal form :input").not("#resident-id, #modal-cancel, #modal-ok").each(function() {
		$(this).val(data[i++]);
	});

	const BDAY_POS = 5;
	let bday = formatDate(data[BDAY_POS]);
	$("#bday").val(bday);

	modal = createModal();
	modal.open();

	
	$("#modal-ok").unbind("click").bind("click", function(e) {
		if (origForm == $form.serialize()) {
			e.preventDefault();
			alert("No data were changed!");
		}
		else
			$("#resident-id").attr("value", data[0]);
	});
});

function resident_modal(handler, name, header) {
	$("#resident-modal").css("display", "block");
	$form.attr("action", handler);
	$header = $(".modal h3");
	if ($header.length)
		$header.remove();
	$form.before(header);

	let $submitButton = $("#modal-ok");
	$submitButton.attr("name", name);

	if (name === "edit")
		$submitButton.html("Update");
	else
		$submitButton.html("Add");
}

function handleBdayAge() {
	let $bday = $("#bday");
	let $age = $('#age');

	$bday.on("keypress", function(e) {
		e.preventDefault();
	});

	$bday.on("blur", function() {
		let bday = new Date($bday.val());
		let today = new Date();
		let age = Math.floor((today - bday) / (365.25 * 24 * 60 * 60 * 1000));
		$age.val(age);
	});
}
handleBdayAge();

$("#resident-tbl").on("click", ".fa-user-minus", function() {
	let $tr = $(this).closest("tr");
	if ($tr.hasClass("child"))
		$tr = $tr.prev();

	let data = $("#resident-tbl").DataTable().row($tr).data();
	$("#resident-id-to-be-archived").val(data[0]);
	let ans = confirm("Archive resident?");
	if (ans)
		$("#archive-resident").submit();
});

$("#household-tbl").on("click", ".fa-copy", function() {
	let $tr = $(this).closest("tr");
	if ($tr.hasClass("child"))
		$tr = $tr.prev();
	let data = $("#household-tbl").DataTable().row($tr).data();
	let address = data[0] + " " + data[1];

	/*
		Selecting text only works in elements that can have text input.
		Hence, a temporary element (dummyTextInput) was created to hold the address, and copy it from there.
	*/
	let dummyTextInput = document.createElement("input");
	dummyTextInput.setAttribute('type', 'text');
	dummyTextInput.value = address;
	document.body.appendChild(dummyTextInput);
	dummyTextInput.select();
	document.execCommand("copy");
	document.body.removeChild(dummyTextInput);
});

$("#fname, #mname, #lname, #citizenship").on("blur", inputToTitleCase);