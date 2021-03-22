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

let path = "home.php";
let confirmationMessage = "You won't be able to edit after publishing. Proceed?";
let errorMessage = "[ERROR] An officer can only hold one position per term.";