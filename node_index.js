var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var mysql = require('mysql');
var mysql_tools = require('./node_db');


var connection = mysql_tools.create();
connection.connect();

http.listen(3002, function(){
	console.log('listening on *:3002');
});

io.on('connection', function(socket){

	socket.on('disconnect', function(){
	});
	
	socket.on('chat message', function(id_user, msg){
		
		connection.query('SELECT * FROM user WHERE id_user = ?', [id_user], function(err, rows, fields) {
			if ( err == null || err == '' )
			{
				if (rows.length > 0)
				{
					var d = new Date();
					var year = d.getFullYear();
					var month = d.getMonth()+1;
					var day = d.getDate();
					var hour = d.getHours();
					var minutes = d.getMinutes();
					var seconds = d.getSeconds();
					month = month > 9 ? month : '0'+month;
					day = day > 9 ? day : '0'+day;
					hour = hour > 9 ? hour : '0'+hour;
					minutes = minutes > 9 ? minutes : '0'+minutes;
					
					var date = year + '-' + month + '-' + day + ' ' + hour + ':' + minutes + ':' + seconds;
					var dateTxt = hour + ':' + minutes + ':' + seconds + ' ' + day + '-' + month + '-' + year
					
					connection.query('INSERT INTO message SET id_user = ?, message = ?, created_at = ?', [id_user, msg, date], function(err, result){
						
						if ( err ) 
						{
							console.log('INSERT ERROR');
							return connection.rollback(function() {
								throw err;
							});
						}
						else
						{
							var json = {
								id_user: id_user,
								name: rows[0].name,
								image: rows[0].image,
								message: msg,
								created_at: dateTxt
							};
							
							io.emit('chat message', json);
						}
					});
				}
			}
		});		
		
	});	
});

