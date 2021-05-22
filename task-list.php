<?php 
	 include('database.php');

	 // Se crea una consulta para obtener todos los datos de la tabla de tareas
	 $query = "SELECT * FROM tareas";
	 // Código de conexción. La función solicita como parametros los datos de conexion y la consulta
	 $result = mysqli_query($connection, $query);

	 // Si la conexion no fue satisfactoria envía código de error
	 if(!$result){
	 	die('Query Failed'.mysqli_error($connection));
	 }
	 // Si la conexión es satisfactoria creara una variable para almacenar un arreglo 
	 $json = array();
	 //Itera los datos obtenidos en la consulta y los asigna a la variable $row. Una fila para cada dato obtenido
	 while($row = mysqli_fetch_array($result)){
	 	//Luego toma el array $json y asigna a la variable $row la columna del dato solicitdo entre las llaves []
	 	$json[] = array(
	 		'name' => $row['name'],
	 		'description' => $row['description'],
	 		'id'=> $row['id']
	 	);
	 }
	 // Al ejecutarse este metodo devuelve el Json en formato String
	 $jsonstring = json_encode($json);
	 echo $jsonstring;
	

?>