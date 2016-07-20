<?php
error_reporting(1);
session_start();
if(isset($_SESSION['u_up'])):
	require 'includes/php/FunctionsUsuarios.php';
	require 'includes/php/FunctionsProveedores.php';
	$obj  = new FunctionsUsuarios();
	$obj2 = new FunctionsProveedores();

	$profile = $obj->getMyProfile($_SESSION['u_up']);

	if($profile['tipoId'] !== '1'){
		header('Location: index.php');
		exit();
	}

	//Get all proveedores
	$allProveedores = $obj2->getAllProveedores();

	//Get all estados
	$allEstadosSelect = $obj2->getAllEstados();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="iso-8859-1">
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

	<style type="text/css">
		input{
			outline: 1px solid #ccc;
		}
	</style>
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
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="index.php">Inicio</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Proveedores</a></li>
				</ul>
				<h1>Proveedores</h1>
				<div class="row-fluid" style="margin-top: 20px;">
					<table class="table table-hover tableProveedores">
						<tr>
							<th>RFC</th>
							<th>Razon Social</th>
							<th>Telefono</th>
							<th>Sitio Web</th>
							<th style="width: 45%;">Direccion</th>
							<th>Acciones</th>
						</tr>
						<?php foreach($allProveedores as $user): ?>
							<tr>
								<th><?php echo $user['RFC']; ?></th>
								<td><?php echo $user['nombre']; ?></td>
								<td><?php echo $user['telefono']; ?></td>
								<td><a href="<?php echo $user['sitio_web']; ?>" target="_blank"><?php echo $user['sitio_web']; ?></a></td>
								<td>
									<?php
										$allCalles 		   = explode('|', $user['calles']);
										$allCallesNumeros  = explode('|', $user['calles_numeros']);
										$allCodigoPostales = explode('|', $user['codigo_postales']);
										$allEstados 	   = explode('|', $user['estados']);
										$allMunicipio 	   = explode('|', $user['municipios']);
										$allLocalidades    = explode('|', $user['localidades']);
									
										if(count($allCalles) == 1){
									?>
											<address>
											Calle <?php echo $allCalles[0]; ?> Numero <?php echo $allCallesNumeros[0]; ?>
											Colonia/Localidad <?php echo $allLocalidades[0]; ?>, <?php echo $allMunicipio[0]; ?>, <?php echo $allEstados[0]; ?> CP <?php echo $allCodigoPostales[0]; ?>
											</address>
									<?php }elseif(count($allCalles) > 1){  
											$allCalles = explode('|', $user['calles']);
											$i = 0;
											for($i = 0; $i < count($allCalles); $i++):
									?>
												<address>
												<p><b>Sucursal <?php echo $i + 1; ?></b></p>
												Calle <?php echo $allCalles[$i]; ?> Numero <?php echo $allCallesNumeros[$i]; ?>
												Colonia/Localidad <?php echo $allLocalidades[$i]; ?>, <?php echo $allMunicipio[$i]; ?>, <?php echo $allEstados[$i]; ?> CP <?php echo $allCodigoPostales[$i]; ?>
												</address>
											<?php endfor; ?>
									<?php } ?>
								</td>
								<td class="center">
									<a href="#myModal3" role="button" data-toggle="modal" data-userId="<?php echo $user['proveedor_id']; ?>" class="btn btn-success btnViewMoreProveedor" title="Ver Mas">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<!--<a href="#myModal5" role="button" data-toggle="modal" data-userId="<?php echo $user['proveedor_id']; ?>" class="btn btn-info btnEditProveedor" title="Editar Proveedor">
										<i class="halflings-icon white edit"></i>  
									</a>-->
									<a href="#myModal4" role="button" data-toggle="modal" data-userId="<?php echo $user['proveedor_id']; ?>" class="btn btn-danger btnDeleteProveedorFirst" title="Eliminar Proveedor">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
					<a href="#myModal" role="button" class="btn btn-success" data-toggle="modal">Agregar Proveedor</a>
			</div><!--end: Content-->
		</div><!--/.row-container-->
	</div><!--/.fluid-container-->
	<div class="clearfix"></div>

	<!-- START MODALS -->
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<h3>Agregar Proveedor</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
							<div class="control-group">
								<label class="control-label" for="focusedInput">RFC</label>
								<div class="controls">
								  <input class="input-xlarge focused rfcProvTxt" maxlength="13" id="focusedInput" type="text" placeholder="RFC">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Razon Social</label>
								<div class="controls">
								  <input class="input-xlarge focused nameProvTxt" id="focusedInput" pattern="[a-zA-Z ]+" type="text" placeholder="Razon Social">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Telefono</label>
								<div class="controls">
								  <input class="input-xlarge telProvTxt" pattern="[()0-9 ]+" type="tel" placeholder="Telefono">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Sitio Web (opcional)</label>
								<div class="controls">
								  <input class="input-xlarge sitioWebProvTxt" type="url" placeholder="Sitio Web (opcional)">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Direccion</label>
								<div class="controls">
									<p>
										<p>Calle</p>
										<input class="input-small calleProvTxt" type="text" placeholder="Calle">
									</p>
									<p>
										<p>Numero</p>
										<input class="input-small numeroProvTxt" type="number" placeholder="Numero">
									</p>
									<p>
										<p>Estado</p>
										<div class="loaderImg"></div>
										<select class="estadoProv" style="width: 100%;">
											<option value="0">-- Seleccionar Estado --</option>
											<?php foreach($allEstadosSelect as $estado): ?>
												<option value="<?php echo $estado['estado_id']; ?>"><?php echo $estado['estado']; ?></option>
										  	<?php endforeach; ?>
										</select>
										<select class="municipioProv" style="width: 100%;">
											<option value="0">-- Seleccionar Municipio/Delegacion --</option>
										</select>
										<select class="localidadProv" style="width: 100%;">
											<option value="0">-- Seleccionar Localidad/Colonia --</option>
										</select>
									<p>
										<p>Codigo Postal</p>
										<input class="input-small cpProvTxt" type="number" maxlength="6" placeholder="Codigo Postal">
									</p>
								</div>
							  </div>
							</fieldset>
						  </div>
					
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="#" class="btn btn-primary addProveedor">Guardar</a>
		</div>
	</div>

	<div id="myModal3" style="width: 51%; left: 45%;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<h3>Ver Mas De Proveedor</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal verMasProveedorModal">

						</div>
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn btn-primary" data-dismiss="modal">Cerrar</a>
		</div>
	</div>

	<div id="myModal4" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Eliminar Proveedor</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<label for="focusedInput"><h1>¿Esta seguro que desea eliminar este proveedor?</h1></label>
							  </div>
							</fieldset>
						  </div>
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="#" class="btn btn-danger btnDeleteProveedor" data-dismiss="modal">Eliminar</a>
		</div>
	</div>
	
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
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
<?php
else:
	header('Location: index.php');
endif;
?>