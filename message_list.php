
<?php if (isset($messages)): ?>
	<?php foreach ($messages as $m): ?>
		<?php include_once 'template/message_list.php'; ?>
	<?php endforeach; ?>
<?php endif; ?>