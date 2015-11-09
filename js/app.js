(function(e){e.fn.fitText=function(t,n){var r=t||1,i=e.extend({minFontSize:Number.NEGATIVE_INFINITY,maxFontSize:Number.POSITIVE_INFINITY},n);return this.each(function(){var t=e(this);var n=function(){t.css("font-size",Math.max(Math.min(t.width()/(r*10),parseFloat(i.maxFontSize)),parseFloat(i.minFontSize)))};n();e(window).on("resize.fittext orientationchange.fittext",n)})}})(jQuery);

(function(e){"use strict";e.fn.fitVids=function(t){var n={customSelector:null};if(!document.getElementById("fit-vids-style")){var r=document.createElement("div"),i=document.getElementsByTagName("base")[0]||document.getElementsByTagName("script")[0];r.className="fit-vids-style";r.id="fit-vids-style";r.style.display="none";r.innerHTML="­<style>.fluid-width-video-wrapper {width: 100%;position: relative;padding: 0;} .fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position: absolute;top: 0;left: 0;width: 100%;height: 100%;}</style>";i.parentNode.insertBefore(r,i)}if(t){e.extend(n,t)}return this.each(function(){var t=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];if(n.customSelector){t.push(n.customSelector)}var r=e(this).find(t.join(","));r=r.not("object object");r.each(function(){var t=e(this);if(this.tagName.toLowerCase()==="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length){return}var n=this.tagName.toLowerCase()==="object"||t.attr("height")&&!isNaN(parseInt(t.attr("height"),10))?parseInt(t.attr("height"),10):t.height(),r=!isNaN(parseInt(t.attr("width"),10))?parseInt(t.attr("width"),10):t.width(),i=n/r;if(!t.attr("id")){var s="fitvid"+Math.floor(Math.random()*999999);t.attr("id",s)}t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",i*100+"%");t.removeAttr("height").removeAttr("width")})})}})(jQuery);

function retinajs(){function e(){}function t(e){this.path=e,this.at_2x_path=e.replace(/\.\w+$/,function(e){return"@2x"+e})}function n(e){this.el=e,this.path=new t(this.el.getAttribute("src"));var n=this;this.path.check_2x_variant(function(e){e&&n.swap()})}var i="undefined"==typeof exports?window:exports;i.Retina=e,e.init=function(e){null==e&&(e=i);var t=e.onload||Function();e.onload=function(){var e,i,a=document.getElementsByTagName("img"),r=[];for(e=0;a.length>e;e++)i=a[e],r.push(new n(i));t()}},e.isRetina=function(){var e="(-webkit-min-device-pixel-ratio: 1.5),(min--moz-device-pixel-ratio: 1.5),(-o-min-device-pixel-ratio: 3/2),(min-resolution: 1.5dppx)";return i.devicePixelRatio>1?!0:i.matchMedia&&i.matchMedia(e).matches?!0:!1},i.RetinaImagePath=t,t.confirmed_paths=[],t.prototype.at_2x_path_loads=function(e){var t=new Image;t.onload=function(){return e(!0)},t.onerror=function(){return e(!1)},t.src=this.at_2x_path},t.prototype.check_2x_variant=function(e){var n=this;return-1!=t.confirmed_paths.indexOf(this.at_2x_path)?e(!0):(this.at_2x_path_loads(function(i){return i&&t.confirmed_paths.push(n.at_2x_path),e(i)}),void 0)},i.RetinaImage=n,n.prototype.swap=function(e){function t(){n.el.complete?(n.el.setAttribute("width",n.el.offsetWidth),n.el.setAttribute("height",n.el.offsetHeight),n.el.setAttribute("src",e)):setTimeout(t,5)}e===void 0&&(e=this.path.at_2x_path);var n=this;t()},e.isRetina()&&e.init(i)}

(function($){var h=$.scrollTo=function(a,b,c){$(window).scrollTo(a,b,c)};h.defaults={axis:'xy',duration:parseFloat($.fn.jquery)>=1.3?0:1,limit:true};h.window=function(a){return $(window)._scrollable()};$.fn._scrollable=function(){return this.map(function(){var a=this,isWin=!a.nodeName||$.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!isWin)return a;var b=(a.contentWindow||a).document||a.ownerDocument||a;return/webkit/i.test(navigator.userAgent)||b.compatMode=='BackCompat'?b.body:b.documentElement})};$.fn.scrollTo=function(e,f,g){if(typeof f=='object'){g=f;f=0}if(typeof g=='function')g={onAfter:g};if(e=='max')e=9e9;g=$.extend({},h.defaults,g);f=f||g.duration;g.queue=g.queue&&g.axis.length>1;if(g.queue)f/=2;g.offset=both(g.offset);g.over=both(g.over);return this._scrollable().each(function(){if(e==null)return;var d=this,$elem=$(d),targ=e,toff,attr={},win=$elem.is('html,body');switch(typeof targ){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(targ)){targ=both(targ);break}targ=$(targ,this);if(!targ.length)return;case'object':if(targ.is||targ.style)toff=(targ=$(targ)).offset()}$.each(g.axis.split(''),function(i,a){var b=a=='x'?'Left':'Top',pos=b.toLowerCase(),key='scroll'+b,old=d[key],max=h.max(d,a);if(toff){attr[key]=toff[pos]+(win?0:old-$elem.offset()[pos]);if(g.margin){attr[key]-=parseInt(targ.css('margin'+b))||0;attr[key]-=parseInt(targ.css('border'+b+'Width'))||0}attr[key]+=g.offset[pos]||0;if(g.over[pos])attr[key]+=targ[a=='x'?'width':'height']()*g.over[pos]}else{var c=targ[pos];attr[key]=c.slice&&c.slice(-1)=='%'?parseFloat(c)/100*max:c}if(g.limit&&/^\d+$/.test(attr[key]))attr[key]=attr[key]<=0?0:Math.min(attr[key],max);if(!i&&g.queue){if(old!=attr[key])animate(g.onAfterFirst);delete attr[key]}});animate(g.onAfter);function animate(a){$elem.animate(attr,f,g.easing,a&&function(){a.call(this,e,g)})}}).end()};h.max=function(a,b){var c=b=='x'?'Width':'Height',scroll='scroll'+c;if(!$(a).is('html,body'))return a[scroll]-$(a)[c.toLowerCase()]();var d='client'+c,html=a.ownerDocument.documentElement,body=a.ownerDocument.body;return Math.max(html[scroll],body[scroll])-Math.min(html[d],body[d])};function both(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);

jQuery.easing.jswing=jQuery.easing.swing;jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(e,a,c,b,d){return jQuery.easing[jQuery.easing.def](e,a,c,b,d)},easeInQuad:function(e,a,c,b,d){return b*(a/=d)*a+c},easeOutQuad:function(e,a,c,b,d){return-b*(a/=d)*(a-2)+c},easeInOutQuad:function(e,a,c,b,d){if((a/=d/2)<1)return b/2*a*a+c;return-b/2*(--a*(a-2)-1)+c},easeInCubic:function(e,a,c,b,d){return b*(a/=d)*a*a+c},easeOutCubic:function(e,a,c,b,d){return b*((a=a/d-1)*a*a+1)+c},easeInOutCubic:function(e,a,c,b,d){if((a/=d/2)<1)return b/2*a*a*a+c;return b/2*((a-=2)*a*a+2)+c},easeInQuart:function(e,a,c,b,d){return b*(a/=d)*a*a*a+c},easeOutQuart:function(e,a,c,b,d){return-b*((a=a/d-1)*a*a*a-1)+c},easeInOutQuart:function(e,a,c,b,d){if((a/=d/2)<1)return b/2*a*a*a*a+c;return-b/2*((a-=2)*a*a*a-2)+c},easeInQuint:function(e,a,c,b,d){return b*(a/=d)*a*a*a*a+c},easeOutQuint:function(e,a,c,b,d){return b*((a=a/d-1)*a*a*a*a+1)+c},easeInOutQuint:function(e,a,c,b,d){if((a/=d/2)<1)return b/2*a*a*a*a*a+c;return b/2*((a-=2)*a*a*a*a+2)+c},easeInSine:function(e,a,c,b,d){return-b*Math.cos(a/d*(Math.PI/2))+b+c},easeOutSine:function(e,a,c,b,d){return b*Math.sin(a/d*(Math.PI/2))+c},easeInOutSine:function(e,a,c,b,d){return-b/2*(Math.cos(Math.PI*a/d)-1)+c},easeInExpo:function(e,a,c,b,d){return a==0?c:b*Math.pow(2,10*(a/d-1))+c},easeOutExpo:function(e,a,c,b,d){return a==d?c+b:b*(-Math.pow(2,-10*a/d)+1)+c},easeInOutExpo:function(e,a,c,b,d){if(a==0)return c;if(a==d)return c+b;if((a/=d/2)<1)return b/2*Math.pow(2,10*(a-1))+c;return b/2*(-Math.pow(2,-10*--a)+2)+c},easeInCirc:function(e,a,c,b,d){return-b*(Math.sqrt(1-(a/=d)*a)-1)+c},easeOutCirc:function(e,a,c,b,d){return b*Math.sqrt(1-(a=a/d-1)*a)+c},easeInOutCirc:function(e,a,c,b,d){if((a/=d/2)<1)return-b/2*(Math.sqrt(1-a*a)-1)+c;return b/2*(Math.sqrt(1-(a-=2)*a)+1)+c},easeInElastic:function(e,a,c,b,d){e=1.70158;var f=0,g=b;if(a==0)return c;if((a/=d)==1)return c+b;f||(f=d*0.3);if(g<Math.abs(b)){g=b;e=f/4}else e=f/(2*Math.PI)*Math.asin(b/g);return-(g*Math.pow(2,10*(a-=1))*Math.sin((a*d-e)*2*Math.PI/f))+c},easeOutElastic:function(e,a,c,b,d){e=1.70158;var f=0,g=b;if(a==0)return c;if((a/=d)==1)return c+b;f||(f=d*0.3);if(g<Math.abs(b)){g=b;e=f/4}else e=f/(2*Math.PI)*Math.asin(b/g);return g*Math.pow(2,-10*a)*Math.sin((a*d-e)*2*Math.PI/f)+b+c},easeInOutElastic:function(e,a,c,b,d){e=1.70158;var f=0,g=b;if(a==0)return c;if((a/=d/2)==2)return c+b;f||(f=d*0.3*1.5);if(g<Math.abs(b)){g=b;e=f/4}else e=f/(2*Math.PI)*Math.asin(b/g);if(a<1)return-0.5*g*Math.pow(2,10*(a-=1))*Math.sin((a*d-e)*2*Math.PI/f)+c;return g*Math.pow(2,-10*(a-=1))*Math.sin((a*d-e)*2*Math.PI/f)*0.5+b+c},easeInBack:function(e,a,c,b,d,f){if(f==undefined)f=1.70158;return b*(a/=d)*a*((f+1)*a-f)+c},easeOutBack:function(e,a,c,b,d,f){if(f==undefined)f=1.70158;return b*((a=a/d-1)*a*((f+1)*a+f)+1)+c},easeInOutBack:function(e,a,c,b,d,f){if(f==undefined)f=1.70158;if((a/=d/2)<1)return b/2*a*a*(((f*=1.525)+1)*a-f)+c;return b/2*((a-=2)*a*(((f*=1.525)+1)*a+f)+2)+c},easeInBounce:function(e,a,c,b,d){return b-jQuery.easing.easeOutBounce(e,d-a,0,b,d)+c},easeOutBounce:function(e,a,c,b,d){return(a/=d)<1/2.75?b*7.5625*a*a+c:a<2/2.75?b*(7.5625*(a-=1.5/2.75)*a+0.75)+c:a<2.5/2.75?b*(7.5625*(a-=2.25/2.75)*a+0.9375)+c:b*(7.5625*(a-=2.625/2.75)*a+0.984375)+c},easeInOutBounce:function(e,a,c,b,d){if(a<d/2)return jQuery.easing.easeInBounce(e,a*2,0,b,d)*0.5+c;return jQuery.easing.easeOutBounce(e,a*2-d,0,b,d)*0.5+b*0.5+c}});

(function($){
	function goResize(c,t){onresize=function(){clearTimeout(t);t=setTimeout(c,100)};return c};
	idleTime = 0;

	$(document).ready(function() {
		var header = $('#header'),
			hero = $('#hero'),
			title = $('.title'),
			windowWidth = $(window).width(),
			windowHeight = $(window).height(),
			hintScroll = $('.hint-scroll'),
			navTrigger = $('#nav-trigger'),
			searchTrigger = $('#search-trigger'),
			searchDiv = $('#search-global'),
			searchOverlay = $('#search-overlay'),
			searchCloseTrigger = $('#search-close-trigger'),
			searchEnabled = false;

		var nua = navigator.userAgent,
			isiPad = nua.match(/iPad/i),
			isiPhone = nua.match(/iPhone/i),
			isiPod = nua.match(/iPod/i),
			transform2d = nua.match(/msie 9/i) || nua.match(/msie 8/i) || nua.match(/msie 7/i);
	
		function init(){
			var windowHeight = $(window).height(),
				deviceWindowHeight = window.screen.height;
		
			if ( isiPhone || isiPod ) {
				hero.css( 'height', deviceWindowHeight );
			} else {
				hero.css( 'height', windowHeight );
			}
		}
		init();
	
		goResize(function() {
			init();
		});
		
		if ( isiPhone || isiPod ) $('body').addClass('iphone');
		if ( isiPad ) $('body').addClass('ipad');
		
		$('.title h1').fitText(0.9, { minFontSize: '56px', maxFontSize: '96px' });
		
		$("#content").fitVids();
		
		$('img.svg').each(function(){
			var $img = $(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            $.get(imgURL, function(data) {
                var $svg = $(data).find('svg');
                if(typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }
                if(typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass+' replaced-svg');
                }
                $svg = $svg.removeAttr('xmlns:a');
                $img.replaceWith($svg);
            });

        });
		
		navTrigger.on('click', function() {
			$('#menu').slideToggle(200).toggleClass('open');
			return false;
		});
		
		searchTrigger.on('click', function() {
			searchDiv.add(searchOverlay).fadeIn(300).addClass('search-enabled');
			$('#search-global #s').focus();
			if ( $(window).width() <= 768 ) {
				$('#menu').slideUp(200).removeClass('open');
			}
			searchEnabled = true;
			navEnabled = false;
			return false;
		});
		
		searchCloseTrigger.add(searchOverlay).on('click', function() {
			if (searchEnabled == true){
				searchDiv.fadeOut(200).removeClass('search-enabled');
				searchEnabled = false;
				navEnabled = true;
			}
			return false;
		});
		
		var interval = window.setInterval(function() { timerIncrement(); }, 1000);
	    $(this).mousemove(function (e) {
	        idleTime = 0;
	    });
	    $(this).keypress(function (e) {
	        idleTime = 0;
	    });

		$(window).scroll(function () {
			var offset = $(document).scrollTop(),
				valor = -0.45,
				parallax = offset*valor;

			// Parallax the shit out of that title
			if ( isiPad ) {
				// Do nutin'
			} else if ( isiPhone || isiPod ) {
				hintScroll.remove();
			} else if (!transform2d) {
				title.css({
					'-webkit-transform': 'translate3d(0px, ' + parallax + 'px, 0px)',
					'transform': 'translate3d(0px, ' + parallax + 'px, 0px)'
				});
			} else {
				title.css({
					'-webkit-transform': 'translateY('+ parallax +'px)',
					'transform': 'translateY('+ parallax +'px)'
				});
			}
			
			// Scroll hint
			if (offset > 0) {
				clearInterval(interval);
				if (hintScroll.hasClass('come-up')) {
					hintScroll.removeClass('come-up').addClass('go-down');
				} else if (hintScroll.hasClass('go-down')) {
					// ha-hah!
				} else {
					hintScroll.remove();
				}
			}
		});
		console.log('Konnichiwa! ^_^');	
	});
	
	// Scroll Progress
	$(window).load(function() {
		var scrollProgress = $('#scroll-progress');
		$(window).scroll(function () {
			var offset = $(document).scrollTop(),
				pageHeight = $('#content').height(),
				scrollProgressAmount = ( offset * 100 / pageHeight ) < 100 ? ( offset * 100 / pageHeight ) : '100';
				
			scrollProgress.stop().animate({ width: scrollProgressAmount + '%' }, 200);
		});
	});
	
	function timerIncrement() {
	    idleTime++;
	    if (idleTime > 3) {
			$('.hint-scroll').addClass('come-up');
	    }
	}
	
	function trackOutboundLink(link, category, action) {  
		try { 
			_gaq.push(['_trackEvent', category , action]); 
		} catch(err){}

		setTimeout(function() {
			document.location.href = link.href;
		}, 200);
	}
})(jQuery);