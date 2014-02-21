window.addEvent('load', function(){
	// smooth anchor scrolling
	new SmoothScroll(); 
	// style area
	if(document.id('gkStyleArea')){
		document.id('gkStyleArea').getElements('a').each(function(element,i){
			element.addEvent('click',function(e){
	            e.stop();
				changeStyle(i+1);
			});
		});
	}
	// font-size switcher
	if(document.id('gkTools') && document.id('gkMainbody')) {
		var current_fs = 100;
		var content_fx = new Fx.Tween(document.id('gkMainbody'), { property: 'font-size', unit: '%', duration: 200 }).set(100);
		document.id('gkToolsInc').addEvent('click', function(e){ 
			e.stop(); 
			if(current_fs < 150) { 
				content_fx.start(current_fs + 10); 
				current_fs += 10; 
			} 
		});
		document.id('gkToolsReset').addEvent('click', function(e){ 
			e.stop(); 
			content_fx.start(100); 
			current_fs = 100; 
		});
		document.id('gkToolsDec').addEvent('click', function(e){ 
			e.stop(); 
			if(current_fs > 70) { 
				content_fx.start(current_fs - 10); 
				current_fs -= 10; 
			} 
		});
	}
	// K2 font-size switcher fix
	if(document.id('fontIncrease') && document.getElement('.itemIntroText')) {
		document.id('fontIncrease').addEvent('click', function() {
			document.getElement('.itemIntroText').set('class', 'itemIntroText largerFontSize');
		});
		
		document.id('fontDecrease').addEvent('click', function() {
			document.getElement('.itemIntroText').set('class', 'itemIntroText smallerFontSize');
		});
	}
	// login popup
	if(document.id('gkPopupLogin')) {
		var popup_overlay = document.id('gkPopupOverlay');
		popup_overlay.setStyles({'display': 'block', 'opacity': '0'});
		popup_overlay.fade('out');

		var opened_popup = null;
		var popup_login = null;
		var popup_login_h = null;
		var popup_login_fx = null;
		
		if(document.id('gkPopupLogin')) {
			popup_login = document.id('gkPopupLogin');
			popup_login.setStyle('display', 'block');
			popup_login_h = popup_login.getElement('.gkPopupWrap').getSize().y;
			popup_login_fx = new Fx.Morph(popup_login, {duration:200, transition: Fx.Transitions.Circ.easeInOut}).set({'opacity': 0, 'height': 0 }); 
			document.id('gkLogin').addEvent('click', function(e) {
				new Event(e).stop();
				popup_overlay.fade(0.45);
				popup_login_fx.start({'opacity':1, 'height': popup_login_h});
				opened_popup = 'login';
				
				(function() {
					if(document.id('modlgn-username')) {
						document.id('modlgn-username').focus();
					}
				}).delay(600);
			});
		}
		
		popup_overlay.addEvent('click', function() {
			if(opened_popup == 'login')	{
				popup_overlay.fade('out');
				popup_login_fx.start({
					'opacity' : 0,
					'height' : 0
				});
			}
		});
	}
});
//
window.addEvent('load', function() {
	// NSP header suffix
	document.getElements('.headlines').each(function(elm, i) {
		if(elm.hasClass('box')) {
			elm.getElements('.nspArt').each(function(art, i) {
				var newWrap = new Element('div', { 'class' : 'nspNewWrap' });
				var img = art.getElement('.nspImageWrapper');
				var header = art.getElement('.nspHeader');
				var h = art.getSize().y - art.getStyle('padding-top').toInt() - art.getStyle('padding-bottom').toInt();
				
				if(img && header) {				
					newWrap.setStyles({
						'height': h + "px",
						'padding-left': (img.getSize().x + img.getStyle('margin-right').toInt() + img.getStyle('margin-left').toInt()) + "px",
						'padding-bottom': Math.floor((h - header.getSize().y) / 2) + "px",
						'padding-right': '10px', 
						'padding-top': Math.floor((h - header.getSize().y) / 2) + "px",
						'top': art.getStyle('padding-top').toInt() + "px",
						'background-position': Math.floor((img.getSize().x - 40) / 2.0) + "px " + Math.floor(((h - 40) / 2.0) - 17) + "px"
					});
				} else {
					newWrap.setStyles({
						'height': h + "px",
						'padding': "10px 10px 10px 60px",
						'top': art.getStyle('padding-top').toInt() + "px"
					});
				}
				
				newWrap.setStyles({
					'width': art.getSize().x + "px",
					'right': (-1 * art.getSize().x) + "px"
				});
				
				if(header.getElement('a')) {
					newWrap.addEvent('click', function() {
						window.location = header.getElement('a').getProperty('href');
					});
				}
				
				art.getElement('.nspHeader').clone().setStyle('margin', '0').inject(newWrap ,'inside');
				newWrap.inject(art, 'bottom');
				
				art.addEvent('mouseenter', function() {
					if(Math.abs(art.getSize().x - newWrap.getSize().x) < 10) {
						if(!art.hasClass('active')) art.addClass('active');
					}
				});
				
				art.addEvent('mouseleave', function() {
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
window.addEvent('domready', function() {
	// search
	if(document.id('gkSearch')) {
		document.id('gkSearch').addEvent('touchstart', function() {
			document.id('gkSearch').toggleClass('active');
		});
		
		document.getElement('body').addEvent('touchstart', function() {
			if(document.id('gkSearch').hasClass('active')) {
				document.id('gkSearch').removeClass('active');
			}
		});
	}
	// style switcher
	if(document.id('gkStyleArea')) {
		document.id('gkStyleArea').addEvent('touchstart', function() {
			document.id('gkStyleArea').toggleClass('active');
		});
		
		document.getElement('body').addEvent('touchstart', function() {
			if(document.id('gkStyleArea').hasClass('active')) {
				document.id('gkStyleArea').removeClass('active');
			}
		});
	}
	// NSP nsphover suffix
	document.getElements('.nsphover').each(function(elm, i) {
		if(elm.hasClass('box')) {
			elm.getElements('.nspArt').each(function(art, i) {
				var overlay = new Element('div', { 'class': 'nspHoverOverlay' });
				var info = art.getElement('.nspInfo1');
				var info2 = art.getElement('.nspInfo2'); 
				overlay.inject(art, 'bottom');
				art.getElement('.nspText').inject(overlay, 'bottom');
				var copy = art.getElement('.nspHeader').clone();
				copy.inject(overlay, 'top');
				info.inject(overlay, 'bottom');
				info2.inject(overlay, 'top');
				art.getElement('.nspHeader').inject(art.getElement('.nspImageWrapper'), 'bottom');
				
				art.addEvent('mouseenter', function() {
					overlay.addClass('active');
				});
				
				art.addEvent('mouseleave', function() {
					overlay.removeClass('active');
				});
			});
		}
	});
});
// function to set cookie
function setCookie(c_name, value, expire) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expire);
	document.cookie=c_name+ "=" +escape(value) + ((expire==null) ? "" : ";expires=" + exdate.toUTCString());
}
// Function to change styles
function changeStyle(style){
	var file1 = $GK_TMPL_URL+'/css/style'+style+'.css';
	var file2 = $GK_TMPL_URL+'/css/typography/typography.style'+style+'.css';
	var file3 = $GK_TMPL_URL+'/css/typography/typography.iconset.style'+style+'.css';
	new Asset.css(file1);
	new Asset.css(file2);
	new Asset.css(file3);
	Cookie.write('gk_magazine_j25_style', style, { duration:365, path: '/' });
}