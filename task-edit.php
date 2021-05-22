<?php 

	include('database.php'); 


	$id = $_POST['id'];
	$name = $_POST['name'];
	$description = $_POST['description'];

	/* Se crea la consulta que actualiza una fila según el id ingresado. A cada columna de la tabla en la base de datos se le asigna su variable correspondiente. Cada valor de la columna es el valor pasado por el 
	metodo POST el cual es obtenido en los inputs del formulario*/ 
	$query = "UPDATE tareas SET name = '$name', description = '$description' WHERE id = '$id'";
	// Código de conexción. La función solicita como parametros los datos de conexion y la consulta
	$result = mysqli_query($connection, $query); 
	// Si la conexion falla imprime el error, si no, 'Updated successfully' 
	if(!$result){
			die('Query failed.');
		}
	echo 'Updated succesfully';

?>