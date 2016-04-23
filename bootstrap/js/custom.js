/*	$(document).ready(function() {
		$('.nav li.dropdown').hover(function() {
			$(this).addClass('open');
		}, function() {
			$(this).removeClass('open');
		});
	}); */

	//Initial load of page
	$(document).ready(sizeContent);
	
	//Every resize of window
	$(window).resize(sizeContent);
	
	//Dynamically assign height
	function sizeContent() {
		var sticky = $(".footer").height();
		$("body").css("margin-bottom", sticky);
	}
	
	
	/* Like Button */
	function eyeLike(postID) { 
		if (postID !== '') { 
			var likeButton = jQuery('#eyeLike-' + postID);
			likeButton.find('> span').text('...');
			//alert(postID);
			jQuery.post(eye_script.theme_url + '/inc/like.php', { 
				id : postID 
			}, function (data) { 
				likeButton.find('> span').text(data);
				likeButton.addClass('active');
				likeButton.attr( { 
					onclick : 'return false;' 
				} );
			} );
		}
		return false;
	}
	

	$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');

});