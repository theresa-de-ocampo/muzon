// jshint esversion: 6
$("table").DataTable({
	responsive: true
});

var sectionId = "#";
var personId;
$("table").on("click", "tr", function() {
	let arr = setRow.call(this);
	let sectionId = arr[0];
	let personId = arr[1];
	$(sectionId + "-id").val(personId);
});

let path = "index.php";
let message = "You won't be able to edit your report after submission. Proceed?";