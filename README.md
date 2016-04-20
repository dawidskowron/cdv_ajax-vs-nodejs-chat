## cdv_ ajax vs. Node.js - chat application

Simple chat differences between ajax and nodejs.<br />
The project was written for pass the subject in Collegium Da Vinci University.

## Used technologies

- AdminLTE
- jQuery
- PHP
- MySQL
- Node.js (express, socket.io, mysql)

## Configuration

import **database.sql** file into MySQL database.<br />

create in **lib/** directory **Database.class.php** file and add following code or rename **lib/Database.class.php.dist** file to **lib/Database.class.php**:<br />
```php 
<?php
class Database {
	
	private static $instance;
	private static $dbDsn = 'mysql:host=localhost;dbname=database;port=3306;charset=utf8';
	private static $dbUser = 'user';
	private static $dbPassword = 'password';
	
	private function __construct() {}
	
	public static function getInstance() {
		 
		if(!self::$instance){
			try {
				self::$instance = new PDO(self::$dbDsn, self::$dbUser, self::$dbPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			catch (PDOException $e)
			{
				die('Cannot connect to Database server');
			}
		}
		 
		return self::$instance;
		 
	}	
}
```

install from npm following libraries:
- express 
```sh
$ npm install express@4.10.2
```
- socket.io
```sh
$ npm install socket.io
```
- mysql
```sh
$ npm install mysql
```

create in project root directory **node_db.js** file and add following code or rename **node_db.js.dist** file to **node_db.js**:<br />
```javascript
var mysql = require('mysql');

module.exports = {
	create: function () {
    	return mysql.createConnection({
    		host : 'localhost',
    		user : 'user',
    		password : 'password',
    		database : 'database'
    	});
	}
};
```

## Description

- In this project we can't add users, it's only simple chat between two defined users. 
- Node.js is listening on port 3002.
```javascript
http.listen(3002, function(){
	console.log('listening on *:3002');
});
```