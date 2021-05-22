<?php 
	
	include('database.php');

	// Si exite un metodo POST con el nombre id, realizar la siguiente tarea 
	if(isset($_POST['id'])){

		// Asignar a la variable $id el valor obtenido por el metodo POST
		$id = $_POST['id'];
		// Se crea la consulta que elimina una fila según el id ingresado 
		$query = "DELETE FROM tareas WHERE id = $id";
		// Código de conexción. La función solicita como parametros los datos de conexion y la consulta
		$result = mysqli_query($connection, $query);
		// Si la conexion falla imprime el error, si no, 'Eleminated successfully' 
		 if(!$result){
			die('Query failed.');
		}
		echo 'Eliminated succesfully'; 
	}
	
?>