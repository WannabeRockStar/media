function addNewPost() {
	$("#share-btn").on("click", function(e) {
		e.preventDefault();
		var txt = $(".post-txt").val();
		var user = $(".post-txt").attr("data-user");
		
		if(txt.length < 1 || $.trim(txt) == '') {
			$(".err").text("Field is empty").addClass("error");
			return false;
		} else {
			$.ajax({
				url: "action/post.php",
				method: "POST",
				data: {
					txt: txt,
					user: user
				},
				success: function(data) {
					$(".content").html(data);
					postLikes();
					postComments();
					showCommentBox();
				}
			});
		}
		
		var txt = $(".post-txt").val("");

	});
}

addNewPost();