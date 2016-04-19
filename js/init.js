$(function(){
	var updateJqxhr = null;
	var loader = $('.box-header .loader');
	var clearInterval = null;

	function scrollDown(duration){
		var directChat = $('.direct-chat-messages');
		var heights = directChat.find('> div');
		var height = 0;
		$.each(heights, function(){
			height += $(this).outerHeight(true);
		});
		
		directChat.stop(true, false).animate({
			scrollTop: height
		}, duration)
	}

	function showLoader(){
		loader.stop(true, false).fadeIn('slow');
	}

	function hideLoader(){
		loader.stop(true, false).fadeOut('slow');
	}		
	
	function updateMessageList(){
		$.ajax({
			type: 'POST',
			data: '?',
			beforeSend: function(jqxhr, s){
				if (updateJqxhr != null)
					updateJqxhr.abort();

				s.data = $.param({ message_list: true });
				updateJqxhr = jqxhr;
				showLoader();
			},
			success: function(data){
				hideLoader();
				$('.ajax-chat .direct-chat-messages').html(data);
				updateJqxhr = null;

				scrollDown(500);
			},
			error: function(){
				hideLoader();
				updateJqxhr = null;
			}
		});
	}

	function autoUpdate(){
		if ($('.ajax-chat').length == 0)
			return false;
		
		clearInterval = setInterval(function(){
			updateMessageList();
		}, 5000);
	}

	scrollDown(0);
	autoUpdate();
	
	$('.userSelect').on('change', function(){
		var form = $(this).parents('form');
		form.submit();
	});

	$(document).off('click', '.updateMessage');
	$(document).on('click', '.updateMessage', function(){
		updateMessageList();

		return false;
	});

	$(document).off('submit', '.messageForm');
	$(document).on('submit', '.messageForm', function(){
		$(this).find('.addMessage').click();
		return false;
	});

	var isSended = false;
	$(document).off('click', '.ajax-chat .addMessage');
	$(document).on('click', '.ajax-chat .addMessage', function(){
		if ( isSended == false )
		{
			isSended = true;
			var form = $(this).parents('form');
			var message = form.find('.message');
			var messageVal = $.trim(message.val());

			if ( messageVal != '')
			{
				$.ajax({
					type: 'POST',
					data: '?',
					beforeSend: function(jqxhr, s){
						s.data = form.serialize();
						showLoader();
					},
					success: function(data){
						message.val('');
						isSended = false;

						updateMessageList();
					},
					error: function(){
						isSended = false;
						hideLoader();
					}
				});
			}
		}

		return false;
	});	
	
	var template = '<div class="direct-chat-msg ${direct_right}">' + 
		'<div class="direct-chat-info clearfix">' + 
			'<span class="direct-chat-name ${name_pull}">${name}</span>' + 
			'<span class="direct-chat-timestamp ${timestamp_pull}">${created_at}</span>' + 
		'</div>' + 
		'<img alt="message user image" src="${image}" class="direct-chat-img">' + 
		'<div class="direct-chat-text">' + 
		  '${message}' + 
		'</div>' + 
	'</div>';
	
	var id_user = null;
	var socket = io('http://chat.mynote.pl:3001');
	
	$('.nodejs .nodeMessageForm').submit(function(){
	var message = $(this).find('.message');
	var user = $(this).find('.id_user');
	id_user = parseInt(user.val());
	
	socket.emit('chat message', id_user, message.val());
	message.val('');
	
	return false;
	});
	
	socket.on('chat message', function(data){
	
	var tmp = template;
	if (data.id_user == id_user)
	{
		tmp = tmp.replace('${direct_right}', '');
		tmp = tmp.replace('${name_pull}', 'pull-left');
		tmp = tmp.replace('${timestamp_pull}', 'pull-right');
	}
	else
	{
		tmp = tmp.replace('${direct_right}', 'right');
		tmp = tmp.replace('${name_pull}', 'pull-right');
		tmp = tmp.replace('${timestamp_pull}', 'pull-left');		
	}
	
	tmp = tmp.replace('${message}', data.message);
	tmp = tmp.replace('${name}', data.name);
	tmp = tmp.replace('${image}', data.image);
	tmp = tmp.replace('${created_at}', data.created_at);
	
	$('.nodejs .direct-chat-messages').append(tmp);
	scrollDown(500);
	});	
});