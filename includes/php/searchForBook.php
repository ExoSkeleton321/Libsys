<?php 
session_start();
require 'FunctionsLibros.php';
$obj = new FunctionsLibros();

if(isset($_POST['query']) && $_POST['query'] !== ""):
	if($_POST['userType'] !== "0"):
		$books = $obj->searchForBook($_POST['query']);
	elseif($_POST['userType'] == "0"):
		$books = $obj->searchForBookNoEsxistencias($_POST['query']);
	endif;
?>
		<tr>
			<th style="text-align: center;">ISBN</th>
			<th style="text-align: center;">Nombre</th>
			<th style="text-align: center;">Precio</th>
			<th style="text-align: center;">Existencias</th>
			<th style="text-align: center;">Edicion</th>
			<th style="text-align: center;">Genero</th>
			<th>Acciones</th>
		</tr>
		<?php if(!$books): ?>
			<tr>
				<td colspan="2"><b>No se encontraron libros.</b></td>
			</tr>
		<?php endif; ?>
		<?php foreach($books as $libro): ?>
			<tr>
				<th style="text-align: center;"><?php echo $libro['ISBN']; ?></th>
				<td style="text-align: center;"><?php echo $libro['nombre']; ?></td>
				<td style="text-align: center;"><?php echo $libro['precio']; ?></td>
				<td style="text-align: center;"><?php echo $libro['numero_copias']; ?></td>
				<td style="text-align: center;"><?php echo $libro['edicion']; ?></td>
				<td style="text-align: center;">
					<span class="label label-important">
						<?php echo $libro['tipo']; ?>
					</span>
				</td>
				<td class="center">
				<?php if($_POST['userType'] !== "0"): ?>
					<a href="#myModal3" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-success btnViewMoreBook" title="Ver Mas">
						<i class="halflings-icon white zoom-in"></i>  
					</a>
					<?php if($_POST['userType'] == '1'): ?>
						<a href="#myModal5" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-info btnEditBook" title="Editar Libro">
							<i class="halflings-icon white edit"></i>  
						</a>
						<a href="#myModal4" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-danger btnDeleteBook" title="Eliminar Libro">
							<i class="halflings-icon white trash"></i> 
						</a>
					<?php endif; ?>
				<?php elseif($_POST['userType'] == "0"): ?>
						<a href="#myModal3" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" data-name="<?php echo $libro['nombre']; ?>" data-existencias="<?php echo $libro['numero_copias']; ?>" data-valor="<?php echo $libro['precio']; ?>" class="btn btn-success btnAddToPedido" title="Agregar A Pedido">
							<i class="halflings-icon white plus"></i>  
						</a>
				<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
<?php
elseif(isset($_POST['query']) && $_POST['query'] == ""): 
	if($_POST['userType'] !== "0"):
		//Get all libros
		$allLibros = $obj->getLibros();
	elseif($_POST['userType'] == "0"):
		//Get all libros
		$allLibros = $obj->getLibrosNoExistencias();
	endif;
?>
		<tr>
			<th style="text-align: center;">ISBN</th>
			<th style="text-align: center;">Nombre</th>
			<th style="text-align: center;">Precio</th>
			<th style="text-align: center;">Existencias</th>
			<th style="text-align: center;">Edicion</th>
			<th style="text-align: center;">Genero</th>
			<th>Acciones</th>
		</tr>
		<?php if(!$allLibros): ?>
			<tr>
				<td colspan="2"><b>No se encontraron libros.</b></td>
			</tr>
		<?php endif; ?>
		<?php foreach($allLibros as $libro): ?>
			<tr>
				<th style="text-align: center;"><?php echo $libro['ISBN']; ?></th>
				<td style="text-align: center;"><?php echo $libro['nombre']; ?></td>
				<td style="text-align: center;"><?php echo $libro['precio']; ?></td>
				<td style="text-align: center;"><?php echo $libro['numero_copias']; ?></td>
				<td style="text-align: center;"><?php echo $libro['edicion']; ?></td>
				<td style="text-align: center;">
					<span class="label label-important">
						<?php echo $libro['tipo']; ?>
					</span>
				</td>
				<td class="center">
				<?php if($_POST['userType'] !== "0"): ?>
					<a href="#myModal3" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-success btnViewMoreBook" title="Ver Mas">
						<i class="halflings-icon white zoom-in"></i>  
					</a>
					<?php if($_POST['userType'] == '1'): ?>
						<a href="#myModal5" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-info btnEditBook" title="Editar Libro">
							<i class="halflings-icon white edit"></i>  
						</a>
						<a href="#myModal4" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-danger btnDeleteBook" title="Eliminar Libro">
							<i class="halflings-icon white trash"></i> 
						</a>
					<?php endif; ?>
				<?php elseif($_POST['userType'] == "0"): ?>
						<a href="#myModal3" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" data-name="<?php echo $libro['nombre']; ?>" data-existencias="<?php echo $libro['numero_copias']; ?>" data-valor="<?php echo $libro['precio']; ?>" class="btn btn-success btnAddToPedido" title="Agregar A Pedido">
							<i class="halflings-icon white plus"></i>  
						</a>
				<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
<?php
endif;

