$(function() {
	$("#ms_link").on("click", function() {
		$("body").css({"overflow-y": "hidden"});
		$(".ms_form_block_main").addClass("ms_show_form");
		setTimeout(function() {

			$(".ms_form_block_main").addClass("ms_show_form_effect");

		}, 200);

	});
	$(".ms_overlay").on("click", function() {
		$(".ms_form_close").click();
	})
	$(".ms_form_block_body").on("click", function(e) {
		e.stopPropagation();
	})
	$(".ms_form_close").on("click", function() {

		$(".ms_form_block_main").removeClass("ms_show_form_effect");

		setTimeout(function() {

			$(".ms_form_block_main").removeClass("ms_show_form");
			$("body").css({"overflow-y": "auto"});

		}, 400);

	});

	$("#ms_form_sing_up").on("click", function() {
		$.ajax({

			url: "/engine/ajax/modal_sign_up/index.php",
			type: "post",

 			data: {

				"login": $("#ms_form_input_login").val(),
				"email": $("#ms_form_input_email").val(),
				"password": $("#ms_form_input_password").val(),
				"auth": $("#ms_form_checkbox").prop("checked"),

			}, beforeSend: function() {

				$(".ms_wait").show();

			}, success: function(data) {

				$(".ms_wait").hide();
				$("#ms_result").html(data);

				setTimeout(function() {

					$("#ms_result").html("");

				}, 7000);

			}, error: function() {

				$(".ms_wait").hide();

			}

		});

	});

});
const loginPane = document.querySelector('#login_pane')

const registerToggle = document.querySelector('#register-toggle')
if (registerToggle){
	registerToggle.addEventListener('click', (e) => {
		document.querySelector('#ms_link').click()
		loginPane.click()
		e.preventDefault()
	})
}
if (loginPane)
	loginPane.addEventListener('click', showLoginForm)


function showLoginForm(){
	loginPane.classList.toggle('visible_login_form')
}