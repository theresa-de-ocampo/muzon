// jshint esversion: 6
function setRow() {
	let $tr = $(this);
	if ($tr.hasClass("child"))
		$tr = $tr.prev();
	let $table = $tr.closest("table");
	let data = $table.DataTable().row($tr).data();
	let personId = data[0];
	let person = "<b>" + data[1] + " " + data[3] + "</b>";
	if ($table.attr("id") == "complainant-tbl")
        prevLocal = person;

	let sectionId = "#";
	let tableId = $table.attr("id");
	sectionId += tableId.replace("-tbl", "");
	$(sectionId + " span.name-holder").html(person);
	$(sectionId + " tr").removeClass("selected");
	$tr.addClass("selected");
	let arr = [sectionId, personId, tableId, data];
	return arr;
}

$("button[type='reset'], main > a").on("click", function(e) {
	if (hasValue($("form"))) {
		let ans = confirm("You haven't saved your inputs yet.");
		if (ans)
			window.location.href = path;
		else
			e.preventDefault();
	}
	else
		window.location.href = path;
});

function checkIfArrayIsUnique(myArray) {
	return myArray.length === new Set(myArray).size;
}

$("main form").on("submit", function(e) {
	let residentIds = [];
	$("form section p > input").each(function(i, el) {
		residentIds[i] = el.value;
	});

	residentIds = residentIds.filter(item => item);
	if (checkIfArrayIsUnique(residentIds)) {
		let ans = confirm(confirmationMessage);
		if (!ans)
			e.preventDefault();
	}
	else {
		alert(errorMessage);
		e.preventDefault();
	}
});