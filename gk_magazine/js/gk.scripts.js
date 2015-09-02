/**
 * jQuery Cookie plugin
 *
 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
jQuery.noConflict();
jQuery.cookie = function (key, value, options) {

    // key and at least value given, set cookie...
    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = jQuery.extend({}, options);

        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        value = String(value);

        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : encodeURIComponent(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

    // key and possibly options given, get cookie...
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};

/**
 *
 * Template scripts
 *
 **/

jQuery(document).ready(function() {	
	
	// style area
	if(jQuery('#gkStyleArea')){
		jQuery('#gkStyleArea').find('a').each(function(i, element){
			jQuery(element).click(function(e){
	            e.preventDefault();
	            e.stopPropagation();
				changeStyle(i+1);
			});
		});
	}
	// font-size switcher
	if(jQuery('#gkTools') && jQuery('#gkMainbody')) {
		var current_fs = 100;
		
		jQuery('#gkMainbody').css('font-size', current_fs+"%");
		
		jQuery('#gkToolsInc').click(function(e){ 
			e.stopPropagation();
			e.preventDefault(); 
			if(current_fs < 150) {  
				jQuery('#gkMainbody').animate({ 'font-size': (current_fs + 10) + "%"}, 200); 
				current_fs += 10; 
			} 
		});
		jQuery('#gkToolsReset').click(function(e){ 
			e.stopPropagation();
			e.preventDefault(); 
			jQuery('#gkMainbody').animate({ 'font-size' : "100%"}, 200); 
			current_fs = 100; 
		});
		jQuery('#gkToolsDec').click(function(e){ 
			e.stopPropagation();
			e.preventDefault(); 
			if(current_fs > 70) { 
				jQuery('#gkMainbody').animate({ 'font-size': (current_fs - 10) + "%"}, 200); 
				current_fs -= 10; 
			} 
		});
	}
	
	// K2 font-size switcher fix
	if(jQuery('#fontIncrease') && jQuery('.itemIntroText')) {
		jQuery('#fontIncrease').click(function() {
			jQuery('.itemIntroText').attr('class', 'itemIntroText largerFontSize');
		});
		
		jQuery('#fontDecrease').click( function() {
			jQuery('.itemIntroText').attr('class', 'itemIntroText smallerFontSize');
		});
	}
		
	// login popup
	if(jQuery('#gkPopupLogin')) {
		var popup_overlay = jQuery('#gkPopupOverlay');
		popup_overlay.css({'display': 'none', 'opacity' : 0});
		
		popup_overlay.fadeOut();
		
		jQuery('#gkPopupLogin').css({'display': 'block', 'opacity': 0, 'height' : 0});
		var opened_popup = null;
		var popup_login = null;
		var popup_login_h = null;
		var popup_login_fx = null;
		
		if(jQuery('#gkPopupLogin') && jQuery('#btnLogin')) {
			popup_login = jQuery('#gkPopupLogin');
			popup_login.css('display', 'block');
			popup_login_h = popup_login.find('.gkPopupWrap').outerHeight();
			 
			jQuery('#gkLogin').click( function(e) {
				e.preventDefault();
				e.stopPropagation();
				popup_overlay.css({'opacity' : 0.6});
				popup_overlay.fadeIn('slow');
				
				popup_login.animate({'opacity':1, 'height': popup_login_h},200, 'swing');
				opened_popup = 'login';
				
				(function() {
					if(jQuery('#modlgn-username')) {
						jQuery('#modlgn-username').focus();
					}
				}).delay(600);
			});
		}
		
		popup_overlay.click( function() {
			if(opened_popup == 'login')	{
				popup_overlay.fadeOut('slow');
				popup_login.css({
					'opacity' : 0,
					'height' : 0
				});
			}
		});
	}
});
//
jQuery(window).load(function() {
		
	jQuery('.headlines').each(function(i, elm) {
		if(elm.hasClass('box')) {
			elm = jQuery(elm);
			elm.find('.nspArt').each(function(i, art) {
				art = jQuery(art);
				var newWrap = jQuery('<div></div>');
				newWrap.attr('class', 'nspNewWrap');
				var img = art.find('.nspImageWrapper');
				var header = art.find('.nspHeader');
				var h = art.outerHeight() - art.css('padding-top').toInt() - art.css('padding-bottom').toInt();
				
				if(img && header) {				
					newWrap.css({
						'height': h + "px",
						'padding-left': (img.outerWidth() + img.css('margin-right').toInt() + img.css('margin-left').toInt()) + "px",
						'padding-bottom': Math.floor((h - header.outerHeight()) / 2) + "px",
						'padding-right': '10px', 
						'padding-top': Math.floor((h - header.outerHeight()) / 2) + "px",
						'top': art.css('padding-top').toInt() + "px",
						'background-position': Math.floor((img.outerWidth() - 40) / 2.0) + "px " + Math.floor(((h - 40) / 2.0) - 17) + "px"
					});
				} else {
					newWrap.css({
						'height': h + "px",
						'padding': "10px 10px 10px 60px",
						'top': art.css('padding-top').toInt() + "px"
					});
				}
				
				newWrap.css({
					'width': art.outerWidth() + "px",
					'right': (-1 * art.outerWidth()) + "px"
				});
				
				if(header.find('a')) {
					newWrap.click( function(e) {
						window.location = header.find('a').attr('href');
					});
				}
				
				var copy = art.find('.nspHeader').clone();
				copy.css('margin', '0');
				
				newWrap.prepend(copy);
				art.append(newWrap);
				
				
				art.mouseenter(function() {					
					if(Math.abs(art.outerWidth() - newWrap.outerWidth()) < 10) {
						if(!art.hasClass('active')) art.addClass('active');
					}
				});
				
				art.mouseleave(function() {
					if(art.hasClass('active')) art.removeClass('active');
						
					if(!art.hasClass('unactive')) {
						art.addClass('unactive');
						setTimeout(function() { art.removeClass('unactive'); }, 400);
					}
				});
			});
		}
	});
});
//
jQuery(document).ready(function() {
	// search
	if(jQuery('#gkSearch')) {
		jQuery('#gkSearch').bind('touchstart', function() {
			jQuery('#gkSearch').toggleClass('active');
		});
		
		jQuery('body').bind('touchstart', function() {
			if(jQuery('#gkSearch').hasClass('active')) {
				jQuery('#gkSearch').removeClass('active');
			}
		});
	}

	if(jQuery(document.body).attr('data-smoothscroll') == '1') {
		// smooth anchor scrolling
		jQuery('a[href*="#"]').on('click', function (e) {
	        e.preventDefault();
	        if(this.hash !== '') {
	            var target = jQuery(this.hash);

	            if(this.hash !== '' && this.href.replace(this.hash, '') == window.location.href.replace(window.location.hash, '')) {    
	                if(target.length && this.hash !== '#') {
	                    jQuery('html, body').stop().animate({
	                        'scrollTop': target.offset().top
	                    }, 1000, 'swing', function () {
	                        if(this.hash !== '#') {
	                            window.location.hash = target.selector;
	                        }
	                    });
	                } else if(this.hash !== '' && this.href.replace(this.hash, '') !== '') {
	                    window.location.href = this.href;
	                }
	            } else if(this.hash !== '' && this.href.replace(this.hash, '') !== '') {
	                window.location.href = this.href;
	            }
	        }
	    });
	}
	// style switcher
	if(jQuery('#gkStyleArea')) {
		jQuery('#gkStyleArea').bind('touchstart', function() {
			jQuery('#gkStyleArea').toggleClass('active');
		});
		
		jQuery('body').bind('touchstart', function() {
			if(jQuery('#gkStyleArea').hasClass('active')) {
				jQuery('#gkStyleArea').removeClass('active');
			}
		});
	}
	
	// NSP nsphover suffix
	jQuery('.nsphover').each(function(i, elm) {
		elm = jQuery(elm);
		if(elm.hasClass('box')) {
			
			elm.find('.nspArt').each(function(i, art) {
				
				art = jQuery(art);
				var overlay = jQuery('<div></div>');
				overlay.attr('class', 'nspHoverOverlay');
				var info = art.find('.nspInfo1');
				var info2 = art.find('.nspInfo2'); 
				
				overlay.append(art.find('.nspText'));
				var copy = art.find('.nspHeader').clone();
				overlay.prepend(copy);
				
				overlay.prepend(info2);
				overlay.append(info);
				
				art.find('.nspImageWrapper').append(art.find('.nspHeader'));
				art.append(overlay);
				art.mouseenter(function() {
					overlay.addClass('active');
				});
				
				art.mouseleave(function() {
					overlay.removeClass('active');
				});
			});
		}
	});
});

// Function to change styles
function changeStyle(style){
	var file1 = $GK_TMPL_URL+'/css/style'+style+'.css';
	var file2 = $GK_TMPL_URL+'/css/typography/typography.style'+style+'.css';
	var file3 = $GK_TMPL_URL+'/css/typography/typography.iconset.style'+style+'.css';
	jQuery('head').append('<link rel="stylesheet" href="'+file1+'" type="text/css" />');
	jQuery('head').append('<link rel="stylesheet" href="'+file2+'" type="text/css" />');
	jQuery('head').append('<link rel="stylesheet" href="'+file3+'" type="text/css" />');
	jQuery.cookie('gk_magazine_j30_style', style, { expires: 365, path: '/' });
}