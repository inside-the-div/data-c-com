
	var  handler = {
		error: function(str,class_name) {
			return '<div class="rounded-0 alert alert-'+class_name+' alert-dismissible fade show" role="alert">'+str+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		},
		success: function(str) {
			return '<div class="rounded-0 alert alert-success alert-dismissible fade show" role="alert">'+str+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
		
	}
