function fetchPosts() {
	var start = 0;
	var limit = 9;
	$(window).on("scroll", function() {
		if($(window).scrollTop() + $(window).height() == $(document).height()) {
			limit += 9;
			
			$.ajax({
				url: "action/fetch.php",
				method: "POST",
				data: {
					start: start,
					limit: limit
				},
				success: function(data) {
					$(".content").html(data);
					postLikes();
					postComments();
					showCommentBox();
				}
			});
		}
	});
}

fetchPosts();