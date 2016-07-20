<?php
error_reporting(0);
session_start();
if(isset($_SESSION['u_up'])):
	require 'includes/php/FunctionsUsuarios.php';
	require 'includes/php/FunctionsClientes.php';
	require 'includes/php/FunctionsTelefono.php';
	$obj  = new FunctionsUsuarios();
	$obj2 = new FunctionsClientes();
	$obj3 = new FunctionsTelefono();

	//Get my profile
	$profile = $obj->getMyProfile($_SESSION['u_up']);

	//Get all clientes
	$allClientes = $obj2->getAllClientes();

	if($profile['tipoId'] == "1"):
		//Get all client type
		$allTipoClientes = $obj2->getTipoClientes();
	endif;
	
	//Get all tipo de telefonos
	$allTipoTel = $obj3->getAllTipoTel();
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
		var userType = <?php echo $profile['tipoId'] ?>;
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
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="index.php">Inicio</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Clientes</a></li>
				</ul>
				<h1>Clientes</h1>
				<div class="row-fluid tableClientes" style="margin-top: 20px;">
					<input type="text" class="form-control searchClienteTxt" placeholder="Buscar Cliente Por Nombre O CURP..." style="outline: 1px solid #ccc; width: 98.5%;" />
					<table class="table table-hover tableClientesInner">
						<?php if($profile['tipoId'] == '1'): ?>
							<tr>
								<th>CURP</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Tipo De Cliente</th>
								<th>Fecha De Registro<br />(aaaa-mm-dd)</th>
								<th>Telefono(s)</th>
								<th>Acciones</th>
							</tr>
							<?php foreach($allClientes as $user): ?>
								<tr>
									<th><?php echo $user['CURP']; ?></th>
									<td><?php echo $user['nombre']; ?></td>
									<td><?php echo $user['apellido_pat']; ?></td>
									<td><?php echo $user['apellido_mat']; ?></td>
									<td>
										<?php if($user['tipo'] === "Normal"): ?>
											<?php echo '<span class="label label-important">' . $user['tipo'] . '</span>'; ?>
										<?php else: ?>
											<?php echo '<span class="label label-warning">' . $user['tipo'] . '</span>'; ?>
										<?php endif; ?>
									</td>
									<td><?php echo $user['fecha_registro']; ?></td>
									<td>
										<?php
											if(!empty($user['telefonos'])):
												$allTipos = explode('|', $user['tipos_tel']);
												$allTelefonos = explode('|', $user['telefonos']);
												$i = 0;
												foreach($allTelefonos as $telefono):
													echo '- ' . $telefono . '<br />[' . $allTipos[$i] . ']<br />';
													$i++;
												endforeach;
											else:
												echo '<span>No hay telefonos.</span>';
											endif;
										?>
									</td>
									<td class="center">
										<a href="#myModal3" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-success btnViewMoreCliente" title="Ver Mas">
											<i class="halflings-icon white zoom-in"></i>  
										</a>
										<a href="#myModal5" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-info btnEditCliente" title="Editar Cliente">
											<i class="halflings-icon white edit"></i>  
										</a>
										<a href="#myModal4" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-danger btnDeleteClienteFirst" title="Eliminar Cliente">
											<i class="halflings-icon white trash"></i> 
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php else: ?>
							<tr>
								<th>ID</th>
								<th>Nombre</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Tipo De Cliente</th>
								<th>Fecha De Registro<br />(aaaa-mm-dd)</th>
								<th>Telefono(s)</th>
								<th>Acciones</th>
							</tr>
							<?php foreach($allClientes as $user): ?>
								<tr>
									<th><?php echo $user['cliente_id']; ?></th>
									<td><?php echo $user['nombre']; ?></td>
									<td><?php echo $user['apellido_pat']; ?></td>
									<td><?php echo $user['apellido_mat']; ?></td>
									<td>
										<?php if($user['tipo'] === "Normal"): ?>
											<?php echo '<span class="label label-important">' . $user['tipo'] . '</span>'; ?>
										<?php else: ?>
											<?php echo '<span class="label label-warning">' . $user['tipo'] . '</span>'; ?>
										<?php endif; ?>
									</td>
									<td><?php echo $user['fecha_registro']; ?></td>
									<td>
										<?php
											if(!empty($user['telefonos'])):
												$allTipos = explode('|', $user['tipos_tel']);
												$allTelefonos = explode('|', $user['telefonos']);
												$i = 0;
												foreach($allTelefonos as $telefono):
													echo '- ' . $telefono . '<br />[' . $allTipos[$i] . ']<br />';
													$i++;
												endforeach;
											else:
												echo '<span>No hay telefonos.</span>';
											endif;
										?>
									</td>
									<td class="center">
										<a href="#myModal3" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-success btnViewMoreCliente" title="Ver Mas">
											<i class="halflings-icon white zoom-in"></i>  
										</a>
										<a href="#myModal5" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-info btnEditCliente" title="Editar Cliente">
											<i class="halflings-icon white edit"></i>  
										</a>
										<a href="#myModal4" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-danger btnDeleteClienteFirst" title="Eliminar Cliente">
											<i class="halflings-icon white trash"></i> 
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</table>
				</div>
			<a href="#myModal" role="button" class="btn btn-success" data-toggle="modal">Nuevo Cliente</a>			
			</div><!--end: Content-->
		</div><!--/.row-container-->
	</div><!--/.fluid-container-->
	<div class="clearfix"></div>
	
	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Agregar Cliente</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Nombre(s)</label>
								<div class="controls">
								  <input class="input-xlarge focused nameClienteTxt" id="focusedInput" pattern="[a-zA-Z ]+" type="text" placeholder="Nombre(s)">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Apellido Paterno</label>
								<div class="controls">
								  <input class="input-xlarge apellidoPatClienteTxt" pattern="[a-zA-Z ]+" type="text" placeholder="Apellido Paterno">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Apellido Materno</label>
								<div class="controls">
								  <input class="input-xlarge apellidoMatClienteTxt" pattern="[a-zA-Z ]+" type="text" placeholder="Apellido Paterno">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">CURP</label>
								<div class="controls">
								  <input class="input-xlarge curpClienteTxt" pattern="[a-zA-Z0-9 ]+" type="text" placeholder="ej. MOTJ941020HDF0B4">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError">Seleccionar Tipo De Cliente</label>
								<div class="controls control-tipoCliente">
								    <?php if($profile['tipoId'] == '1'): ?>
									    <select data-rel="chosen" class="tipoCliente">
										  	<option value="0">-- Seleccionar Tipo De Cliente --</option>
										  	<?php foreach($allTipoClientes as $tipoCliente): ?>
												<option value="<?php echo $tipoCliente['tipoCliente_id']; ?>"><?php echo $tipoCliente['tipo']; ?></option>
										  	<?php endforeach; ?>
									    </select>
								    <?php else: ?>
								  		<select data-rel="chosen" class="tipoCliente" disabled>
										  	<option value="1">Normal</option>
									  	</select>
									<?php endif; ?>
								</div>
							 </div>
							 <div class="control-group">
								<label class="control-label">Correo Electronico</label>
								<div class="controls">
								  <input class="input-xlarge correoClienteTxt" type="email" placeholder="ejemplo@ejemplo.com">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Dirección De Domicilio</label>
								<div class="controls">
								  <input class="input-xlarge direccionClienteTxt" pattern="[a-zA-Z0-9. ]+" type="text" placeholder="Dirección De Domicilio">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Telefono</label>
								<div class="controls">
								  <input class="input-xlarge telClienteTxt" type="text" pattern="[()0-9 ]+" placeholder="Ej. (712) 123 4567">
								</div>
								<div class="controls control-tipoTel" style="margin-top: 10px;">
								  <select data-rel="chosen" class="tipoTelCliente">
								  	<option value="0">-- Seleccionar Tipo De Telefono --</option>
								  	<?php foreach($allTipoTel as $tipoTel): ?>
										<option value="<?php echo $tipoTel['tipoTel_id']; ?>"><?php echo $tipoTel['tipo']; ?></option>
								  	<?php endforeach; ?>
								  </select>
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
			<a href="#" class="btn btn-primary addCliente">Guardar</a>
		</div>
	</div>

	<div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Ver Mas De Cliente</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal verMasClienteModal">

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
			<h3>Eliminar Cliente</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<label for="focusedInput"><h1>¿Esta seguro que desea eliminar este cliente?</h1></label>
							  </div>
							</fieldset>
						  </div>
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="#" class="btn btn-danger btnDeleteCliente" data-dismiss="modal">Eliminar</a>
		</div>
	</div>

	<div id="myModal5" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Editar Cliente</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal editClienteModal">
						</div>
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="#" class="btn btn-primary btnEditClienteSecond">Actualizar</a>
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