$('#ajax_form').submit(function(e)
{
	e.preventDefault();
	var form_data = new FormData($('#ajax_form')[0]);
	$.ajax(
	{
		type: 'post',
		url: 'ajax_php_demo.php',
		dataType: 'json',
		data: form_data,
		cache: false,
		contentType: false,
		processData: false,
	
	});
});