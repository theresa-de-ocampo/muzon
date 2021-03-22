// jshint esversion: 6
if ($("h4").html() == "Muzon - Naic - Cavite") {
	$("#general").removeClass("center-to-viewport");
	$("#create-account").css("display", "block");
	$("#revoke-account").css("display", "block");
}

$("#officers-without-account-tbl").DataTable({
	responsive: true,
	order: []
});

$("#officers-with-account-tbl").DataTable({
	dom: "Bfrtip",
	responsive: true,
	buttons: [
		{
			text: "Clean",
			attr: {
				id: "clean-accounts"
			}
		}
	],
	order: []
});

$("#clean-accounts").on("click", function(e) {
	let ans = confirm("This action will delete all accounts of previous officers. Proceed?");
	if (ans)
		window.location.href = "src/clean-admin-tbl.php";
	else
		e.preventDefault();
});

$("#sign-out").on("click", function() {
	window.location.href = "src/sign-out.php";
});

var modal, modalID;
$("#change-password").on("click", function() {
	$(".error").remove();
	modalID = "#change-password-modal";
	modal = createModal();
	modal.open();
	$(modalID).css("display", "block");
});

$("#officers-without-account-tbl").on("click", ".fa-plus-square", function() {
	$(".error").remove();
	modalID = "#create-account-modal";
	modal = createModal();
	modal.open();
	$(modalID).css("display", "block");

	let $tr = $(this).closest("tr");
	if ($tr.hasClass("child"))
		$tr = $tr.prev();
	let data = $("#officers-without-account-tbl").DataTable().row($tr).data();

	$("#officer-id-create").val(data[0]);
	console.log($("#officer-id-create").val());
	$("#officer-name").val(data[2]);
});

function toggleVisibility(divID) {
	$passwords = $(divID + " .password");
	$password = $passwords.first();

	if ($password.attr("type") === "password")
		$passwords.attr("type", "html");
	else
		$passwords.attr("type", "password");
}

$("#show-passwords-on-update").on("click", function() {
	toggleVisibility("#change-password-modal");
});

$("#show-passwords-on-create").on("click", function() {
	toggleVisibility("#create-account-modal");
});

function checkPassword(e, divID) {
	let password = $(divID + " .password:eq(0)").val();
	let confirmPassword = $(divID + " .password:eq(1)").val();

	let flag = false;
	let regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@\-#\s$%^&*]{8,}$/;
	let validPassword = regex.test(password);
	let message;
	
	if (!password || !confirmPassword)
		message = "Please fill out all fields.";
	else if (!validPassword)
		message = "Password should be a minimum of 8 characters consisting of at least one uppercase letter, one lowercase letter, and a digit.";
	else
		if (password != confirmPassword)
			message = "Passwords do not match.";
		else {
			message = "";
			flag = true;
		}

	showErrorMessage(divID, message);

	if (!flag)
		e.preventDefault();
}

function checkEmail(e, divID) {
	let email = $("#admin-email").val();
	let flag = false;
	let regex = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	let validEmail = regex.test(email);

	if (!email)
		message = "Email is required!";
	else if (!validEmail)
		message = "Please enter a valid email!";
	else {
		message = "";
		flag = true;
	}

	showErrorMessage(divID, message);
	if (!flag)
		e.preventDefault();
	return flag;
}

function showErrorMessage(divID, message) {
	$(divID + " .error").remove();
	if (message) {
		let errorContainer = $("<p class='solo error'></p>").text(message);
		let errorIcon = $("<i class='fas fa-exclamation-circle'></i>");
		errorContainer.prepend(errorIcon);
		errorContainer.insertAfter($(divID + " .show-passwords-wrapper"));
	}
}

$("#change-password-modal form").on("submit", function(e) {
	checkPassword(e, "#change-password-modal");
});

$("#create-account-modal form").on("submit", function(e) {
	let flag = checkEmail(e, "#create-account-modal");
	if (flag)
		checkPassword(e, "#create-account-modal");
});

$("#officers-with-account-tbl").on("click", ".fa-minus-square", function(e) {
	let ans = confirm("Delete account?");
	if (ans) {
		let $tr = $(this).closest("tr");
		if ($tr.hasClass("child"))
			$tr = $tr.prev();
		let data = $("#officers-with-account-tbl").DataTable().row($tr).data();
		$("#officer-id-revoke").val(data[0]);
		$("#revoke-account form").submit();
	}
	else
		e.preventDefault();
});