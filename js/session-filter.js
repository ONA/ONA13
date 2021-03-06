jQuery(document).ready(function(){
	jQuery('.schedule_nav').hover(function(){
		// None
	}, function(){
		jQuery(".types span").text("a session type");
		jQuery(".days span").text("a day");
	});
	jQuery('.buttons .type').hover(function(){
		jQuery(".types span").text('"'+jQuery(this).attr("data:name")+'"');
		jQuery(".days span").text("a day");
	}, function(){
		// None
	});
	jQuery('.buttons .day').hover(function(){
		jQuery(".days span").text(jQuery(this).text());
		jQuery(".types span").text("a session type");
	}, function(){
		// None
	});
	jQuery('.buttons .type').click(function(e) {
        var button = jQuery(this).index();
		var day = jQuery(this).parent().parent().parent().index(".session-day");
		var dayPosition =  jQuery('#title'+day).offset().top - jQuery("body").scrollTop();
		
		jQuery('.single-session').parent().hide();
		if (button==3){
			jQuery('.single-session.Listen').parent().show();
		} else if (button==4){
			jQuery('.single-session.Solve').parent().show();
		} else if (button==5){
			jQuery('.single-session.Make').parent().show();
		} else if (button==6){
			jQuery('.single-session.Midway').parent().show();
		} else if (button==7){
			jQuery('.single-session.Other').parent().show();
			jQuery('.single-session.Keynote').parent().show();
		} else if (button==8){
			jQuery('.single-session').parent().show();
		}
		var newOffset = jQuery('#title'+day).offset().top - dayPosition;
		jQuery("html, body").scrollTop(newOffset);
    });
	jQuery('.buttons .day').click(function(e) {
		var day = jQuery(this).index();
		jQuery("html, body").animate({ scrollTop: jQuery('#title'+day).offset().top - 40 }, 1000);
	});

});