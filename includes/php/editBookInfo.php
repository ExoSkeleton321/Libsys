<?php
error_reporting(1);
if(isset($_POST['bookId'])){
	require 'FunctionsLibros.php';
	require 'FunctionsProveedores.php';
	$obj  = new FunctionsLibros();
	$obj2 = new FunctionsProveedores();

	//Get book info
	$book = $obj->getLibroInfo($_POST['bookId']);

	//Get all tipo de libros
	$allTipoLibros = $obj->getLibrosGeneros();

	//Get all proveedores
	$allProveedores = $obj2->getAllProveedores();
?>
	<html>
	<head>
		<link rel="stylesheet" href="js/cleditor/jquery.cleditor.css" />
	    <script src="js/jquery-1.9.1.min.js"></script>
	    <script src="js/cleditor/jquery.cleditor.min.js"></script>
	    <script>
	        $(document).ready(function () { $("#cleditor").cleditor(); });
	    </script>
	</head>
	<body>
	<form action="includes/php/updateBook.php" id="formEditBook" method="POST" enctype="multipart/form-data" autocomplete="off">
		<fieldset>
			<input type="hidden" name="bookId" value="<?php echo $book['libro_id']; ?>" />
			<div class="control-group">
				<label class="control-label">Imagen Actual</label>
				<div class="controls">
					<img src="img/Libros/<?php echo $book['libro_id']; ?>.png" style="width: 150px; height: auto;">
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Seleccionar Nueva Imagen</label>
				<div class="controls">
					<input class="input-file uniform_on" required id="fileInput" name="photoBook" type="file" accept="image/png, image/jpeg, image/jpg"/>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Nombre</label>
				<div class="controls">
					<input class="form-control" name="nameBook" value="<?php echo $book['nombre']; ?>" required type="text" placeholder="Nombre Del Libro" style="width: 68.5%; outline: 1px solid #ccc;" />
				</div>
			</div>
			<div class="control-group hidden-phone">
				<label class="control-label" for="textarea2">Descripción</label>
				<div class="controls">
					<textarea id="cleditor" name="descriptionBook" required id="textarea2" rows="3" value=""><?php echo $book['descripcion']; ?></textarea>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Fecha De Publicacion</label>
				<div class="controls">
					<input class="form-control" name="publishDateBook" value="<?php echo $book['fecha_publicacion']; ?>" type="date" placeholder="yyyy-mm-dd" style="border: none; outline: 1px solid #ccc;" />
					<p>
						<small>Actual: 
							<?php 
								$dateExplode = explode('-', $book['fecha_publicacion']);
								echo $dateExplode[2] . '-' . $dateExplode[1] . '-' , $dateExplode[0]; 
							?>
						</small>
					</p>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">ISBN</label>
				<div class="controls">
					<input maxlength="13" value="<?php echo $book['ISBN']; ?>" name="isbnBookUpdate" required type="text" placeholder="ISBN" style="width: 68.5%; text-transform: uppercase; outline: 1px solid #ccc;" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Numero De Paginas</label>
				<div class="controls">
					<input class="form-control" value="<?php echo $book['numero_paginas']; ?>" name="pageNumberBook" required type="number" placeholder="Numero De Pagina" style="width: 68.5%; border: none; outline: 1px solid #ccc;" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Edición</label>
				<div class="controls">
					<input class="form-control" value="<?php echo $book['edicion']; ?>" name="editionBook" required type="number" placeholder="Edición" style="width: 68.5%; border: none; outline: 1px solid #ccc;" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Precio</label>
				<div class="controls">
					<div class="input-prepend input-append">
						<span class="add-on">$</span>
						<input id="appendedPrependedInput" value="<?php echo $book['precio']; ?>" class="form-control" name="priceBook" required required type="text" placeholder="30.50" style="outline: 1px solid #ccc;" />
					</div>
			  	</div>
			</div>
			<div class="control-group">
				<label class="control-label">Cantidad De Libros</label>
				<div class="controls">
					<input class="form-control" value="<?php echo $book['numero_copias']; ?>" name="amountBook" required type="number" placeholder="Cantidad De Libros" style="width: 68.5%; border: none; outline: 1px solid #ccc;" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Tipo De Libros</label>
				<div class="controls">
					<select required name="genreBook">
					  	<option value="<?php echo $book['tipoId']; ?>">-- Actual: <?php echo $book['tipo']; ?> --</option>
					  	<?php foreach($allTipoLibros as $genero): ?>
							<option value="<?php echo $genero['tipoLibro_id']; ?>"><?php echo $genero['tipo']; ?></option>
					  	<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Codigo De Posicionamiento</label>
				<div class="controls">
					<input class="form-control" value="<?php echo $book['codigo_alfanumerico']; ?>" name="codeBook" required type="text" placeholder="Codigo De Posicionamiento" style="width: 68.5%; border: none; outline: 1px solid #ccc; text-transform: uppercase;" />
				</div>
			</div>
			<div class="control-group">
				<label class="control-label">Agregar Proveedor</label>
				<div class="controls">
					<select class="proveedorBook">
					  	<option value="0">-- Agregar Proveedor --</option>
					  	<?php foreach($allProveedores as $proveedor): ?>
							<option value="<?php echo $proveedor['proveedor_id']; ?>"><?php echo $proveedor['nombre']; ?></option>
					  	<?php endforeach; ?>
					</select>
					<i class="halflings-icon plus addProveedorBtn" data-bookId="<?php echo $book['libro_id']; ?>" style="cursor: pointer;"></i>
					<span class="loaderBoxOuter"></span>
				</div>
			</div>

		</fieldset>
	</form>
	</body>
	</html>
<?php
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}