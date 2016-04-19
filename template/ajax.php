
<div class="ajax-chat">
	<div class="col-md-4">
		<div class="box box-primary direct-chat direct-chat-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Direct Chat</h3>
				<span class="loader"></span>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool updateMessage"><i class="fa fa-refresh"></i></button>
				</div>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="direct-chat-messages">
					<?php include_once 'message_list.php'; ?>	                        
				</div>			
			</div>
			<div class="box-footer">
				<form action="#" method="post" class="messageForm">
					<input type="hidden" name="add_message" value="1">
					<div class="input-group">
						<input type="text" name="message" placeholder="Type Message ..." class="form-control message">
						<span class="input-group-btn">
							<button type="button" class="btn btn-primary btn-flat addMessage">Send</button>
						</span>
					</div>
				</form>
			</div>			
		</div>
	</div>
	
	<div class="clearfix"></div>
</div>