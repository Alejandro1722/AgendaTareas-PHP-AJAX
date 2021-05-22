<?php
	
	// Usamos una de la librerias de PHP para conectar la base de datos en este caso es mysqli_connect
	$connection = mysqli_connect(
		'localhost',
		'root',
		'',
		'task-app'
	);

	// Si la base de datos esta conectada
	/* if($connection){
		echo 'Database is connected'; 
	}*/
?>