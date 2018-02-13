/*
[Table of contents]

1. Preloader script
2. Main Menu for Single page
3. single page Main Menu add Class to current Menu's Target Section
4. Create Fixed on page scroll
5. Elements Animation on page scroll
6. Mixitup Filter Tabs
7. Carousel Script
8. Magnific Popup
9. Contact Form Script
*/



jQuery(function($){
	"use strict";

	/*** Preloader script
	----------------------------------------------------------------------------- ****/
	
	$(window).load(function() { // makes sure the whole site is loaded
		$('#status').fadeOut(); // will first fade out the loading animation
		$('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
		$('body').delay(350).css({'overflow':'visible'});
	});
	

	/*** Main Menu for Single page
	----------------------------------------------------------------------------- ****/

	function singlePageMenu(){
		$('.navbar').each(function(){

				var $active, $content, $links = $(this).find('a.on'),
				$li = $(this).find('a').closest('li');
			
				$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
				$content = $($active.attr('href'));
			
				$(this).on('click', 'a', function(e){
		
					$li.removeClass('active');
			
					$active = $(this);
					$content = $($(this).attr('href'));
	
					$(this).closest('li').addClass('active');
					$("body,html").animate({scrollTop:$content.position().top + 1}, 1000);
					
					e.preventDefault();
				});
		});
	}


	/*** single page Main Menu add Class to current Menu's Target Section
	----------------------------------------------------------------------------- ****/	

	function activeMainMenuItem(){
		
		var scrollPos = $(document).scrollTop();
		
		$('.navbar a.on').each(function () {

			var currLink = $(this);
			var refElement = $(currLink.attr("href"));
			var	$li = currLink.closest('li');
			
			if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
				$('.navbar > li').removeClass("active");
				$li.addClass("active");
			}
			else{
				$li.removeClass("active");
			}
		});
	}		
	
	singlePageMenu();

	/**** Create Fixed on page scroll
	----------------------------------------------------------------------------- ****/
	
	function scrolledHeader(){

		var headerHT = $('.navbar').height();
		
		if ( $('.fullscreen-container').length){
			
			var sliderHT = $('.fullscreen-container').height();
			
			if ( $(document).scrollTop() > sliderHT){

				$('.navbar').addClass('nav-sticky');

			}
			else {
				$('.navbar').removeClass('nav-sticky');
			}
		}

		else { 
			if ( $(document).scrollTop() > headerHT){
				$('.navbar').addClass('nav-sticky');
			}
			else {
				$('.navbar').removeClass('nav-sticky');
			}
		}
		
	}

	scrolledHeader();
	activeMainMenuItem();
	
	$(window).scroll( function(){
		activeMainMenuItem();
		scrolledHeader();
	});
	
	/*** Elements Animation on page scroll
	----------------------------------------------------------------------------- ****/
	
	if ( $('.animated').length ){
	$('.animated').appear(function(){
		var el = $(this);
		var anim = el.data('animation');
		var animDelay = el.data('delay');
		if (animDelay) {

			setTimeout(function(){
				el.addClass( anim + " in" );
				el.removeClass('out');
			}, animDelay);

		}

		else {
			el.addClass( anim + " in" );
			el.removeClass('out');
		}    
		},{accY: -150});			
	}

	/*** Mixitup Filter Tabs
	----------------------------------------------------------------------------- ****/
	
	if ( $('.filter-list').length) {
		$('.filter-list').mixitup();
	}

	/*** Carousel Script 
	----------------------------------------------------------------------------- ****/
	
	var blogSlide = $(".blog-slider");

	blogSlide.owlCarousel({
		autoPlay: 5000,
		transitionStyle : 'backSlide',
		itemsCustom : [
			[0, 1],
			[450, 1],
			[600, 2],
			[700, 2],
			[1000, 3],
			[1200, 3]
		],
		navigation : true,
		pagination: false,
		afterInit : function(elem){
			var that = this;
			that.owlControls.prependTo(elem);
		}
	});

	var clSlide = $(".client-slider");

	clSlide.owlCarousel({
		autoPlay: 3000,
		itemsCustom : [
			[0, 1],
			[450, 1],
			[600, 2],
			[700, 3],
			[1000, 4],
			[1200, 4]
		],
		navigation : false
	});

	/**** Magnific Popup
	----------------------------------------------------------------------------- ****/
	
	$('.image-popup').magnificPopup({ 
		type: 'image',
		gallery: {
      enabled: true
    }
	});	
	$(document).keydown(function(e) {
			if (e.keyCode == 27) {
						$.magnificPopup.close();
			}
	});
	

	/*** Contact Form Script
	----------------------------------------------------------------------------- ****/
	
	$('#contactform_form').submit(function(){

		var action = $(this).attr('action');

		$("#message").slideUp(750,function() {
		$('#message').hide();

 		$('#submit_btn')
			.after('<img src="images/AjaxLoader.gif" class="loader" />')
			.attr('disabled','disabled');

		$.post(action, {
			contact_name: $('#contact_name').val(),
			contact_email: $('#contact_email').val(),
			contact_website: $('#contact_website').val(),
			contact_subject: $('#contact_subject').val(),
			contact_message: $('#contact_message').val(),

		},
			function(data){
				document.getElementById('message').innerHTML = data;
				$('#message').slideDown('slow');
				$('#contactform_form img.loader').fadeOut('slow',function(){$(this).remove();});
				$('#submit_btn').removeAttr('disabled');
				if(data.match('success') !== null) $('#contactform_form').slideUp('slow');

			}
		);

		});

		return false;

	});

});