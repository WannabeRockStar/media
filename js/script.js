/*************** VALIDATION *****************/

function registerValidation() {
	$("#reg-form").on("submit", function() {
		var user = $("#user").val();
		var email = $("#email").val();
		var pass = $("#password").val();

		if(user < 1) {
			$(".user-err").text("User field is empty").addClass("reg-error");
			$("#user").css("border", "2px solid red");
			return false;
		} else {
			$(".user-err").text("");
			$("#user").css("border", "2px solid #ccc");
		}

		if(email < 1) {
			$(".email-err").text("Email field is empty").addClass("reg-error");
			$("#email").css("border", "2px solid red");
			return false;
		} else if(!email.match(/\S+@\S+\.\S+/)) {
			$(".email-err").text("Invalid email format").addClass("reg-error");
			$("#email").css("border", "2px solid red");
			return false;
		} else {
			$(".email-err").text("");
			$("#email").css("border", "2px solid #ccc");
		}

		if(pass < 1) {
			$(".pass-err").text("Password field is empty").addClass("reg-error");
			$("#password").css("border", "2px solid red");
			return false;
		} else if(pass.length < 4 || pass.length > 12) {
			$(".pass-err").text("Password must be between 4 and 12 characters").addClass("reg-error");
			$("#password").css("border", "2px solid red");
			return false;
		} else {
			$(".pass-err").text("");
			$("#password").css("border", "2px solid #ccc");
		}
	});
}

registerValidation();

function loginValidation() {
	$("#login-form").on("submit", function() {
		
		var logEmail = $("#login-email").val();
		var pass = $("#login-password").val();

		if(logEmail < 1) {
			$(".email-err").text("Email field is empty").addClass("reg-error");
			$("#login-email").css("border", "2px solid red");
			return false;
		} else if(!logEmail.match(/\S+@\S+\.\S+/)) {
			$(".email-err").text("Invalid email format").addClass("reg-error");
			$("#login-email").css("border", "2px solid red");
			return false;
		} else {
			$(".email-err").text("");
			$("#login-email").css("border", "2px solid #ccc");
		}

		if(pass < 1) {
			$(".pass-err").text("Password field is empty").addClass("reg-error");
			$("#login-password").css("border", "2px solid red");
			return false;
		} else if(pass.length < 4 || pass.length > 12) {
			$(".pass-err").text("Password must be between 4 and 12 characters").addClass("reg-error");
			$("#login-password").css("border", "2px solid red");
			return false;
		} else {
			$(".pass-err").text("");
			$("#login-password").css("border", "2px solid #ccc");
		}
	});
}

loginValidation();