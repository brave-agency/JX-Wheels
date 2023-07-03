/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
} )();

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();

(function($) {
    //--------------------------------
    // MENU / NAVIGATION
    //--------------------------------
    $('.menu-toggle-lmr').on('click', function(event){
		event.preventDefault();
		$(this).toggleClass('toggled');
		$('.main-navigation').toggleClass('toggled');
	});
	$('.menu-item.menu-item-has-children').on('click', function(){
		$(this).toggleClass('toggled');
	});

    //--------------------------------
    // SELECT REDESIGN
    //--------------------------------
    $("select").selectric();

    //--------------------------------
    // STOCKISTS POPUP
    //--------------------------------
    $('.menu-item-stockists').on('click', function(event){
        event.preventDefault();
        $('.site-stockists').addClass('opened');
    });
    $('.site-stockists-close').on('click', function(event){
        event.preventDefault();
        $('.site-stockists').removeClass('opened');
    });

    //--------------------------------
    // CAROUSEL SETTINGS
    //--------------------------------
    // load carousel
    if ( $("#main-carousel").length ) {
        $('#main-carousel').slick({
            autoplay:true,
            speed: 750,
            infinite: true,
            arrows: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow:'<button class="carousel-arrow carousel-prev"></button>',
            nextArrow:'<button class="carousel-arrow carousel-next"></button>'
        });
        // parallax thingy
        var scenes = [];
        var scenesSelector = document.querySelectorAll('.site-carousel-slide-parallax');
        for(i=0; i<scenesSelector.length; i++){
            scenes[i] = new Parallax(scenesSelector[i]);
        }
    }
    // load carousel title
    $('.site-hero-heading').queue(function(next){
        $(this).addClass('triggered').delay(500).queue(function(){
            $('.carousel-arrow').addClass('triggered').dequeue();
        });
        next();
    });
    // on scroll move hero inner content
    $(window).scroll(function() {
        $(".site-hero-heading").css({"transform": "translateY(" + ($(this).scrollTop() / 15) + "px)"});
        $(".carousel-arrow").css({"transform": "translateY(" + ($(this).scrollTop() / 10) + "px)"});
        $(".site-hero-desc").css({"transform": "translateY(" + ($(this).scrollTop() / -17.5) + "px)"});
        // $(".slick-dots").css({"transform": "translateY(" + ($(this).scrollTop() / -25) + "px)"});
        if (!$(".home .site-header").length && !$(".page-template-find-a-stockist .site-header").length && !$(".single-wheel .site-header").length && !$(".single-post .site-header").length){
            $(".site-header").css({"background": "rgba(0,0,0," + ($(this).scrollTop() / 300 * 1.25) + ")"});
        }
    });

    //--------------------------------
    // TILES EFFECTS
    //--------------------------------
    // fade out siblings
    $("div.site-tile").hover(function() {
        $(this).siblings("div.site-tile").addClass("fade");
    }, function() {
        $(this).siblings("div.site-tile").removeClass("fade");
    });
    // split list if has more than 8 items
    if($('div.site-tile .site-tile-content ul li').length > 7){
        $('div.site-tile .site-tile-content ul').addClass('split');
    }

    // fade out siblings instagram footer
    $("li.site-instagram-item").hover(function() {
        $(this).siblings("li.site-instagram-item").addClass("fade");
    }, function() {
        $(this).siblings("li.site-instagram-item").removeClass("fade");
    });

    //--------------------------------
    // NEW ARRIVALS
    //--------------------------------
    if ( $(".site-newarrivals-list").length ) {
        $('.site-newarrivals-list').slick({
            autoplay:true,
            speed: 750,
            slidesToShow: 4,
            dots: false,
            arrows: true,
            prevArrow: $('.site-newarrivals-prev'),
            nextArrow: $('.site-newarrivals-next'),
            responsive: [
                {
                    breakpoint: 1280,
                    settings: {
                        slidesToShow: 3,
                    }
                },{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                    }
                },{
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    }

    //--------------------------------
    // NEW ARRIVALS
    //--------------------------------
    if ( $("#about-more-carousel").length ) {
        $('#about-more-carousel').slick({
            fade: true,
            autoplay:true,
            speed: 750,
            infinite: true,
            arrows: true,
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow:'<button class="site-about-more-arrow site-about-more-prev"></button>',
            nextArrow:'<button class="site-about-more-arrow site-about-more-next"></button>'
        });
    }

    //--------------------------------------------
    // HOMEPAGE VIDEO - not in use, but kept it
    //--------------------------------------------
    $( window ).on( "load", function() {
        $(".youtube-player .play").click(function(){
            $(".site-home-triangle").addClass('clicked');
        });
    });
    /* Light YouTube Embeds by @labnol */
    /* Web: http://labnol.org/?p=27941 */
    document.addEventListener("DOMContentLoaded",
        function() {
            var div, n,
                v = document.getElementsByClassName("youtube-player");
            for (n = 0; n < v.length; n++) {
                div = document.createElement("div");
                div.setAttribute("data-id", v[n].dataset.id);
                div.innerHTML = labnolThumb(v[n].dataset.id);
                div.onclick = labnolIframe;
                v[n].appendChild(div);
            }
        });
    function labnolThumb(id) {
        var thumb = '<img src="">',
            play = '<div class="play"></div>';
        return thumb.replace("ID", id) + play;
    }
    function labnolIframe() {
        var iframe = document.createElement("iframe");
        var embed = "https://www.youtube.com/embed/ID?autoplay=1&controls=0&modestbranding=0&showinfo=0";
        iframe.setAttribute("src", embed.replace("ID", this.dataset.id));
        iframe.setAttribute("frameborder", "0");
        iframe.setAttribute("allowfullscreen", "1");
        this.parentNode.replaceChild(iframe, this);
    }

    //------------------------------------------
    // HERO BANNER PARALLAX EXTRA TRANSITIONS
    //------------------------------------------
    // load carousel title
    $('.site-hero-cover  .site-hero-content').delay(500).queue(function(){
        $(this).addClass('triggered').dequeue();
    });
    // on scroll move hero inner content
    $(window).scroll(function() {
        $(".site-hero-cover .site-hero-content").css({"transform": "translateY(" + ($(this).scrollTop() / 3.5) + "px)"});
    });

    //------------------------------------------
    // SUBSCRIBE FORM
    //------------------------------------------
    window.fnames = new Array();
    window.ftypes = new Array();
    fnames[0]='EMAIL';
    ftypes[0]='email';
    var $mcj = jQuery.noConflict(true);

    var $form = $('#mc-embedded-subscribe-form');

    if ( $form.length > 0 ) {
        $('#mc-embedded-subscribe').bind('click', function ( event ) {
            if ( event ) event.preventDefault();
            subscribtion($form);
        });
    }

    function subscribtion($form) {
        $.ajax({
            type: $form.attr('method'),
            url: $form.attr('action'),
            data: $form.serialize(),
            cache       : false,
            dataType    : 'jsonp',
            jsonp		: 'c',
            contentType: "application/json; charset=utf-8",
            error       : function(err) { 
                console.log("Could not connect to the registration server. Please try again later.");
            },
            success     : function(data) {
                if (data.result != "success") {
                    $('.site-newsletter-msg').remove();
                    $('#mc_embed_signup_scroll').append( "<p class='site-newsletter-msg site-newsletter-error'>You used existing email or missing one of the fields.</p>" );
                } else {
                    $('.site-newsletter-msg').remove();
                    $('#mc_embed_signup_scroll').append( "<p class='site-newsletter-msg site-newsletter-success'>Thank you for subscribing.</p>" );
                }
            }
        });
    }

    //------------------------------------------
    // WHEELS FILTER FUNCTIONALITY
    //------------------------------------------
    // filtering items toggle - mobile
    $(".site-wheels-filters-button").click(function(){
        $(this).toggleClass('toggled');
        $(this).next('ul.site-wheels-filters-list').toggleClass('toggled');
    });

    // filtering items
    if ( $(".site-wheels-list").length ) {
        var $wheelsList = $('.site-wheels-list');
        $wheelsList.isotope({
            getSortData: {
                price: '[data-price] parseInt'
            }
        });
    }

    // store filter for each group
    if ( $(".site-wheels-filters-options").length ) {
        var filters = {};
        $(document).on( 'change', '.site-wheels-filters-options', function() {
            var $this = $(this);
            // get group key
            var filterGroup = $this.attr('data-filter-group');
            // set filter for group
            filters[ filterGroup ] = this.value;
            // combine filters
            var filterValue = concatValues( filters );
            $wheelsList.isotope({filter: filterValue });
        });
        // flatten object by concatting values
        function concatValues( obj ) {
            var value = '';
            for ( var prop in obj ) {
                value += obj[ prop ];
            }
            return value;
        }

        // sort by price
        $('.site-wheels-filters-sortby').change( function() {
            if (this.value == 'low-to-high'){
                $wheelsList.isotope({
                    sortBy : 'price',
                    sortAscending: true
                });
            } else if (this.value == 'high-to-low'){
                $wheelsList.isotope({
                    sortBy : 'price',
                    sortAscending: false
                });
            }
        });
    }

     //------------------------------------------
    // WHEEL MODEL DETAILS - FUNCTIONALITY
    //------------------------------------------
    // show carousel depending on the colour
    if ( $(".site-wheel-details-finish").length ) {
        $('.site-wheel-details-finish ul li:first-of-type').addClass('active');
        $('.site-wheel-details-finish ul li').click(function(){

            var $colurName = $(this).data('colour-finish');
            var $carouselName = $('.site-wheel-carousel-'+$colurName+'');

            $('.site-wheel-details-finish ul li').removeClass('active');
            $(this).addClass('active');

            $('.site-wheel-carousel').removeClass('active');
            $carouselName.addClass('active');

        });
    }
    //------------------------------------------
    // SHOW ME THE WHEELS FUNCTIONALITY
    //------------------------------------------
    // load carousel
    if ( $(".site-gallery-list").length ) {
        $('.site-gallery-list').slick({
            autoplay:true,
            speed: 750,
            infinite: true,
            arrows: true,
            dots: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            prevArrow:'<button class="site-gallery-arrow site-gallery-prev"></button>',
            nextArrow:'<button class="site-gallery-arrow site-gallery-next"></button>',
            responsive: [
                {
                    breakpoint: 1700,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true
                    }
                },
                {
                    breakpoint: 320,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true
                    }
                }
            ]
        });
    }
    // SUBMIT RECAPTCHA VALIDATION
    if ( $("#smtw-submit").length ) {
        $("#smtw-submit").on('click', function(event) {
            var recaptcha = $("#g-recaptcha-response").val();
            if (recaptcha === "") {
                event.preventDefault();
                $(".g-recaptcha-error p").remove();
                $(".g-recaptcha-error").append("<p>Please make sure that you are not a robot.</p>");
            } else{
                $(".g-recaptcha-error p").remove();
            }
        });
    }
    // Smooth scrolling when clicking on a hash link
	$('a[href^="#"]').on('click',function (e) {
		e.preventDefault();

		var target = this.hash;
		var $target = $(target);

		$('html, body').stop().animate({
			'scrollTop': $target.offset().top - 120
		}, 500, 'swing');
  });
  

  // GIN CODE: GALLERY SORTING

  if ($('#gallery').length) { 
    
    let buttons = [];
    $('.ngg-gallery-thumbnail-box .ngg-gallery-thumbnail a, .ngg-albumoverview .ngg-description p:first-of-type').map( ( index, element ) => {
      
      const galleryElements = $(element).attr('data-title');
      let albums = [];
      let galleries = [];
  
      if ( !galleryElements ) {
        albums = element.innerText.split(',');
        albums = albums.filter( item => {
          if (item.length > 0 ) {
            return true;
          } else {
            return false;
          }
        });
  
      } else {
        galleries = galleryElements.split(',');
        galleries = galleries.filter( item => {
          if (item.length > 0 ) {
            return true;
          } else {
            return false;
          }
        });
      }
      
      const filterTarget = albums && albums.length > 0 ? 'ngg-album' : 'ngg-gallery-thumbnail';
      const filters = albums && albums.length > 0 ? albums : galleries;
  
      filters && filters.map( filter => {
        if (!buttons.includes(filter)) {
          $(`<button class="button" data-filter=".${filterTarget}, ${filter}">${filter}</button>`).insertAfter('#sorting button:last-of-type');
          buttons.push( filter );
        }
      });
    });
  
    const galleries = $('.ngg-gallery-thumbnail-box .ngg-gallery-thumbnail a');
    // var iso = null;
    var $iso = null;
    if ( galleries && galleries.length > 0 ) {
      // iso = new Isotope( '.ngg-galleryoverview', {
      $iso = $('.ngg-galleryoverview').isotope({
        itemSelector: '.ngg-gallery-thumbnail-box',
        layoutMode: 'fitRows',
        isOriginLeft: false,
        isOriginTop: false,
        // stagger: 30
      });
    } else {
      // iso = new Isotope( '.ngg-albumoverview', { 
      $iso = $( '.ngg-albumoverview').isotope({
        itemSelector: '.ngg-album',
        isOriginLeft: false,
        isOriginTop: false,
        layoutMode: 'fitRows',
        // stagger: 30
      });
    }
  
    let currentFilter = '*';
  
    $('#sorting button').on( 'click', ( e ) => {
      let filterArray =  $(e.target).attr('data-filter').split(',');
      currentFilter = filterArray[filterArray.length - 1].trim();
    });
  
    // filter functions
    var filterFns = {
      ".ngg-gallery-thumbnail": ( ...itemElem ) => {
        return itemElem[1].querySelector(`a[data-title="${currentFilter}"]`);
      },
      ".ngg-album": ( ...itemElem ) => {
        const categories = $(itemElem[1]).find('.ngg-description p:first-of-type')[0].innerText.split(',');
        return categories.includes( currentFilter );
      }
    };
  
    // bind filter button click
    var filtersElem = document.querySelector('.filters-button-group');
    filtersElem && filtersElem.addEventListener( 'click', function( event ) {
      // only work with buttons
      console.log('paspaude',  );
      if ( !matchesSelector( event.target, 'button' ) || [...event.target.classList].includes('is-checked') ) {
        return;
      }
      var filterValue = event.target.getAttribute('data-filter').split(',')[0].trim();
      
      // use matching filter function
      filterValue = filterFns[ filterValue ] || filterValue;
      $iso.isotope({ filter: filterValue }); 
    });
  
    // change is-checked class on buttons
    var buttonGroups = document.querySelectorAll('.button-group');
    for ( var i=0, len = buttonGroups.length; i < len; i++ ) {
      var buttonGroup = buttonGroups[i];
      radioButtonGroup( buttonGroup );
    }
  
    function radioButtonGroup( buttonGroup ) { 
      buttonGroup && buttonGroup.addEventListener( 'click', function( event ) {
        // only work with buttons
        if ( !matchesSelector( event.target, 'button' ) ) {
          return;
        }
        buttonGroup.querySelector('.is-checked').classList.remove('is-checked');
        event.target.classList.add('is-checked');
      });
    }
  
    if ($('#sorting button').length > 1) {
      $('#sorting button').css('visibility', 'visible');
      $('.site-stockists.site-stockists-resultpage').css('height', 'auto').css('padding', '1.5rem 1.5rem 0 1.5rem');
    }
  }

})(jQuery);

