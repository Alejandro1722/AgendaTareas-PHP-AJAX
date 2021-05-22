$(document).ready(function(){
	/* Iniciamos con una variable de nombre edit para guardar un booleano que luego será utilizada 
	en la función para actualizar datos */ 
	let edit = false; 
	console.log("Jquery is working"); 
	// Seleccione el elemento task-result y ocultarlo 
	$('#task-result').hide();
	fetchTasks(); 

	/* Tomamos el elemento nombrado search (Lo cual es un boton), cuando se realice la funcion de levantar
	 la tecla realizara la función especificada*/
	$('#search').keyup(function(e){
		// Si almacena un valor al input search, realizar lo siguiente 
		if($('#search').val()){
			// Se almacena el valor que se encuentre en el cuadro de texto en la variable Search
			let search = $('#search').val();

			// Con ajax solicitamos informacion de un servidor
			$.ajax({
				// Llamamos el archivo o direccion de nuestro servidor
				url: 'task-search.php',
				// Se usa el metodo POST para recibir y enviar los datos del servidor
				type: 'POST',
				// Enviar el valor del input al servidor
				data: {search},
				// Si el servido a respondido correctamente, enviar una respuesta que luego se imprime en consola
				success: function(response){
					// Este metodo convierte un string en un JSON 
					let tasks = JSON.parse(response); 
					/* Se crea una variable que almecene un string que luego será completado con cada tarea 
					almacenada de en la base de datos */ 
					let template = '';
					/* Se itera cada tarea almacenada en la base de datos y las imprime en multiples <li> y se las
					asigna a la variable template */ 
					tasks.forEach(task => {
						template += `
						<li>
						${task.name}
						</li>`
					});
					// Selecciona un div y los rellena con los datos almacenados en template
					$('#container').html(template); 
					/* Si tenemos elementos que mostrar mostraremos el elemento en task-result y aparecera 
					el recuadro */ 
					$('#task-result').show(); 
				}
			});
		}
	});
	$('#task-form').submit(function(e){
		/* Creamos una constante llamada PostData que almacenara los datos ingresados en el inptut name
		y el textfield description */ 
		const postData = {
			name: $('#name').val(),
			description: $('#description').val(),
			id: $('#task-id').val(),
		};
		/* Se crea una variable llamada URL y es igual a la variable edit. Si la variable edit es falsa
		enviarlo a la variable task-add.php, si es verdadera irá al archivo task-edit.php */ 
		let url = edit === false ? 'task-add.php' : 'task-edit.php';
		/* usando el metodo necesitamos como parametros el archivo o URL donde tomará la consulta (task-add.php), la
		data que se enviará (postData), y luego que se va a realizar cuando reciba una respuesta*/
		$.post(url, postData, function(response){
			console.log(response);
			// El metodo trigger tiene como funcion resetear el formulario
			$('#task-form').trigger('reset'); 
			// Llamamos la funcion fetchTasks para que que refresque la tabla sin necesidad de recargarla
			fetchTasks();
			edit = false; 
		});
		/* Metodo para eliminar el comportamiento por defecto de un formulario. Esto para que no se actualice
		la pagina */ 
		e.preventDefault();
	});

	/* Se crea una función que tiene como tarea iterar todos los elementos de la tabla y almecenarlos en las
	etiquetas correspondientes de filas y columnas. (La explicación de cada linea de código es la misma que se
	uso para obtener los datos ingresados en el search del código de arriba) */ 
	function fetchTasks(){
		$.ajax({
		url: 'task-list.php',
		type: 'GET',
		success: function(response){
			let tasks = JSON.parse(response);
			let template = '';
			tasks.forEach(task =>{
				template +=`
					<tr task-id="${task.id}">
						<td>${task.id}</td>
						<td><a href="#" class="task-item">${task.name}</a></td>
						<td>${task.description}</td>
						<td>
							<button class="task-delete btn btn-danger">
								Delete
							</button>
						</td>
					</tr>`
				});
				$('#tasks').html(template); 
			}
		});
	}
	/* Si se oprime el botón con el nombre de su clase(en este caso es el boton de borrar);
	 realizar la siguiente función */ 
	$(document).on('click','.task-delete', function(){
		// Mostrar un mensaje emergente que indique si se desa eliminar la fila en la base de datos 
		if(confirm('Are you sure you want to delete it?')){
			/* Asignar el valor de Tr al botón que se ha oprimido. perentElement retorna a la 
			clase padre, en este caso como el tr es el padre de la etiqueta td, es necasario colocar el 
			parentElement dos veces para llegar a este*/
			let element = $(this)[0].parentElement.parentElement;
			// Se asigna a la variable id el valor que obtiene del Tr 
			let id = $(element).attr('task-id');
			/* usando el metodo necesitamos como parametros el archivo o URL donde tomará la consulta 
			(task-delete.php), la data que se enviará (id), y luego que se va a realizar cuando reciba una 
			respuesta. En este caso se llama la función de fetchTask*/
			$.post('task-delete.php',{id}, function(response){
				fetchTasks();
			});
		}
	});
	/* Si se oprime el botón con el nombre de su clase (en este caso es el link de name para actualizar);
	 realizar la siguiente función */ 
	$(document).on('click', '.task-item', function(){
		let element = $(this)[0].parentElement.parentElement;
		let id = $(element).attr('task-id');
		/* Usando el metodo post nos dirigimos al archivo task-single para agregar los datos de la tabla 
		en el formulario*/ 
		$.post('task-single.php', {id}, function(response){
			const task = JSON.parse(response);
			// Llenamos el formulario con el nombre y la description de la tabla
			$('#name').val(task.name);
			$('#description').val(task.description);
			$('#task-id').val(task.id); 
			/* Cambiamos el valor de la variable edit, para luego ser utilizada en la función de submit. 
			 Esto con el fin de cambiar el estado del botón de guardar. Solo se actualizara un dato si 
			 ha sido seleccionado el enlace de name*/ 
			edit = true;  
		}); 	
	});
});