<?php
error_reporting(0);
session_start();
if(isset($_SESSION['u_up'])):
	require 'includes/php/FunctionsUsuarios.php';
	require 'includes/php/FunctionsLibros.php';
	$obj = new FunctionsUsuarios();
	$obj2 = new FunctionsLibros();

	//Get my profile
	$profile = $obj->getMyProfile($_SESSION['u_up']);

	//Get all libros
	$allLibros = $obj2->getLibros();

	//Get all libros generos
	$allLibrosGeneros = $obj2->getLibrosGeneros();

	//Get all autores
	$allAutores = $obj2->getAllAutores();

	//Get all editoriales
	$allEditoriales = $obj2->getAllEditoriales();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Sistema De Control De Libreria</title>
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<link  href="css/style.css" rel="stylesheet">
	<script>
		var userType = <?php echo $profile['tipoId'] ?>;
	</script>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
	<!-- end: Favicon -->	

	<script>
		var userType = <?php echo $profile['tipoId']; ?>
	</script>
</head>
<body>
	<!-- start: Header -->
	<?php include 'includes/header.php'; ?>
	<!-- start: Header -->
	
	<div class="container-fluid-full">
		<div class="row-fluid">
			<?php include 'includes/leftNavBar.php'; ?>
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Advertencia!</h4>
					<p>Advertencia! Ocupa <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> activado para ver este sitio.</p>
				</div>
			</noscript>
			
			<!-- start: Content -->
			<div id="content" class="span10">
				<ul class="breadcrumb" style="margin-left: -20px; margin-top: -20px;">
					<li>
						<i class="icon-home"></i>
						<a href="index.php">Inicio</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Libros</a></li>
				</ul>
				<h1>Libros</h1>

				<div class="row-fluid tableUsers" style="margin-top: 20px;">
					<?php if(isset($_GET['e1'])): ?>
						<?php echo '<span class="alert alert-error span12"><button type="button" class="close" data-dismiss="alert">×</button>Todo los campos deben ser llenado.</span>'; ?>
					<?php elseif(isset($_GET['e2'])): ?>
						<?php echo '<span class="alert alert-error span12"><button type="button" class="close" data-dismiss="alert">×</button>Imagen no valida, solo se aceptan: png, jpg y jpeg.</span>'; ?>
					<?php elseif(isset($_GET['e3'])): ?>
						<?php echo '<span class="alert alert-error span12"><button type="button" class="close" data-dismiss="alert">×</button>Libro duplicado, escriba uno no existente.</span>'; ?>
					<?php elseif(isset($_GET['e4'])): ?>
						<?php echo '<span class="alert alert-error span12"><button type="button" class="close" data-dismiss="alert">×</button>Hubo un error, intelelo de nuevo.</span>'; ?>
					<?php endif; ?>

					<?php if($profile['tipoId'] == '1'){ ?>
						<input type="text" class="form-control searchBookTxt" placeholder="Buscar Libro Por Nombre O ISBN..." style="outline: 1px solid #ccc; width: 98.5%;" />
						<table class="table table-hover tableBooks">
							<tr>
								<th style="text-align: center;">ISBN</th>
								<th style="text-align: center;">Nombre</th>
								<th style="text-align: center;">Precio</th>
								<th style="text-align: center;">Existencias</th>
								<th style="text-align: center;">Edicion</th>
								<th style="text-align: center;">Genero</th>
								<th>Acciones</th>
							</tr>
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
										<a href="#myModal3" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-success btnViewMoreBook" title="Ver Mas">
											<i class="halflings-icon white zoom-in"></i>  
										</a>
										<a href="#myModal5" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-info btnEditBook" title="Editar Libro">
											<i class="halflings-icon white edit"></i>  
										</a>
										<a href="#myModal4" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-danger btnDeleteBook" title="Eliminar Libro">
											<i class="halflings-icon white trash"></i> 
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</table>
						<a href="#myModal" role="button" class="btn btn-success btnAddBookInitial" data-toggle="modal">Agregar Libro</a>
						<a href="#myModal2" role="button" class="btn btn-success" data-toggle="modal">Nuevo Genero</a>
						<a href="#myModal6" role="button" class="btn btn-success" data-toggle="modal">Nuevo Autor</a>
						<a href="#myModal7" role="button" class="btn btn-success" data-toggle="modal">Nuevo Editorial</a>
					<?php }elseif($profile['tipoId'] !== '1' && isset($_GET['buscar'])){ ?>
						<input type="text" class="form-control searchBookTxt" placeholder="Buscar Libro Por Nombre O ISBN..." style="outline: 1px solid #ccc; width: 98.5%;" />
						<table class="table table-hover tableBooks">
							<tr>
								<th style="text-align: center;">ISBN</th>
								<th style="text-align: center;">Nombre</th>
								<th style="text-align: center;">Precio</th>
								<th style="text-align: center;">Existencias</th>
								<th style="text-align: center;">Edicion</th>
								<th style="text-align: center;">Genero</th>
								<th>Acciones</th>
							</tr>
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
										<a href="#myModal3" role="button" data-toggle="modal" data-bookId="<?php echo $libro['libro_id']; ?>" class="btn btn-success btnViewMoreBook" title="Ver Mas">
											<i class="halflings-icon white zoom-in"></i>  
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
					<?php }else{ ?>
						Nada que enseñar.
					<?php } ?>	
				</div>			
			</div><!--end: Content-->
		</div><!--/.row-container-->
	</div><!--/.fluid-container-->
	<div class="clearfix"></div>

	<div id="myModal3" class="modal hide fade viewMoreBookModalOuter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Ver Mas De Un Libro</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal verMasLibroModal">
						</div>
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>
		</div>
	</div>
	
	<?php if($profile['tipoId'] == '1'): ?>
		<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Nuevo Genero</h3>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="box span12">
						<div class="box-content">
							<div class="form-horizontal">
								<fieldset>
								  <div class="control-group">
									<label class="control-label" for="focusedInput">Tipo De Telefono</label>
									<div class="controls">
									  <input class="input-xlarge focused tipoLibroTxt" id="focusedInput" pattern="[a-zA-Z ]+" type="text" placeholder="Tipo De Telefono">
										<fieldset class="span12 generosLibrosExistentes">
											<legend>Generos Ya Existentes</legend>
											<?php foreach($allLibrosGeneros as $tipoLibro): ?>
												<p><?php echo $tipoLibro['tipo']; ?></p>
										  	<?php endforeach; ?>
										</fieldset>
									</div>
								  </div>
								</fieldset>
							</div>
						</div>
					</div><!--/span-->
				</div><!-- /row-fluid -->
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
				<a href="#" class="btn btn-primary btnAddGenero">Agregar</a>
			</div>
		</div>

		<div id="myModal6" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Nuevo Autor</h3>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="box span12">
						<div class="box-content">
							<div class="form-horizontal">
								<fieldset>
								  <div class="control-group">
									<label class="control-label" for="focusedInput">Nombre del Autor</label>
									<div class="controls">
									  <input class="input-xlarge focused nombreAutorTxt" id="focusedInput" pattern="[a-zA-Z. ]+" type="text" placeholder="Nombre de Autor">
										<fieldset class="span12 autoresExistentes">
											<legend>Autores Ya Existentes</legend>
											<?php foreach($allAutores as $autor): ?>
												<p><?php echo $autor['autor']; ?></p>
										  	<?php endforeach; ?>
										</fieldset>
									</div>
								  </div>
								</fieldset>
							</div>
						</div>
					</div><!--/span-->
				</div><!-- /row-fluid -->
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
				<a href="#" class="btn btn-primary btnAddAutor">Agregar</a>
			</div>
		</div>

		<div id="myModal7" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Nueva Editorial</h3>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="box span12">
						<div class="box-content">
							<div class="form-horizontal">
								<fieldset>
								  <div class="control-group">
									<label class="control-label" for="focusedInput">Nombre de la editorial</label>
									<div class="controls">
									  <input class="input-xlarge focused nombreEditorialTxt" id="focusedInput" pattern="[a-zA-Z ]+" type="text" placeholder="Nombre de la editorial.">
										<fieldset class="span12 editorialesExistentes">
											<legend>Editoriales Ya Existentes</legend>
											<?php foreach($allEditoriales as $editorial): ?>
												<p><?php echo $editorial['editorial']; ?></p>
										  	<?php endforeach; ?>
										</fieldset>
									</div>
								  </div>
								</fieldset>
							</div>
						</div>
					</div><!--/span-->
				</div><!-- /row-fluid -->
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
				<a href="#" class="btn btn-primary btnAddEditorial">Agregar</a>
			</div>
		</div>

		<div class="modal hide fade" id="myModal" style="left: 40%; width: 60%;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Agregar Libro</h3>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="box span12">
						<div class="form-horizontal">
							<form action="includes/php/insertBook.php" id="formInsertBook" method="POST" enctype="multipart/form-data" autocomplete="off">
								<fieldset>
									<div class="control-group">
										<label class="control-label">Seleccionar Imagen</label>
										<div class="controls">
											<div class="uploader" id="uniform-fileInput">
												<input class="input-file uniform_on" required id="fileInput" name="photoBook" type="file" accept="image/png, image/jpeg, image/jpg"/>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Nombre</label>
										<div class="controls">
											<input class="form-control" name="nameBook" required type="text" placeholder="Nombre Del Libro" style="width: 68.5%; outline: 1px solid #ccc;" />
										</div>
									</div>
									<div class="control-group hidden-phone">
										<label class="control-label" for="textarea2">Descripción</label>
										<div class="controls">
											<textarea class="cleditor" name="descriptionBook" required id="textarea2" rows="3"></textarea>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Fecha De Publicacion</label>
										<div class="controls">
											<input class="form-control" name="publishDateBook" required type="date" placeholder="yyyy-mm-dd" style="border: none; outline: 1px solid #ccc;" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">ISBN</label>
										<div class="controls">
											<input class="form-control" maxlength="13" name="isbnBook" required type="text" placeholder="ISBN" style="width: 68.5%; text-transform: uppercase; outline: 1px solid #ccc;" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Numero De Paginas</label>
										<div class="controls">
											<input class="form-control" name="pageNumberBook" required type="number" placeholder="Numero De Pagina" style="width: 68.5%; border: none; outline: 1px solid #ccc;" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Edición</label>
										<div class="controls">
											<input class="form-control" name="editionBook" required type="number" placeholder="Edición" style="width: 68.5%; border: none; outline: 1px solid #ccc;" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Precio</label>
										<div class="controls">
											<div class="input-prepend input-append">
												<span class="add-on">$</span>
												<input id="appendedPrependedInput" class="form-control" name="priceBook" required required type="text" placeholder="30.50" style="outline: 1px solid #ccc;" />
											</div>
									  	</div>
									</div>
									<div class="control-group">
										<label class="control-label">Cantidad De Libros</label>
										<div class="controls">
											<input class="form-control" name="amountBook" required type="number" placeholder="Cantidad De Libros" style="width: 68.5%; border: none; outline: 1px solid #ccc;" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tipo De Libros</label>
										<div class="controls">
											<select id="selectError" required data-rel="chosen" name="genreBook">
											  	<option value="0">-- Seleccionar Tipo --</option>
											  	<?php foreach($allLibrosGeneros as $genero): ?>
													<option value="<?php echo $genero['tipoLibro_id']; ?>"><?php echo $genero['tipo']; ?></option>
											  	<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Autor</label>
										<div class="controls">
											<select required data-rel="chosen" name="authorBook">
											  	<option value="0">-- Seleccionar Autor --</option>
											  	<?php foreach($allAutores as $autor): ?>
													<option value="<?php echo $autor['autor_id']; ?>"><?php echo $autor['autor']; ?></option>
											  	<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Editorial</label>
										<div class="controls">
											<select required data-rel="chosen" name="editorialBook">
											  	<option value="0">-- Seleccionar Editorial --</option>
											  	<?php foreach($allEditoriales as $editorial): ?>
													<option value="<?php echo $editorial['editorial_id']; ?>"><?php echo $editorial['editorial']; ?></option>
											  	<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Codigo De Posicionamiento</label>
										<div class="controls">
											<input class="form-control codeBook" maxlength="9" name="codeBook" required type="text" placeholder="Codigo De Posicionamiento" style="width: 68.5%; border: none; outline: 1px solid #ccc; text-transform: uppercase;" />
										</div>
									</div>

								</fieldset>
							</form>
						</div>

					</div>
				</div><!-- /row-fluid -->
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="#" class="btn btn-primary" onclick="document.getElementById('formInsertBook').submit();">Guardar</a>
			</div>
		</div>

		<div id="myModal4" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Eliminar Libro</h3>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="box span12">
						<div class="box-content">
							<div class="form-horizontal">
								<fieldset>
								  <div class="control-group">
									<label for="focusedInput"><h1>¿Esta seguro que desea eliminar este libro?</h1></label>
								  </div>
								</fieldset>
							  </div>
						</div>
					</div><!--/span-->
				</div><!-- /row-fluid -->
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="#" class="btn btn-danger btnDeleteBookPerm" data-dismiss="modal">Eliminar</a>
			</div>
		</div>

		<div id="myModal5" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="left: 40%; width: 60%;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Editar Libro</h3>
			</div>
			<div class="modal-body">
				<div class="row-fluid">
					<div class="box span12">
						<div class="box-content">
							<div class="form-horizontal editLibroModal">
							</div>
						</div>
					</div><!--/span-->
				</div><!-- /row-fluid -->
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
				<a href="#" class="btn btn-primary" onclick="document.getElementById('formEditBook').submit();">Guardar</a>
			</div>
		</div>
	<?php endif; ?>
	
	<!-- start: JavaScript-->
	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/jquery-migrate-1.0.0.min.js"></script>
	<script src="js/main.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
	<script src="js/jquery.flot.js"></script>
	<script src="js/jquery.flot.pie.js"></script>
	<script src="js/jquery.flot.stack.js"></script>
	<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
<?php
else:
	header('Location: index.php');
endif;
?>