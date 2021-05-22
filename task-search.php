<?php
	include('database.php'); 

	// Se almacena el valor que pasa por el cuadro de texto en la variable de search
	$search = $_POST['search'];

	// Si la variable esta vacia endicar los siguiente...
	if(!empty($search)){
		// Crear la consulta que busque un nombre y que coincida con el valor pasado en search
		$query = "SELECT * FROM tareas WHERE name LIKE '$search%'";
		/*  Conectar la base de datos y ejecutar la consulta. La conexion a la base de datos esta almacenada en
		 el archivo database.php*/ 
		$result = mysqli_query($connection, $query);  

		// Si el resultado de la conexion y la consulta no es la esperada, realizar lo siguiente...
		if(!$result){
			// Imprimir un mensaje de error
			die('Query error'.mysqli_error($connection));
		}
		// Se crea una variable para alamcenar un array
		$json = array();
		// Iterar cada elemento obtenido de la consulta y asignarlo a la variable $row
		while($row = mysqli_fetch_array($result)){
			// Luego asignar cada valor almacenado en $row y aignarlo nuevamente al array anteriormente creado
			$json[] = array(
				'name' => $row['name'],
				'description' => $row['description'],
				'id' => $row['id']
			);
		}
		// Al ejecutarse este metodo devuelve el Json en formato String
		$jsonstring = json_encode($json);
		echo $jsonstring; 
	}

?>