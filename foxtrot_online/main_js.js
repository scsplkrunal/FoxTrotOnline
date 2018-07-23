$( document ).ready( function(){
	//Toggle sidebar
	$('.navbar-toggler').click(function () {
		var is_shown = $('.sidebar').attr('style');
		if(is_shown == undefined){
			$('.sidebar').attr('style','display:block !important');
		}else{
			$('.sidebar').removeAttr('style');
		}
	});
} );