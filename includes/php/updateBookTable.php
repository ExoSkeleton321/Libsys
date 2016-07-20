<?php
session_start();

require 'FunctionsLibros.php';
$obj = new FunctionsLibros();

//Get all users
$allLibros = $obj->getLibros();
?>
	<tr>
		<th>ISBN</th>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Fecha De Publicación</th>
		<th>Numero De Paginas</th>
		<th>Edicion</th>
		<th>Tipo</th>
		<th>Acciones</th>
	</tr>
	<?php foreach($allLibros as $libro): ?>
		<tr>
			<th><?php echo $libro['ISBN']; ?></th>
			<td><?php echo $libro['nombre']; ?></td>
			<td><?php echo $libro['precio']; ?></td>
			<td><?php echo $libro['fecha_publicacion']; ?></td>
			<td><?php echo $libro['numero_paginas']; ?></td>
			<td><?php echo $libro['edicion']; ?></td>
			<td>
				<span class="label label-important">
					<?php echo $libro['tipo']; ?>
				</span>
			</td>
			<td class="center">
				<a href="#myModal3" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-success btnViewMoreBook" title="Ver Mas">
					<i class="halflings-icon white zoom-in"></i>  
				</a>
				<a href="#myModal5" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-info" title="Editar Libro">
					<i class="halflings-icon white edit"></i>  
				</a>
				<a href="#myModal4" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-danger btnDeleteBook" title="Eliminar Libro">
					<i class="halflings-icon white trash"></i> 
				</a>
			</td>
		</tr>
	<?php endforeach; ?>