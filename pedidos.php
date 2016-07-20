<?php
error_reporting(1);
session_start();
if(isset($_SESSION['u_up'])):
	require 'includes/php/FunctionsUsuarios.php';
	require 'includes/php/FunctionsLibros.php';
	require 'includes/php/FunctionsProveedores.php';
	require 'includes/php/FunctionsPedidos.php';
	$obj  = new FunctionsUsuarios();
	$obj2 = new FunctionsLibros();
	$obj3 = new FunctionsProveedores();
	$obj4 = new FunctionsPedidos();

	//Get my profile.
	$profile = $obj->getMyProfile($_SESSION['u_up']);

	//Get all libros
	$allLibros = $obj2->getLibrosNoExistencias();

	//Get all proveedores
	$allProveedores = $obj3->getAllProveedores();

	if($profile['tipoId'] == "1"):
		//Get all pedidos
		$allPedidos = $obj4->getAllPedidos();
	endif;
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
		var userType = 0;
	</script>

	<style>
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
					<li><a href="#">Pedidos</a></li>
				</ul>
				<h1>Pedidos</h1>
				<?php if($profile['tipoId'] == '1'){ ?>
					<table class="table table-hover tablePedidos">
						<tr>
							<th>ID Pedido</th>
							<th>Cliente</th>
							<th>Anticipo</th>
							<th>Valor Venta Total</th>
							<th>Cantidad Restante</th>
							<th>Acciones</th>
						</tr>
						<?php foreach($allPedidos as $pedido): ?>
							<tr>
								<td><?php echo $pedido['pedido_id']; ?></td>
								<td>
									<?php echo "<b>" . $pedido['CURP'] . "</b> - " . $pedido['nombre_cliente'] . " " . $pedido['apellido_pat'] . " " . $pedido['apellido_mat']; ?>
								</td>
								<td><?php echo "$" . number_format($pedido['anticipo'], 2); ?></td>
								<td><?php echo "$" . number_format($pedido['valor_total'], 2); ?></td>
								<td><?php echo "$" . number_format((double) $pedido['valor_total'] - (double) $pedido['anticipo'], 2); ?></td>
								<td class="center">
									<a href="#myModal3" role="button" data-toggle="modal" data-pedidoId="<?php echo $pedido['pedido_id']; ?>" class="btn btn-success btnViewMorePedido" title="Ver Mas">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a href="#myModal4" role="button" data-toggle="modal" data-pedidoId="<?php echo $pedido['pedido_id']; ?>" class="btn btn-danger btnDeletePedidoFirst" title="Eliminar Pedido">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				<?php }elseif($profile['tipoId'] !== '1' && isset($_GET['realizar'])){ ?>
					<div class="row-fluid sortable">
						<div class="box span12">
							<div class="box-header" data-original-title>
								<h2><i class="halflings-icon edit"></i><span class="break"></span>Levantar Pedido</h2>
							</div>
							<div class="box-content">
								<div class="form-horizontal">
									<fieldset>
									  <div class="control-group">
										<label class="control-label">ID Cliente</label>
										<div class="controls">
										  <input class="input-xlarge idClientePedido" style="width: 50%" type="number"  placeholder="ID Cliente">
										</div>
									  </div>
									  <div class="control-group">
										<label class="control-label" for="focusedInput">Libro(s)</label>
										<div class="controls">
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
															<a role="button" data-bookId="<?php echo $libro['libro_id']; ?>" data-name="<?php echo $libro['nombre']; ?>" data-existencias="<?php echo $libro['numero_copias']; ?>" data-valor="<?php echo $libro['precio']; ?>" class="btn btn-success btnAddToPedido" title="Agregar A Pedido">
																<i class="halflings-icon white plus"></i>  
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											</table>
										</div>
									  </div>
									  <div class="control-group">
										<label class="control-label">Proveedor</label>
										<div class="controls control-provrPedido">
										    <select data-rel="chosen" class="provPedido">
											  	<option value="0">-- Seleccionar Tipo --</option>
											  	<?php foreach($allProveedores as $proveedor): ?>
													<option value="<?php echo $proveedor['proveedor_id']; ?>"><?php echo $proveedor['nombre']; ?></option>
											  	<?php endforeach; ?>
											</select>
										</div>
									  </div>
									  <div class="control-group">
										<label class="control-label">Anticipio (50% min)</label>
										<div class="controls">
											<div class="input-prepend input-append" style="width: 50%">
												<span class="add-on">$</span><input id="appendedPrependedInput" style="width: 94.5%" size="16" type="number" class="anticipoPedido">
											</div>
										</div>
									  </div>
									  <div class="control-group">
										<label class="control-label">Libros En Pedido</label>
										<div class="controls row librosEnPedido">

										</div>
									  </div>
									  <div class="form-actions row">
									  	<span class="span3">
											<button type="submit" class="btn btn-primary btnAddPedido" style="width: 100%;">Levantar Pedido</button>
											<button type="submit" class="btn btnClearPedido" style="width: 100%; margin-top: 5px;">Eliminar Pedido</button>
									 	</span>
									 	<span class="anticipoTxt span5"></span>
									 	<span class="span4"><span class="resPedido"></span></span>
									  </div>
									</fieldset>
								  </div>
							</div>
						</div><!--/span-->
					
					</div><!--/row-->
				<?php }else{ ?>
					Nothing to show.
				<?php } ?>			
			</div><!--end: Content-->
		</div><!--/.row-container-->
	</div><!--/.fluid-container-->
	<div class="clearfix"></div>

	<div id="myModal3" class="modal hide fade" style="width: 51%; left: 45%;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Ver Mas De Pedido</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal verMasPedidoModal">

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
			<h3>Eliminar Pedido</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<label for="focusedInput"><h1>¿Esta seguro que desea eliminar este pedido?</h1></label>
							  </div>
							</fieldset>
						  </div>
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="#" class="btn btn-danger btnDeletePedido" data-dismiss="modal">Eliminar</a>
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