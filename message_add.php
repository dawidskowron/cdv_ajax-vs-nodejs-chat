<?php if ( isset($_POST['message']) ): ?>
	<?php 
		$message = trim($_POST['message']);
		
		if ( $message != '' )
		{
			$msg = new Message();
			$msg->message = $message;
			$msg->id_user = $activeUser->id_user;
			$msg->save();
		}
	?>
<?php endif; ?>