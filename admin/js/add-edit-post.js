// jshint esversion: 6
let $form = $("form");
let origForm = $form.serialize();
$("#edit-featured-photo").removeAttr("required");

$("button[type='reset'], main > a").on("click", function(e) {
	let path = "posts.php";
	let flag, message;
	let $photo_prompt = $("#photo-wrapper > p");
	if ($photo_prompt.text().indexOf("Change") >= 0) {
		let origSrc = "../public/img/posts/" + $("#orig-image").text();
		flag = (origForm != $form.serialize()) || ($("#actual-photo").attr("src").trim() != origSrc.trim());
		message = "You haven't saved your changes yet.";
	}
	else {
		flag = hasValue($form);
		message = "You haven't saved your inputs yet.";
	}

	if (flag) {
		let ans = confirm(message);
		if (ans)
			window.location.href = path;
		else
			e.preventDefault();
	}
	else
		window.location.href = path;
});

$("#photo-wrapper").on("click", function() {
	$("#insert-featured-photo, #edit-featured-photo").trigger("click");
});

$("#insert-featured-photo, #edit-featured-photo").change(function(e) {
	for (let i = 0; i < e.originalEvent.srcElement.files.length; i++) {
		let file = e.originalEvent.srcElement.files[i];
		let img = document.getElementById("actual-photo");
		let reader = new FileReader();
		reader.onloadend = function() {
			 img.src = reader.result;
		};
		reader.readAsDataURL(file);
	}
});