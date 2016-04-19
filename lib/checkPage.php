<?php 
$pages_available = array('ajax' => 'Ajax Chat', 
						 'socket' => 'NodeJS Chat');

$template = 'ajax';
$templateTitle = $pages_available['ajax'];

if ( array_key_exists('site', $_GET) )
{
	if ( array_key_exists($_GET['site'], $pages_available) )
	{
		$template = $_GET['site'];
		$templateTitle = $pages_available[$_GET['site']];
	}
}