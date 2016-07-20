<?php
session_start();
if(isset($_POST['bookId'])){
	require 'FunctionsLibros.php';
	$obj = new FunctionsLibros();

	//Get libro info
	$libro = $obj->getLibroInfo($_POST['bookId']);

?>
	<div class="row" style="margin-left: 0px;">
		<div class="span4">
			<img src="img/Libros/<?php echo $libro['libro_id']; ?>.png" style="width: 250px; height: 350px;" />
		</div>
		<div class="span8">
			<div class="row">
				<span class="span3">
					<b>ISBN</b><br />
					<?php echo $libro['ISBN']; ?>
				</span>
				<span class="span3">
					<b>Nombre</b><br />
					<?php echo $libro['nombre']; ?>
				</span>
				<span class="span3">
					<b>Precio</b><br />
					$<?php echo $libro['precio']; ?>
				</span>
				<span class="span3">
					<b>Fecha De Publicación</b><br />
					<?php 
						$dateExplode = explode('-', $libro['fecha_publicacion']);
						echo $dateExplode[2] . '-' . $dateExplode[1] . '-' , $dateExplode[0]; 
					?>
				</span>
			</div>
			<div class="row" style="margin-top: 10px;">
				<span class="span3">
					<b>Edición</b><br />
					<?php echo $libro['edicion']; ?>
				</span>
				<span class="span3">
					<b>Existencias</b><br />
					<?php echo $libro['numero_copias']; ?>
				</span>
				<span class="span3">
					<b>Genero</b><br />
					<?php echo $libro['tipo']; ?>
				</span>
				<span class="span3">
					<b>Lugar</b><br />
					<?php echo $libro['codigo_alfanumerico']; ?>
				</span>
			</div>
			<div class="row" style="margin-top: 10px;">
				<span class="span3">
					<b>Numero De Paginas</b><br />
					<?php echo $libro['numero_paginas']; ?>
				</span>
			</div>
			<div class="row" style="margin-top: 20px;">
				<div class="span12">
					<b>Descripción</b><br />
					<?php echo $libro['descripcion']; ?>
				</div>
			</div>
			<div class="row" style="margin-top: 20px;">
				<div class="span6">
					<b>Autor(es)</b><br />
					<?php foreach(explode(',', $libro['autores']) as $autorId): 
							$autor = $obj->getAutorInfo($autorId);
					?>
							<p><?php echo $autor['autor']; ?></p>
					<?php endforeach; ?>
				</div>
				<div class="span6">
					<b>Editorial(es)</b><br />
					<?php foreach(explode(',', $libro['editoriales']) as $editorialId): 
							$editorial = $obj->getEditorialInfo($editorialId);
					?>
							<p><?php echo $editorial['editorial']; ?></p>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
<?php
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}