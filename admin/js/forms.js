// jshint esversion: 6
function inputToTitleCase(){
	this.value = this.value.replace(
		/\w\S*/g,
		function(text) {
			return text.charAt(0).toUpperCase() + text.substr(1).toLowerCase();
		}
	);
}

function strToTitleCase(str) {
	str = str.toLowerCase();
	return str.replace(/(?:^|\s)\w/g, function(match) {
		return match.toUpperCase();
	});
}	

// Checks if at least one of the form elements has a value given by the user.
function hasValue(form) {
	let selections = form.find(":checkbox, :radio").not(".show-passwords");
	let inputs = form.find(":input").not(selections).not("[type='submit'], [type='button'], [type='reset'], [type='search'], [type='hidden'], .dataTables_length select, .default, :disabled, .show-passwords"); 

	let checked = selections.filter(":checked");
	let filled = inputs.filter(function() {
		return $.trim($(this).val()).length > 0;
	});

	if (checked.length + filled.length === 0)
		return false;
	return true;
}