function sentMsg() {
	$(".chat-post").on("keyup", function(e) {

		var txt = $(this).val();
		var user_id = $(this).attr("data-user");
		if(txt.length < 2 || $.trim(txt) == "") {
			return false;
		} else {
			if(e.which === 13) {
				e.preventDefault();
				$.ajax({
					url: "action/chat.php",
					method: "POST",
					data: {
						user_id: user_id,
						txt: txt
					},
					success: function(data) {
						console.log(data);
						fetchMsg();
					}
				});

				$(this).val("");
			}
		}
	});
}

function fetchMsg() {
	var toUser = $(".chat-post").attr("data-user");
	$.ajax({
		url: "action/chat.php",
		method: "POST",
		data: {
			to: toUser
		},
		success: function(data) {
			$(".chat-messages").html(data);
			console.log("gijua bakurauli");
			scrollToBottom();
		}
	});
}

sentMsg();

function showChatBox() {
	$(".fr-link").on("click", function(e) {
		e.preventDefault();
		var id = $(this).attr("data-user");
		$(".chat-user-name").text($(this).text());
		$("#chat-box").css("display", "block");
		$(".chat-post").attr("data-user", id);
		fetchMsg();
		scrollToBottom();
	});
}

showChatBox();

function hideChatBox() {
	$("#chat-close-btn").on("click", function() {
		$("#chat-box").css("display", "none");
	});
}

hideChatBox();


setInterval(function() {
	fetchMsg();
	scrollToBottom();
}, 5000);


function scrollToBottom() {
	var chatBox = $('.chat-messages');
	chatBox.scrollTop() = chatBox.scrollHeight;
}

