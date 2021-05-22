<?php 

	include ('database.php'); 

	// Asignar a la variable $id el valor obtenido por el metodo POST
		$id = $_POST['id'];
		// Se crea la consulta que busca una fila según el id ingresado
		$query = "SELECT * FROM tareas WHERE id = $id"; 
		// Código de conexción. La función solicita como parametros los datos de conexion y la consulta
		$result = mysqli_query($connection, $query);

		if(!$result) {
			die('Query failed');
		}
		// Se crea una variable para alamcenar un array
		$json = array();
		// Iterar cada elemento obtenido de la consulta y asignarlo a la variable $row. Una fila por cada dato 
		while($row = mysqli_fetch_array($result)){
			// Luego asignar cada valor almacenado en $row y aignarlo nuevamente al array anteriormente creado
			$json[] = array(
				'name' => $row['name'],
				'description' => $row['description'],
				'id' => $row['id']
			);
		}
		// Al ejecutarse este metodo devuelve el Json en formato String
		$jsonstring = json_encode($json[0]);
		echo $jsonstring; 


?>