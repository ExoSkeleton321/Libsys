<?php 
session_start();
require 'FunctionsLibros.php';
$obj = new FunctionsLibros();

if(isset($_POST['query']) && $_POST['query'] !== ""):
	$books = $obj->searchForBook($_POST['query']);
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
					<a role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" data-price="<?php echo $libro['precio']; ?>" data-name="<?php echo $libro['nombre']; ?>" data-existencias="<?php echo $libro['numero_copias']; ?>" data-numberBooks="1" class="btn btn-primary btnAddToVenta" title="Agregar Libro">
						<i class="halflings-icon white plus"></i>  
					</a>
					<a href="#myModal2" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" data-price="<?php echo $libro['precio']; ?>" data-name="<?php echo $libro['nombre']; ?>" data-numberBooks="1" data-existencias="<?php echo $libro['numero_copias']; ?>" class="btn btnAddVarous" title="Agregar Mas De Un Libro">
						<i class="halflings-icon white plus"></i>  
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
<?php
elseif(isset($_POST['query']) && $_POST['query'] == ""): 
	echo "";
endif;

