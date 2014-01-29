function slideFrame(thumbid, direction, type, match_height)
	{
		/* Set the new position & frame number */
		
		move_by = jQuery(thumbid).parent().width();

		frame_left = jQuery(thumbid).css(type).replace("px", "");
		frame = (-(frame_left/move_by));

		maxsize = (jQuery(thumbid).children("li").size()/3-1);

		if(direction == 0)
			{
				new_frame =  Math.round((frame/1)+1);
				if(jQuery.browser.msie)
					maxsize = (maxsize-1); 
					
				if(maxsize <= frame)
					new_frame = 0;
			}
		else
			{

				new_frame = Math.round((frame/1)-1);
				
				if(frame == 0)
					new_frame = maxsize;					

			}	
		new_left = -(new_frame*(move_by+12))+"px";
		jQuery(thumbid).animate({"left": new_left}, {duration: 500});
	}	



jQuery(document).ready(function()
	{
	jQuery('#active').iphoneStyle({
		  checkedLabel: 'ACTIVE',
		  uncheckedLabel: 'OFF'
	});
	
	jQuery( "#clear" ).live("click", function(){
		reset = confirm("Are you sure you want to clear your settings and return to defaults?");
		if(!reset)
			return false;
	});

	jQuery("input[id^='clear-']").live("change", function(){
		radionid = jQuery(this).attr("id").replace("clear-", "no-");
		if(jQuery(this).attr("checked") !== "checked")
			{
				jQuery("#"+radionid).eq(0).attr("checked", "checked");
				jQuery(this).parent().next().children("div").eq(0).children("ul").children(".active").removeClass("active");
//	.html()
				jQuery(this).parent().next().slideUp();
			}
		else
			{
				jQuery("#"+radionid).eq(0).attr("checked", "");
				jQuery(this).parent().next().slideDown();
			}
	});
	// Edit prompt
	jQuery(function(){
		var changed = false;
		
		jQuery('input, textarea, select, checkbox').change(function(){
			changed = true;
		});
		
		jQuery('.nav-tab-wrapper a').click(function(){
			if (changed) {
				window.onbeforeunload = function() {
				    return "The changes you made will be lost if you navigate away from this page.";
				}
			} else {
				window.onbeforeunload = '';
			}
		});
		
		jQuery('.submit input').click(function(){
			window.onbeforeunload = '';
		});
	});

	jQuery( "#launchdate" ).datetimepicker({
		dateFormat: "yy/mm/dd"
	});
	
	jQuery(".next").live("click", function(){
		elem = jQuery(this).parent().parent().children(".available-headers");//.children(".default-header");
		slideFrame(elem.children("ul"), 0, "left", false);
		return false;
	});
	jQuery(".prev").live("click", function(){
		elem = jQuery(this).parent().parent().children(".available-headers");//.children(".default-header");
		slideFrame(elem.children("ul"), 1, "left", false);
		return false;

	});
	jQuery(".default-header").live("click", function(){
		jQuery(this).parent().children(".active").removeClass("active");
		jQuery(this).addClass("active");
	});
	
	jQuery(".home-page-order" ).sortable({
		over: function(event, ui) {jQuery(this).children().css({cursor: 'move'});},
		stop: function() {jQuery(this).children().css({cursor: ''})}
	});
});
