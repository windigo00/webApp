/* -------------------- Check Browser --------------------- */

function browser() {
	
	var isOpera = !!(window.opera && window.opera.version);  // Opera 8.0+
	var isFirefox = testCSS('MozBoxSizing');                 // FF 0.8+
	var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
	    // At least Safari 3+: "[object HTMLElementConstructor]"
	var isChrome = !isSafari && testCSS('WebkitTransform');  // Chrome 1+
	//var isIE = /*@cc_on!@*/false || testCSS('msTransform');  // At least IE6

	function testCSS(prop) {
	    return prop in document.documentElement.style;
	}
	
	if (isOpera) {
		
		return false;
		
	}else if (isSafari || isChrome) {
		
		return true;
		
	} else {
		
		return false;
		
	}
	
}

/* ---------- IE8 list style hack (:nth-child(odd)) ---------- */

jQuery(document).ready(function($){
	
//	if($('.messagesList').width()) {
//		
//		if(jQuery.browser.version.substring(0, 2) == "8.") {
//
//			$('ul.messagesList li:nth-child(2n+1)').addClass('odd');
//			
//		}
//		
//	}
	
});	

$(document).ready(function(){
				
	/* ---------- Add class .active to current link  ---------- */
	$('ul.main-menu li a.current').each(function(){
		var tmp = $(this);
		tmp.addClass('active');
		tmp.next('ul').slideDown();
		tmp.parents('ul').slideDown();
	});
	
//	$('ul.main-menu li ul li a').each(function(){
//		
//			if($($(this))[0].href==String(window.location)) {
//				
//				$(this).parent().addClass('active');
//				$(this).parent().parent().show();
//				
//			}
//	
//	});
	
	/* ---------- Submenu  ---------- */
	
	$('.dropmenu').click(function(e){
		e.preventDefault();
		$(this).next('ul').slideToggle();
	});
	$('.dropmenu[href] i').click(function(e){
		e.stopPropagation();
		window.location.href = $(this).parent()[0].href;
	})
			
	/* ---------- Acivate Functions ---------- */
//	template_functions();
//	init_masonry();
//	sparkline_charts();
//	charts();
//	calendars();
//	growlLikeNotifications();
//	widthFunctions();
	
	if(jQuery.browser.version.substring(0, 2) == "8.") {
		 
		//disable jQuery Knob
		
	} else {
		
//		circle_progess();
		
	}
	
//	chart();
//	messageLike();	
	
});

/* ---------- Like/Dislike ---------- */

function messageLike(){
	
	if($('.messagesList')) {
		
		$('.messagesList').on('click', '.star', function(){
			
			$(this).removeClass('star');
			
			$(this).addClass('dislikes');
			
			//here add your function
			
		});
		
		$('.messagesList').on('click', '.dislikes', function(){
			
			$(this).removeClass('dislikes');
			
			$(this).addClass('star');
			
			//here add your function
			
		});		
		
	}	
	
}

/* ---------- Check Retina ---------- */

function retina(){
	
	retinaMode = (window.devicePixelRatio > 1);
	
	return retinaMode;
	
}

/* ---------- Numbers Sepparator ---------- */

function numberWithCommas(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1.$2");
    return x;
}


/* ---------- Page width functions ---------- */

$(window).bind("resize", widthFunctions);

function widthFunctions(e) {
	
    var winHeight = $(window).height();
    var winWidth = $(window).width();

	var contentHeight = $("#content").height();

	if (winHeight) {
		
		$("#content").css("min-height",winHeight);
		
	}
	
	if (contentHeight) {
		
		$("#sidebar-left2").css("height",contentHeight);
		
	}
    
	if (winWidth < 980 && winWidth > 767) {
		
		if($("#sidebar-left").hasClass("span2")) {
			
			$("#sidebar-left").removeClass("span2");
			$("#sidebar-left").addClass("span1");
			
		}
		
		if($("#content").hasClass("span10")) {
			
			$("#content").removeClass("span10");
			$("#content").addClass("span11");
			
		}
		
		
		$("a").each(function(){
			
			if($(this).hasClass("quick-button-small span1")) {

				$(this).removeClass("quick-button-small span1");
				$(this).addClass("quick-button span2 changed");
			
			}
			
		});
		
		$(".circleStatsItem, .circleStatsItemBox").each(function() {
			
			var getOnTablet = $(this).parent().attr('onTablet');
			var getOnDesktop = $(this).parent().attr('onDesktop');
			
			if (getOnTablet) {
			
				$(this).parent().removeClass(getOnDesktop);
				$(this).parent().addClass(getOnTablet);
			
			}
			  			
		});
		
		$(".box").each(function(){
			
			var getOnTablet = $(this).attr('onTablet');
			var getOnDesktop = $(this).attr('onDesktop');
			
			if (getOnTablet) {
			
				$(this).removeClass(getOnDesktop);
				$(this).addClass(getOnTablet);
			
			}
			  			
		});
		
		$(".widget").each(function(){
			
			var getOnTablet = $(this).attr('onTablet');
			var getOnDesktop = $(this).attr('onDesktop');
			
			if (getOnTablet) {
			
				$(this).removeClass(getOnDesktop);
				$(this).addClass(getOnTablet);
			
			}
			  			
		});
		
		$(".statbox").each(function(){
			
			var getOnTablet = $(this).attr('onTablet');
			var getOnDesktop = $(this).attr('onDesktop');
			
			if (getOnTablet) {
			
				$(this).removeClass(getOnDesktop);
				$(this).addClass(getOnTablet);
			
			}
			  			
		});
							
	} else {
		
		if($("#sidebar-left").hasClass("span1")) {
			
			$("#sidebar-left").removeClass("span1");
			$("#sidebar-left").addClass("span2");
			
		}
		
		if($("#content").hasClass("span11")) {
			
			$("#content").removeClass("span11");
			$("#content").addClass("span11");
			
		}
		
		$("a").each(function(){
			
			if($(this).hasClass("quick-button span2 changed")) {

				$(this).removeClass("quick-button span2 changed");
				$(this).addClass("quick-button-small span1");
			
			}
			
		});
		
//		$(".circleStatsItem, .circleStatsItemBox").each(function() {
//			
//			var getOnTablet = $(this).parent().attr('onTablet');
//			var getOnDesktop = $(this).parent().attr('onDesktop');
//			
//			if (getOnTablet) {
//			
//				$(this).parent().removeClass(getOnTablet);
//				$(this).parent().addClass(getOnDesktop);
//			
//			}
//			  			
//		});
		
		$(".box").each(function(){
			
			var getOnTablet = $(this).attr('onTablet');
			var getOnDesktop = $(this).attr('onDesktop');
			
			if (getOnTablet) {
			
				$(this).removeClass(getOnTablet);
				$(this).addClass(getOnDesktop);
			
			}
			  			
		});
		
		$(".widget").each(function(){
			
			var getOnTablet = $(this).attr('onTablet');
			var getOnDesktop = $(this).attr('onDesktop');
			
			if (getOnTablet) {
			
				$(this).removeClass(getOnTablet);
				$(this).addClass(getOnDesktop);
			
			}
			  			
		});
		
		$(".statbox").each(function(){
			
			var getOnTablet = $(this).attr('onTablet');
			var getOnDesktop = $(this).attr('onDesktop');
			
			if (getOnTablet) {
			
				$(this).removeClass(getOnTablet);
				$(this).addClass(getOnDesktop);
			
			}
			  			
		});
		
	}
	
//	if($('.timeline')) {
//		
//		$('.timeslot').each(function(){
//			
//			var timeslotHeight = $(this).find('.task').outerHeight();
//			
//			$(this).css('height',timeslotHeight);
//			
//		});
//		
//	}

}