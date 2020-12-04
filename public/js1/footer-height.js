/*
-----------------------------------------------------------------------------
	FOOTER HEIGHT
-----------------------------------------------------------------------------
*/

$(document).ready(function() {
	contactHeight();
});

$(window).resize(function(){
	contactHeight();
});

function contactHeight(){
	if ($(window).width() > 991){
		var wh = $('footer').height() + 70;
		$('#contacts').css('min-height', wh);
	}
	
}