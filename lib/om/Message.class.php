<?php 
class Message {
	private $fields;
	
	public function __construct($array = null)
	{
		$this->fields = array('id_message' => '',
							  'id_user' => '',
							  'message' => '',
							  'created_at' => date('Y-m-d H:i:s')
						);
		
		if (is_array($array))
		{
			foreach ($array as $key => $value)
			{
				$lowerKey = strtolower($key);
				if ( array_key_exists($lowerKey, $this->getFields()) )
					$this->$lowerKey = $array[$key];
			}
		}
	}
	
	private function getFields()
	{
		return $this->fields;
	}
	
	public function __get($field)
	{
		if ( array_key_exists($field, $this->fields) )
			return $this->fields[$field];
		
		return null;
	}
	
	public function __set($field, $value)
	{
		if ( array_key_exists($field, $this->fields) )
		{
			$this->fields[$field] = $value;
		}
	}
	
	public static function getById($id)
	{
		$conn = Database::getInstance();

		$select = $conn->prepare("SELECT * FROM message WHERE id_message = :messageid");
		$select->bindParam(':messageid', $id, PDO::PARAM_INT);
		$select->execute();
		
		$result = $select->fetch(PDO::FETCH_ASSOC);
		
		if ( is_array($result) )
		{
			return new Message($result);
		}
		
		return null;
	}
	
	public function getUser(){
		$user = User::getById($this->id_user);
		if ( $user instanceof User )
			return $user;
		
		return null;
	}
	
	public function save()
	{
		$conn = Database::getInstance();
		$exclude = array();
		
		if ($this->id_message)
		{
			$exclude = array();
			$fields = getQuery($this->fields, array_merge(array('id_user'), $exclude), Query::update);
			$query = $conn->prepare('UPDATE message SET '.$fields.' WHERE id_message = :id_message');		
		}
		else
		{
			$exclude = array('id_message');
			$fields = getQuery($this->fields, $exclude);
			$query = $conn->prepare('INSERT INTO message ('.$fields['keys'].') VALUES ('.$fields['values'].')');
		}
		
		foreach ($this->fields as $key => $v)
		{
			if ( !in_array($key, $exclude) )
			{
				$query->bindValue(':'.$key, $this->$key);
			}
		}
		
		return $query->execute();
	}
}
?>