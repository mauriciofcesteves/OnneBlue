$(document).ready(function() {

	$('input, textarea').keyup(function(e) {
		var code = e.which;
		var value = $(this).val();
		var name = $(this).attr('draft');
		if (value != '' && code != 13) {
			$.post( 'set_draft', { name : name, value : value });
		}
	});

	$('select, .date, input').change(function() {
		var value = $(this).val();
		var name = $(this).attr('draft');
		if (value != '' || value != ' ') {
			$.post( 'set_draft', { name : name, value : value });
		}
	});

	$('input:radio').click(function() {
		var value = $(this).val();
		var name = $(this).attr('draft');
		if (value != '') {
			$.post( 'set_draft', { name : name, value : value });
		}
	});

});