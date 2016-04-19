<?php 
function getQuery($fields, $exclude = array(), $type = Query::insert)
{
	$result = array();
	$values = array();

	foreach ($fields as $key => $value)
	{
		if (!in_array($key, $exclude))
			$result[$key] = ':'.$key;
	}
	
	if ($type == Query::update)
	{
		$result = implode(', ', array_map(function ($v, $k) { return sprintf("%s = %s", $k, $v); }, $result, array_keys($result)));
		
		return $result;
	}
	else
	{
		$keys = array_keys($result);
		$keys = implode(', ', $keys);
		$v = implode(', ', $result);
		
		return array('keys' => $keys, 'values' => $v);
	}
}

function getUsers(){
	$conn = Database::getInstance();
	
	$select = $conn->prepare("SELECT * FROM user");
	$select->execute();	
	
	$result = $select->fetchAll(PDO::FETCH_ASSOC);
	
	$array = array();
	foreach ($result as $r)
	{
		$array[] = new User($r);
	}

	return $array;
}

function getMessages(){
	$conn = Database::getInstance();
	
	$select = $conn->prepare("SELECT * FROM message");
	$select->execute();	
	
	$result = $select->fetchAll(PDO::FETCH_ASSOC);
	
	$array = array();
	foreach ($result as $r)
	{
		$array[] = new Message($r);
	}

	return $array;
}

function getActiveUser(){
	$users = getUsers();
	$activeUser = null;
	
	if (count($users) > 0)
	{
		$activeUser = $users[0];
		if (isset($_POST['user']))
		{
			$idUser = intval($_POST['user']);
			$usr = User::getById($idUser);
		
			if ($usr instanceof User)
				$activeUser = $usr;
		
				setcookie("user", $activeUser->id_user, time()+3600*24*7);
				header("Location: index.php");
		}
		
		$isUserCookie = isset($_COOKIE['user']);
		if ($isUserCookie)
		{
			$user = User::getById(intval($_COOKIE['user']));
		
			if ($user instanceof User)
				$activeUser = $user;
		}
	}
	
	return $activeUser;
}