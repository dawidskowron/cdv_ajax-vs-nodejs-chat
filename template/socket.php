
<div class="nodejs">
	<div class="col-md-4">
		<div class="box box-primary direct-chat direct-chat-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Direct Chat</h3>
				<span class="loader"></span>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="direct-chat-messages">
					<?php include_once 'message_list.php'; ?>
				</div>			
			</div>
			<div class="box-footer">
				<form action="#" method="post" class="nodeMessageForm">
					<input type="hidden" name="add_message" value="1">
					<input type="hidden" name="id_user" class="id_user" value="<?php echo $activeUser->id_user; ?>">
					<div class="input-group">
						<input type="text" name="message" placeholder="Type Message ..." class="form-control message">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary btn-flat">Send</button>
						</span>
					</div>
				</form>
			</div>			
		</div>
	</div>
	
	<div class="clearfix"></div>
</div>