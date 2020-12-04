$(document).ready(function(){
	//Preloader
	$(window).load(function () {
		//Preloader
		setTimeout("$('footer').animate({'opacity' : '1'},500)",2000);
	
	});
	
	// Sticky Header
	$(window).scroll(function() {
		if ($(window).scrollTop() > 100) {		
			$('.top-header').hide();
			$('.sticky').show();
		} else {
			$('.top-header').show();
			$('.sticky').hide();
		}
	});
	
	// Hambuger color change
	$(window).scroll(function() {
		if ($(window).scrollTop() > 100) {		
			$('.mobile-toggle span ').css('background-color', '#fff');
		} else {
			$('.mobile-toggle span ').css('background-color', '#8f8f8f');
		}
	});
	
	// Mobile Navigation
	$('.mobile-toggle').click(function() {
		if ($('.top-header').hasClass('open-nav')) {
			$('.top-header').removeClass('open-nav');
		} else {
			$('.top-header').addClass('open-nav');
		}
	});
	
	$('.mobile-toggle').click(function() {
		if ($('.sticky').hasClass('open-nav')) {
			$('.sticky').removeClass('open-nav');
		} else {
			$('.sticky').addClass('open-nav');
		}
	});
	
	$('.main_header li a').click(function() {
		if ($('.main_header').hasClass('open-nav')) {
			$('.navigation').removeClass('open-nav');
			$('.main_header').removeClass('open-nav');
		}
	});
	
	// Hamburger Toggle
	$('.hamburger-toggle').click(function() {
			$('.main_header').addClass('sticky');
			$('.banner-logo').hide();
			$('.hamburger-toggle').hide();
	});
	
	// navigation scroll lijepo radi materem
	$('nav a').click(function(event) {
		var id = $(this).attr("href");
		var offset = 70;
		var target = $(id).offset().top - offset;
		$('html, body').animate({
			scrollTop: target
		}, 500);
		event.preventDefault();
	});
	
/*
-----------------------------------------------------------------------------
	FOOTER
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
});