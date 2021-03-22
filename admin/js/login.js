// jshint esversion: 6
function toggleVisibility() {
	let passwordField = document.querySelector("input[name='password']");
	if (passwordField.type === "password") 
		passwordField.type = "text";
	else
		passwordField.type = "password";
}

let showPassword = document.getElementById("show-password");
showPassword.addEventListener("click", toggleVisibility, false);