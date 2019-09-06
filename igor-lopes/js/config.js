$(document).ready(function () {
	$('form').submit(function(event) {
		var valid = true;

		if (!$.trim($('#name').val())) {
			$('#name').addClass('is-invalid');
			valid = false;
		}

		if (!$('input[name="sex"]:checked').length) {
			$('input[name="sex"]').addClass('is-invalid');
			valid = false;
		}

		if (valid) {
			$("#loading").removeClass('d-none');
			$("button[type='submit']").blur();
		}

		return valid;
	});
});