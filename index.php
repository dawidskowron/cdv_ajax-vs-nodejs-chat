<?php 
session_start();
ob_start();

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

include_once 'lib/Database.class.php';
include_once 'lib/enum/Query.class.php';
include_once 'lib/checkPage.php';
include_once 'lib/om/User.class.php';
include_once 'lib/om/Message.class.php';
include_once 'lib/functions.php';

$users = getUsers();
$messages = getMessages();
$activeUser = getActiveUser();

if ( isset($_POST['add_message']) )
{
	include 'message_add.php';
	return true;
}
elseif ( isset($_POST['message_list']) )
{
	include 'message_list.php';
	return true;
}

include 'template/index.php';
?>