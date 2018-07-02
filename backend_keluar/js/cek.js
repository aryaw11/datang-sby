$('document').ready(function() {
	// select all checkbox	
	jQuery('#example-select-all').on('click', function(e) {
		if($(this).is(':checked',true)) {
			$(".emp_checkbox").prop('checked', true);  
		}  
		else {  
			$(".emp_checkbox").prop('checked',false);  
		}		
		// set all checked checkbox count
		$("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
	});
	// set particular checked checkbox count
	$(".emp_checkbox").on('click', function(e) {
		$("#select_count").html($("input.emp_checkbox:checked").length+" Selected");
	});	
	// delete selected records
});