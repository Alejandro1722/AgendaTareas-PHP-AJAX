<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<!-- Llamamos a la librería de boostrap -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<title>Task APP</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">	
		<a href="#" class="navbar-brand p-md-3 col-md-8">Task App</a>	
		<ul class="navbar-nav ml-auto">	
			<form class="form-inline my-2 my-lg-0 d-flex justify-content">		
				<input type="search" id="search" class="form-control" placeholder="Search your task">
				<button class="btn btn-success" type="submit">Search</button>	
			</form> 		
		</ul>
	</nav>


	<div class="container p-4">
		<div class="row">
			<div class="col-md-5">
				<div class="card">
					<div class="card-body">
						<form id="task-form">
							<input type="hidden" id="task-id">
							<div class="form-group">
								<input type="text" id="name" placeholder="Task Name" class="form-control W-10">
							</div>
							<div class="form-group">
								<textarea id="description" cols="30" rows="10" class="form-control" placeholder="Task Description"></textarea>
							</div>
							<button type="submit" class="btn btn-primary btn-block text-center">
								Save Task
							</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="card my-4" id="task-result">
					<div class="card-body">
						<ul id="container"></ul>
					</div>
				</div>
					<table class="table table-bordered table-sm">
						<thead>
							<tr>
								<td>Id</td>
								<td>Name</td>
								<td>Description</td>
							</tr>
						</thead>
						<tbody id="tasks"></tbody>
					</table>
			</div>
		</div>		
	</div>

	<!-- Debemos indicar inicialmente la URL de Jquery para que esta pueda ser ejecutada, es recomendable
		descargar siempre la libreria para poder usarla sin internet  -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<!-- Indicamos la ruta de nuestro archvo JS. Siempre se deben colocar abajo de los enlaces de los servicios -->
	<script src="app.js"></script>
	
</body>
</html>