<?php 
class User {
	private $fields;
	
	public function __construct($array = null)
	{
		$this->fields = array('id_user' => '',
							  'name' => '',
							  'image' => ''
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
	
		$select = $conn->prepare("SELECT * FROM user WHERE id_user = :userid");
		$select->bindParam(':userid', $id, PDO::PARAM_INT);
		$select->execute();
	
		$result = $select->fetch(PDO::FETCH_ASSOC);
	
		if ( is_array($result) )
		{
			return new User($result);
		}
	
		return null;
	}	
}
?>