/* Contact Form
 ***************************************************************************/
$(document).ready(function(){
	// validate signup form on keyup and submit
	var validator = $("#contactform").validate({
		errorClass:'error',
		validClass:'success',
		errorElement:'span',
		highlight: function (element, errorClass, validClass) { 
			$(element).parents("div[class='clearfix']").addClass(errorClass).removeClass(validClass);
		}, 
		unhighlight: function (element, errorClass, validClass) { 
			$(element).parents(".error").removeClass(errorClass).addClass(validClass); 
		},
		rules: {
			contactname: {
				required: true,
				minlength: 2
			},
			email: {
				required: true,
				email: true
			},
			weburl: {
				required: true,
				url: true
			},
			phone: {
				required: true,
				phoneUS: true
			},
			subject: {
				required: true
			},
			message: {
				required: true,
				minlength: 10
			}
		},
		messages: {
			contactname: {
				required: '<span class="help-inline">Please enter your name.</span>',
				minlength: jQuery.format('<span class="help-inline">Your name needs to be at least {0} characters.</span>')
			},
			email: {
				required: '<span class="help-inline">Please enter a valid email address.</span>',
				minlength: '<span class="help-inline">Please enter a valid email address.</span>'
			},
			weburl: {
				required: '<span class="help-inline">You need to enter the address to your website.</span>',
				url: jQuery.format('<span class="help-inline">You need to enter a valid URL.</span>')
			},
			phone: {
				required: '<span class="help-inline">You need to enter your phone number.</span>',
				phoneUS: jQuery.format('<span class="help-inline">You need to enter a valid phone number.</span>')
			},
			subject: {
				required: '<span class="help-inline">You need to enter a subject.</span>'
			},
			message: {
				required: '<span class="help-block">You need to enter a message.</span>',
				minlength: jQuery.format('<span class="help-block">Enter at least {0} characters.</span>')
			}
		}
	});
});
