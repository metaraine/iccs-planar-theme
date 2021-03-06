/*global INFSCR */

jQuery(function($) {

    var count = 2;
	var total = INFSCR.max_num_pages;

	function loadArticle(pageNumber) {
		$('#infinite-loader').fadeIn('fast');
        $.ajax({
            url: INFSCR.wpurl + "/wp-admin/admin-ajax.php",
            type:'POST',
            data: "action=infinite_scroll&page_no=" + pageNumber + "&post_type=" + INFSCR.post_type + "&cattags=" + INFSCR.cattags,
            success: function(html){
				$('#infinite-loader').fadeOut();
                $(html).appendTo("#content").hide().fadeIn();
            }
        });
        return false;
    }

	$(document).scroll(function() {

		if ( (window.innerHeight + window.scrollY) === $(document).height() ) {

			if (count > total) {
				return false;
			}else{
				loadArticle(count);
			}
			count++;
		}
	});

});