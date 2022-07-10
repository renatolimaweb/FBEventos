(function($) { 
	"use strict";
	
	/* ==============================================
	Browser detact 
	=============================================== */	
	$.browser.chrome = $.browser.webkit && !!window.chrome;
	$.browser.safari = $.browser.webkit && !window.chrome;

	var	mobileTest;
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		mobileTest = true;
		$('body').addClass('mobile');
	}else {
        mobileTest = false;
        $("body").addClass("no-mobile");
    }	
	if ($.browser.chrome) {
		$('body').addClass('chrome');		
	}	
	if ($.browser.safari) {
		$('body').addClass('safari');
	}	
	if( $('body').hasClass('safari') ) {
		//setting for safari
	}
	/* ==============================================
	window on load  
	=============================================== */	
	$(window).load(function(){
                
        $(window).trigger("scroll");
        $(window).trigger("resize");
        
		// Preloader
		$("#status").fadeOut();
		$("#preloader").delay(350).fadeOut("slow");
    });	
	
	/* ==============================================
	document ready fucntion
	=============================================== */	
	 $(document).ready(function(){  
		
		//fullscreen
		js_hight_fullscreen();
		
		
		
		$("nav a").on('click', function () {		
			var index = $('nav a').index(this);
			$('.main-column').children().hide().eq(index).fadeIn(500);
			$('.main-column').children().eq(index).addClass('magictime puffIn');
		});
		// Show home panel 
		$(".logo").on('click', function () {	
			$('.contact-panel').hide();
			$('.about-panel').hide();
			$('.home-panel').fadeIn();
		});
		
		
	
		// Slider
		$("#owl-slider").owlCarousel({
			navigation: true,
			pagination: true,
			items: 2,
			itemsDesktop: [1199, 2],
            itemsTabletSmall: [768, 2],
            itemsMobile: [480, 1],
			navigationText: false
		});
		
		// Subscribe
		$("#subscribe-submit").on('click', function () {			
			$('.subscribe-error-field').hide();

			var emailReg = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
			var emailVal = $('#subscribe-email').val();

			if (emailVal == "" || emailVal == "Email Address *") {
				$('.subscribe-error-field').html('<i class="fa fa-exclamation"></i>Your email address is required.').fadeIn();
				return false;

			} else if (!emailReg.test(emailVal)) {
				$('.subscribe-error-field').html('<i class="fa fa-exclamation"></i>Invalid email address.').fadeIn();
				return false;
			}

			var data_string = $('.subscribe-form').serialize();

			$('.btn-subscribe').hide();
			$('#subscribe-loading').fadeIn();
			$('.subscribe-error-field').fadeOut();

			$.ajax({
				type: "POST",
				url: "subscribe.php",
				data: data_string,

				//success
				success: function (data) {
					$('.subscribe-empty').hide();
					$('.subscribe-message').html('<i class="fa fa-check contact-success"></i><div>Thank you! You have been subscribed.<div>').fadeIn();
				},
				error: function (data) {
					$('.subscribe-empty').hide();
					$('.subscribe-message').html('<i class="fa fa-exclamation contact-error"></i><div>Something went wrong, please try again later.<div>').fadeIn();
				}

			}) //end ajax call
			return false;
		});
		
		// Subscribe
		$("#subscribe-submit2").on('click', function () {	
			$('.subscribe-error-field2').hide();

			var emailReg = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
			var emailVal = $('#subscribe-email2').val();

			if (emailVal == "" || emailVal == "Email Address *") {
				$('.subscribe-error-field2').html('<i class="fa fa-exclamation"></i>Your email address is required.').fadeIn();
				return false;

			} else if (!emailReg.test(emailVal)) {
				$('.subscribe-error-field2').html('<i class="fa fa-exclamation"></i>Invalid email address.').fadeIn();
				return false;
			}

			var data_string = $('.subscribe-form2').serialize();

			$('.btn-subscribe2').hide();
			$('#subscribe-loading2').fadeIn();
			$('.subscribe-error-field2').fadeOut();

			$.ajax({
				type: "POST",
				url: "subscribe2.php",
				data: data_string,

				//success
				success: function (data) {
					$('.subscribe-empty2').hide();
					$('.subscribe-message2').html('<i class="fa fa-check contact-success"></i><div>Thank you! You have been subscribed.<div>').fadeIn();
				},
				error: function (data) {
					$('.subscribe-empty2').hide();
					$('.subscribe-message2').html('<i class="fa fa-exclamation contact-error"></i><div>Something went wrong, please try again later.<div>').fadeIn();
				}

			}) //end ajax call
			return false;
		});

		
		// Toggle nav		
		$(".nav-container").hover(function () {
			$("nav").stop().fadeIn('slow');
			$('.nav-handle').addClass('active');
		}, function () {
			$("nav").fadeOut('slow');
			$('.nav-handle').removeClass('active');
		});
		$(".nav-container").on('click', '.nav-handle', function () {
			$("nav").fadeToggle('slow');
			$(".nav-handle").toggleClass('active');
		});
		
		// Show/hide page content on click
		$(".main-column").each(function () {
			$(this).find("section:lt(1)").show().fadeIn(500);
		});
		
		 // Contact
		$("#contact-submit").on('click', function () {	 
			$('.contact-error-field').hide();

			var nameVal = $('input[name=name]').val();
			var emailReg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/igm;
			var emailVal = $('#contact-email').val();
			var messageVal = $('textarea[name=message]').val();

			//validate

			if (nameVal == '' || nameVal == 'Name *') {
				$('.contact-error-field').html('<i class="fa fa-exclamation"></i>Your name is required.').fadeIn();
				return false;
			}
			if (emailVal == "" || emailVal == "Email Address *") {

				$('.contact-error-field').html('<i class="fa fa-exclamation"></i>Your email address is required.').fadeIn();
				return false;

			} else if (!emailReg.test(emailVal)) {

				$('.contact-error-field').html('<i class="fa fa-exclamation"></i>Invalid email address.').fadeIn();
				return false;
			}
			if (messageVal == '' || messageVal == 'Message *') {
				$('.contact-error-field').html('<i class="fa fa-exclamation"></i>Please provide a message.').fadeIn();
				return false;
			}

			var data_string = $('.contact-form').serialize();

			$('.btn-contact').hide();
			$('#contact-loading').fadeIn();
			$('.contact-error-field').fadeOut();

			$.ajax({
				type: "POST",
				url: "email.php",
				data: data_string,

				//success
				success: function (data) {

					$('.contact-empty').hide();
					$('.contact-message').html('<i class="fa fa-check contact-success"></i><div>Your message has been sent.</div>').fadeIn();
				},
				error: function (data) {

					$('.contact-empty').hide();
					$('.contact-message').html('<i class="fa fa-exclamation contact-error"></i><div>Something went wrong, please try again later.</div>').fadeIn();
				}

			}) //end ajax call
			return false;
		});

	
	 });	
	 
	 /* ==============================================
	window resize fucntion
	=============================================== */	
    $(window).resize(function(){   
		js_hight_fullscreen();
	});	
	
	function js_hight_fullscreen(){
		(function($){
			//var windowheight = jQuery(window).height();
			//if(windowheight < 500){
			//	 $('#countdown_dashboard').removeClass('cbox');
			//}
			$(".fullheight").height($(window).height());	
		})(jQuery);
	}
	
})(jQuery); 

// Countdown
(function ($) {	
    $('#countdown_dashboard').countDown({
        targetDate: {
            'day': 30,
            'month': 10,
            'year': 2016,
            'hour': 0,
            'min': 0,
            'sec': 0
        },
        omitWeeks: true
    });

})(jQuery);



