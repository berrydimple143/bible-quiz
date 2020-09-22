$(document).ready(function() {	
    $("#contact-form").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 60
            },
            email: {
                required: true,
                maxlength: 150,
                email: true
            },
            message: {
                required: true,
                maxlength: 2000
            }
        }
    });
    $("#registration-form, #payment-form").validate({
        rules: {
            firstname: {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            lastname: {
                required: true,
                minlength: 2,
                maxlength: 50
            },
            email: {
                required: true,
                maxlength: 50,
                email: true
            },
            password: {
                required: true,
                minlength: 3,
                maxlength: 30
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        }
    });
    $("#creditcard-form").validate({
        rules: {
            cvv: {
                required: true,
                minlength: 1,
                maxlength: 20
            },
            cardno: {
                required: true,
                minlength: 1,
                maxlength: 30
            }
        }
    });
    $("#clear-cf").click(function() {
		$("#name").val("");
		$("#email").val("");
		$("#phone").val("");
		$("#message").val("");
	});
});