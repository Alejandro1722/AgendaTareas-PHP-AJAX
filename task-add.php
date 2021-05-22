<?php
	include('database.php');

	// Si exite una variable con el nombre de la propiedad name 
	if(isset($_POST['name'])) {
		
		$name = $_POST['name'];
		$description = $_POST['description'];
		// Consulta que sirve para agregar datos a la tabla en la base de datos
		$query = "INSERT into tareas(name, description) VALUES('$name','$description')";
		$result = mysqli_query($connection, $query); 
		// Si la conexion falla imprime el error, si no, 'Save successfully' 
		if(!$result){
			die('Query failed.');
		}
		echo 'Saved succesfully';  
	}
?>