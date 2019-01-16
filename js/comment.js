function postComments() {
	$(".comment-field").on("keypress", function(e) {
		
		var post_id = $(this).attr("data-post");
		var txt = $(this).val();
		
		if(e.which === 13) {
			if(txt.length < 1 || $.trim(txt) == "") {
				$(".err").text("Field is empty").addClass("error");
				return false;
			} else {
				$.ajax({
					url: "action/comment.php",
					method: "POST",
					data: {
						post_id: post_id,
						txt: txt,
					},
					success: function(data) {
						$(".content").html(data);
						postComments();
						postLikes();
						console.log("die madafaqa");
						showCommentBox();
					}
				});
				$(this).val("");
			}
			
		}
	});
}

postComments();

function showCommentBox() {
	var tr = true;
	
	$(".comment-btn").on("click", function() {
		
		if(tr) {
			$(this).parent().next().find(".comment-box").css("display", "block");
			tr = false;
		} else {
			$(this).parent().next().find(".comment-box").css("display", "none");
			tr = true;
		}
	});
}

showCommentBox();