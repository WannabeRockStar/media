function postLikes() {
	$(".like-btn").on("click", function() {
		var link = $(this);
		var user = $(this).parent().attr("data-user");
		var post = $(this).parent().attr("data-post");

		$.ajax({
			url: "action/like.php",
			method: "POST",
			data: {
				user: user,
				post: post
			},
			success: function(data) {
				link.find(".likes-total").html(data);
			}
		});
	});
}

postLikes();