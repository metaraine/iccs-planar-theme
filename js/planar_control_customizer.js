function media_upload(button_class) {

	jQuery('body').on('click', button_class, function(e) {
		var button_id ='#'+jQuery(this).attr('id');
		var display_field = jQuery(this).parent().children('input:text');
		var _custom_media = true;

		wp.media.editor.send.attachment = function(props, attachment){

			if ( _custom_media  ) {
				if(typeof display_field != 'undefined'){
					switch(props.size){
						case 'full':
							display_field.val(attachment.sizes.full.url);
                            display_field.trigger('change');
							break;
						case 'medium':
							display_field.val(attachment.sizes.medium.url);
                            display_field.trigger('change');
							break;
						case 'thumbnail':
							display_field.val(attachment.sizes.thumbnail.url);
                            display_field.trigger('change');
							break;
						case 'planar_team':
							console.log(attachment.sizes);
							display_field.val(attachment.sizes.planar_team.url);
                            display_field.trigger('change');
							break
						case 'planar_services':
							display_field.val(attachment.sizes.planar_services.url);
                            display_field.trigger('change');
							break
						case 'planar_customers':
							display_field.val(attachment.sizes.planar_customers.url);
                            display_field.trigger('change');
							break;
						default:
							display_field.val(attachment.url);
                            display_field.trigger('change');
					}
				}
				_custom_media = false;
			} else {
				return wp.media.editor.send.attachment( button_id, [props, attachment] );
			}
		}
		wp.media.editor.open(button_class);
		window.send_to_editor = function(html) {

		}
		return false;
	});
}


/********************************************
*** General Repeater ***
*********************************************/
function planar_refresh_main_control_values(){
	jQuery(".planar_main_control_repeater").each(function(){
        var values = [];
        var th = jQuery(this);
        th.find(".planar_main_control_repeater_container").each(function(){
            /*var icon_value = jQuery(this).find('.planar_icon_control').val();*/
            var text = jQuery(this).find(".planar_text_control").val();
            var link = jQuery(this).find(".planar_link_control").val();
            var image_url = jQuery(this).find(".custom_media_url").val();
            var choice = jQuery(this).find(".planar_image_choice").val();
            var title = jQuery(this).find(".planar_title_control").val();
            var subtitle = jQuery(this).find(".planar_subtitle_control").val();
            if( text !='' || image_url!='' || title!='' || subtitle!='' ){
                values.push({
                   /* "icon_value" : icon_value,*/
                    "text" : text,
                    "link" : link,
                    "image_url" : image_url,
                    "choice" : choice,
                    "title" : title,
                    "subtitle" : subtitle
                });
            }

        });

        th.find('.planar_repeater_colector').val(JSON.stringify(values));
        th.find('.planar_repeater_colector').trigger('change');
    });
}


jQuery(document).ready(function(){
    
    jQuery('#customize-theme-controls').on('click','.planar-customize-control-title',function(){
        jQuery(this).next().slideToggle('medium', function() {
            if (jQuery(this).is(':visible'))
                jQuery(this).css('display','block');
        });
    });
    
    jQuery('#customize-theme-controls').on('change','.planar_image_choice',function() {
        if(jQuery(this).val() == 'planar_image'){
           /* jQuery(this).parent().parent().find('.planar_main_control_icon').hide();*/
            jQuery(this).parent().parent().find('.planar_image_control').show();
        }     
        planar_refresh_main_control_values();
        return false;        
    });
    media_upload('.custom_media_button_planar');
    jQuery(".custom_media_url").live('change',function(){
        planar_refresh_main_control_values();
        return false;
    });
    
/*
	jQuery("#customize-theme-controls").on('change', '.planar_icon_control',function(){
		planar_refresh_main_control_values();
		return false; 
	});
*/
	jQuery(".planar_main_control_new_field").on("click",function(){
	 
		var th = jQuery(this).parent();
		if(typeof th != 'undefined') {
			
            var field = th.find(".planar_main_control_repeater_container:first").clone();
            if(typeof field != 'undefined'){
                field.find(".planar_image_choice").val('');
                field.find(".planar_main_control_remove_field").show();
                field.find(".planar_text_control").val('');
                field.find(".planar_link_control").val('');
                field.find(".custom_media_url").val('');
                field.find(".planar_title_control").val('');
                field.find(".planar_subtitle_control").val('');
                th.find(".planar_main_control_repeater_container:first").parent().append(field);
                planar_refresh_main_control_values();
            }
			
		}
		return false;
	 });
	 
	jQuery("#customize-theme-controls").on("click", ".planar_main_control_remove_field",function(){
		if( typeof	jQuery(this).parent() != 'undefined'){
			jQuery(this).parent().parent().remove();
			planar_refresh_main_control_values();
		}
		return false;
	});


	jQuery("#customize-theme-controls").on('keyup', '.planar_title_control',function(){
		 planar_refresh_main_control_values();
	});

	jQuery("#customize-theme-controls").on('keyup', '.planar_subtitle_control',function(){
		 planar_refresh_main_control_values();
	});
    
	jQuery("#customize-theme-controls").on('keyup', '.planar_text_control',function(){
		 planar_refresh_main_control_values();
	});
	
	jQuery("#customize-theme-controls").on('keyup', '.planar_link_control',function(){
		planar_refresh_main_control_values();
	});
	
	/*Drag and drop*/
	jQuery(".planar_main_control_droppable").sortable({
		update: function( event, ui ) {
			planar_refresh_main_control_values();
		}
	});

});