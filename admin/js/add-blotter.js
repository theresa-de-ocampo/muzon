// jshint esversion: 6
var prevGuardianId;
var prevLocal;
var prevLocalId;
var prevOutsider;
var $nameHolder = $("#complainant p span");
var $localComplainantIdHolder = $("#complainant-resident-id");

$("#add-blotter table").DataTable({
	responsive: true
});

$("#add-blotter table").on("click", "tr", function() {
	let arr = setRow.call(this);
	let personId = arr[1];
	let tableId = arr[2];
	let data = arr[3];

	// If the table is for the complained resident, then
	// check if complained resident is a child in conflict with the law.
	let $guardianIdHolder = $("#guardian-complained-resident-id");
	if (tableId == "complained-tbl") {
		let age = parseInt(data[4]);
		let $guardianSection = $("#guardian");
		let $subject = $("#offense-subject");
		if (age < 18) {
			$guardianSection.css("display", "block");
			$subject.val("Youth Crime");
			$subject.attr("readonly", "");
			$guardianIdHolder.attr("required", "");
			$guardianIdHolder.val(prevGuardianId);
		}
		else {
			$guardianSection.css("display", "none");
			$subject.val("");
			$subject.removeAttr("readonly");
			$guardianIdHolder.removeAttr("required");
			$guardianIdHolder.val("");
		}
		$("#complained-resident-id").attr("value", personId);
	}
	else if (tableId == "guardian-tbl") {
		prevGuardianId = personId;
		$guardianIdHolder.val(personId);
	}
	else if (tableId == "complainant-tbl") {
		prevLocalId = personId;
		$localComplainantIdHolder.val(personId);
	}
});

$("#complainant-menu button").on("click", function() {
	let $button = $(this);
	let buttonName = $button.attr("name");
	
	$("#complainant-menu button").removeClass("selected");
	$button.addClass("selected");

	if (buttonName == "outsider") {
		$("#complainant div.local").css("display", "none");
		$("#complainant div.outer").css("display", "grid");
		$("#complainant .outer input").not("#province").attr("required", "");
		if (!prevOutsider) {
			$nameHolder.html("<i>(Enter complainant data.)</i>");
		}
		else {
			 $nameHolder.html(prevOutsider);
		}
		$localComplainantIdHolder.attr("type", "hidden");
		$localComplainantIdHolder.val("");
	}
	else {
		$("#complainant div.outer").css("display", "none");
		$("#complainant div.local").css("display", "block");
		$("#complainant input").removeAttr("required");
		if (!prevLocal)
			$nameHolder.html("<i>(Click on a row.)</i>");
		else
			$nameHolder.html(prevLocal);
		$localComplainantIdHolder.attr("type", "number");
		$localComplainantIdHolder.val(prevLocalId);
	}
});

$("#fname, #lname").on("keyup", function() {
	let fname = $("#fname").val();
	let lname = $("#lname").val();
	let name = fname + " " + lname;
	name = strToTitleCase(name);
	prevOutsider = "<b>" + name + "</b>";
	$nameHolder.html(prevOutsider);
});

$("#fname, #mname #lname").on("blur", inputToTitleCase);

let path = "blotter.php";
let confirmationMessage = "You won't be able to edit your report after submission. Proceed?";
let errorMessage = "[ERROR] An involved person can only hold one role (complained, complainant, or guardian).";