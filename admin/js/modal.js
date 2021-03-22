// jshint esversion: 6
let $form = $(modalID + " form");
let origForm;

function createModal() {
	let $modal = $(modalID);
	let $window = $(window);
	let $close = $(modalID + " button[type='reset']");

	function overlayOn() {
		$modal.css("display", "block");
		$(".overlay").css("display", "block");
	}

	function overlayOff() {
		$modal.css("display", "none");
		$(".overlay").css("display", "none");
	}

	function confirmOnCancel(flag, e) {
		if (flag) {
			let ans = confirm("You haven't saved your inputs yet.");
			if (ans)
				modal.close();
			else {
				e.preventDefault();
			}
		}
		else
			modal.close();
	}

	function beforeClosing() {
		origForm = $form.serialize();

		$close.unbind("click").bind("click", function(e) {
			let flag;
			let header = $("h3").html();

			// [EDIT] If changes were made.
			if (header.indexOf("Edit") >= 0) {
				flag = origForm != $form.serialize();
				confirmOnCancel(flag, e);
			}

			// [ADD, SUBMIT] If inputs were placed.
			else {
				flag = hasValue($("form"));
				confirmOnCancel(flag, e);
			}
		});
	}

	return {
		center: function() {
			// Calculate distance from top and left of window to center the modal.
			let top = Math.max($window.height() - $modal.outerHeight(), 0) / 2;
			let left = Math.max($window.width() - $modal.outerWidth(), 0) / 2;
			$modal.css({
				top: top,
				left: left
			});
		},
		open: function() {
			modal.center();
			$window.on("resize", modal.center);
			overlayOn();
			beforeClosing();
		},
		close: function() {
			$modal.css("display", "none");
			$window.off("resize", modal.center);	// Remove event handler
			overlayOff();
		}
	};
}