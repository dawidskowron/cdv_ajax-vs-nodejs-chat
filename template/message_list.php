
<?php if (isset($messages)): ?>
	<?php foreach ($messages as $m): ?>
		<?php 
		$user = $m->getUser(); 
		$name = null;
		$image = null;
		
		try {
			$created_at = new DateTime($m->created_at);
			$created_at_txt = $created_at->format('H:i:s d-m-Y');
		}
		catch (Exception $e) {
			$created_at = null;
			$created_at_txt = "";
		}
		
		if ($user instanceof User)
		{
			$name = $user->name;
			$image = $user->image;
		}
	
		$sameUser = $m->id_user == $activeUser->id_user;
		?>
		
		<div class="direct-chat-msg <?php echo (!$sameUser) ? 'right' : ''; ?>">
			<div class="direct-chat-info clearfix">
				<span class="direct-chat-name <?php echo (!$sameUser) ? 'pull-right' : 'pull-left'; ?>"><?php echo $name; ?></span>
				<span class="direct-chat-timestamp <?php echo (!$sameUser) ? 'pull-left' : 'pull-right'; ?>"><?php echo $created_at_txt; ?></span>
			</div><!-- /.direct-chat-info -->
			<img alt="message user image" src="<?php echo $image; ?>" class="direct-chat-img"><!-- /.direct-chat-img -->
			<div class="direct-chat-text">
			  <?php echo $m->message; ?>
			</div><!-- /.direct-chat-text -->
		</div>
	<?php endforeach; ?>
<?php endif; ?>