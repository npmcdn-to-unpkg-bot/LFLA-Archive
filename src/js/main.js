function mobileMenu(){
	// Clone that thing
	var a = $('#header-navigation').html();
	var b = $('#mobile-menu_container').html(a);
	$('#mobile-menu_container a').removeClass('btn-nav').addClass('btn-mobile');
	$(".mobile-toggle").swap();
}

function header(){
	var options = {
    offset: '#media-archive__latest',
    classes: {
        clone:   'archive__search-menu--clone fs-grid',
        stick:   'archive__search-menu--stick',
        unstick: 'archive__search-menu--unstick'
    },
    onInit: function () {
    	$('.archive__search-menu--clone').wrapInner( "<div class='fs-row'><div class='fs-cell fs-all-full'></div></div>");
    },
	};

	// Initialise with options
	var banner = new Headhesive('.archive__search-menu', options);
}

function openSub(){
	$("#home_sub").on('click', function(){
		$.magnificPopup.open({
			items: {
        src: '#mailchimp__signup' 
    	},
    	type: 'inline'
		});
	});
}

function grid(){
		var $grid = $('.iso-grid').imagesLoaded( function() {
  	$grid.isotope({
    	itemSelector: '.iso-grid__item',
  	});
	});
	$(function() {
	  var masonryPreloadedInit = true;
	   // On page load, initiate Masonry
	   if($('.iso-grid').length){		
	      var $containerPreloaded = $('.iso-grid');   	
	      $containerPreloaded.isotope({
	         itemSelector: '.iso-grid__item'
	         });	
	      masonryPreloadedInit = false;
	   }
	   
	   // almComplete
	   $.fn.almComplete = function(alm){
	      if($('.iso-grid').length){
	         var $containerPreloaded = $('.iso-grid');
	         if(!masonryPreloadedInit){
	            $containerPreloaded.isotope('reloadItems');
	            $containerPreloaded.imagesLoaded( function() {
	               $containerPreloaded.isotope();
	            });
	         }
	      }
	   };
	});
}

function fs_defaults(){
	$('.fs__carousel').carousel();
	$('.wallpaper').background();
  $('.equalized').equalize();
}

$(document).ready(function(){
	//mobileMenu();
	fs_defaults();
	openSub();
	grid();
	header();
});