<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $templateTitle; ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/css/_all-skins.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">	
		<header class="main-header">
			<a class="logo" href="index2.html">
          		<span class="logo-lg"><?php echo $templateTitle; ?></span>
        	</a>
			<nav class="navbar navbar-static-top" role="navigation">
				<form method="POST" class="form-horizontal">
					<div class="col-md-4">
						<div class="form-group" style="margin-bottom:0px;margin-top:7px;">
                      		<label class="col-sm-2 col-xs-2 col-md-2 control-label">User:</label>
                      		<div class="col-sm-10 col-xs-10 col-md-10">
								<select class="form-control userSelect" name="user">
									<?php foreach ($users as $u): ?>
									<option value="<?php echo $u->id_user; ?>" <?php echo ($activeUser->id_user == $u->id_user) ? 'selected="selected"' : ''; ?>><?php echo $u->name; ?></option>
									<?php endforeach; ?>
								</select>
	                      	</div>
	                    </div>
                    </div>

				</form>
			</nav>
		</header>
		
		<aside class="main-sidebar">
			<section class="sidebar" style="height: auto;">
				<ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>
					<li class="<?php echo ($template == 'ajax') ? 'active' : ''; ?>"><a href="/"><i class="fa fa-book"></i> <span>Ajax Chat</span></a></li>					
					<li class="<?php echo ($template == 'socket') ? 'active' : ''; ?>"><a href="?site=socket"><i class="fa fa-book"></i> <span>NodeJS Chat</span></a></li>					
				</ul>
			</section>
		</aside>
	
		<div class="content-wrapper">
			<section class="content">