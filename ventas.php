<?php
error_reporting(1);
session_start();
if(isset($_SESSION['u_up'])):
	require 'includes/php/FunctionsUsuarios.php';
	require 'includes/php/FunctionsVentas.php';
	$obj  = new FunctionsUsuarios();
	$obj2 = new FunctionsVentas();

	$profile = $obj->getMyProfile($_SESSION['u_up']);

	if(isset($_GET['fec_i'], $_GET['fec_a'])):
		//Get all ventas with dates
		$allVentas = $obj2->getAllVentasBetween($_GET['fec_i'], $_GET['fec_a']);
	else:
		//Get all ventas
		$allVentas = $obj2->getAllVentas();
	endif;

	$allVentas = array_reverse($allVentas);
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

	<script src="js/Chart.js"></script>
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
					<li><a href="#">Ventas</a></li>
				</ul>
				<h1>Ventas</h1>
				<?php if($profile['tipoId'] == '1'){ ?>
					<?php 
						if(isset($_GET['fec_i'], $_GET['fec_a'])):
							$fecha1 = substr($_GET['fec_i'], 8, 2) . "-" . substr($_GET['fec_i'], 5, 2) . "-" . substr($_GET['fec_i'], 0, 4);
							$fecha2 = substr($_GET['fec_a'], 8, 2) . "-" .  substr($_GET['fec_a'], 5, 2) . "-" . substr($_GET['fec_a'], 0, 4);
							echo "<h3><p>Fecha Inicial: " . $fecha1 . "</p><p>Hasta: " . $fecha2 . "</p></h3>";
						endif;
					?>
					<div style="width:100%; height: 590px;">
						<div>
							<canvas id="canvas" style="width: 60%; height: auto;"></canvas>
						</div>
						<?php if(isset($_GET['fec_i'], $_GET['fec_a'])): ?>
							<a href="ventas">&larr; Ver todas las ventas</a>
						<?php endif; ?>
					</div>
					<form action="" method="GET">
						<h3>Filtrar Por Fechas</h3>
						<table>
							<tr>
								<th style="text-align: right;">Fecha Inicial</th>
								<td><input type="date" class="input-xlarge" name="fec_i" placeholder="yyyy-mm-dd" value="<?php if(isset($_GET['fec_i'])): echo $_GET['fec_i']; endif; ?>" /></td>
							</tr>
							<tr>
								<th style="text-align: right;">Fecha De Acabado</th>
								<td><input type="date" class="input-xlarge" name="fec_a" placeholder="yyyy-mm-dd" value="<?php if(isset($_GET['fec_a'])): echo $_GET['fec_a']; endif; ?>" /></td>
							</tr>
							<tr>
								<td><input type="submit" class="btn btn-primary" value="Obtener Ventas" /></td>
							</tr>
						</table>
					</form>
				<?php }elseif($profile['tipoId'] !== '1' && isset($_GET['realizar'])){ ?>
					<!--Make a sale only y dar de alta/consultar cliente. Realizar una venta para alguien no registrado.-->
					<input type="text" class="form-control searchBookTxtVenta" placeholder="Buscar Libro Por Nombre O ISBN..." style="outline: 1px solid #ccc; width: 98.5%;" />
					<table class="table table-hover tableBooks">
					</table>

					<hr class="divider">
					
					<div class="row" style="margin-left: 0; padding: 10px; border: 1px solid #000; background-color: #F9E559;">
						<h1>Articulos en la venta</h1>
						<input type="number" placeholder="ID Cliente" class="idClienteVenta input-small" />
						<div class="bookInVenta"></div>

						<hr class="divider2">

						<div class="row" style="margin-left: 0; font-size: 18px;">
							<div class="span6" style="text-align: right;">
								<b>Sub Total:</b>
							</div>
							<div class="span6">
								<b>$<span class="priceVenta">0.00</span></b>
							</div>
						</div>

						<div class="row" style="margin-left: 0; font-size: 18px;">
							<div class="span6" style="text-align: right;">
								<b>IVA (16&#37;):</b>
							</div>
							<div class="span6">
								<b>$<span class="priceIva">0.00</span></b>
							</div>
						</div>
						<div class="row" style="margin-left: 0; font-size: 18px;">
							<div class="span6" style="text-align: right;">
								<b>Total:</b>
							</div>
							<div class="span6">
								<b>$<span class="priceVentaFinal">0.00</span></b>
							</div>
						</div>

						<hr class="divider2">
						
						<div class="row" style="margin-left: 0; font-size: 18px;">
							<div class="span6" style="text-align: right;">
								<b>Recibido:</b>
							</div>
							<div class="span6">
								<b>$<span class="recibidoTxt">0.00</span></b>
							</div>
						</div>
						<div class="row" style="margin-left: 0; font-size: 18px;">
							<div class="span6" style="text-align: right;">
								<b>Cambio:</b>
							</div>
							<div class="span6">
								<b>$<span class="cambioTxt">0.00</span></b>
							</div>
						</div>
						<div class="responseVenta" style="float: left; font-size: 20px"></div>
					</div>
					<div style="float: right;">
						<span class="btn limpiarVenta" accesskey="z" style="margin-top: 15px; background-color: #EF718E;">
							Limpiar Venta
						</span>
						<a href="#myModal3" role="button" data-toggle="modal" class="btn btnCompletarVenta" style="margin-top: 15px; background-color: #EF7126;">
							Completar Venta
						</a><br />
						<label for="checkRecibo" style="margin-top: 5px;">
							<input type="checkbox" id="checkRecibo" name="reciboCheckBox" /> Imprimir Recibo
						</label>
					</div>
					<div class="responseAjax" style="clear: both;"></div>
					
				<?php }else{ ?>
					Nothing to show.
				<?php } ?>		
			</div><!--end: Content-->
		</div><!--/.row-container-->
	</div><!--/.fluid-container-->
	<div class="clearfix"></div>

	<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Insertar Various</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Cantidad De Libros</label>
								<div class="controls">
								  <input class="input-xlarge focused cantidadDeLibrosEnVenta" id="focusedInput" type="number" placeholder="Cantidad De Libros">
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
			<a href="#" class="btn btn-primary btnAddToVenta" data-numberBooks="1" data-dismiss="modal">Insertar</a>
		</div>
	</div>

	<div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Insertar Dinero Recibido</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<input class="input-xlarge focused dineroRecibido" id="focusedInput" type="number" style="width: 97%; outline: 1px solid #ccc; height: 100px; font-size: 55px;" />
							  </div>
							</fieldset>
						  </div>
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="#" class="btn btn-primary btnDineroRecibido" data-dismiss="modal">Aceptar</a>
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
	<?php if(!isset($_GET['realizar'])): ?>
		<script>
			var lineChartData = {
				labels : [<?php foreach ($allVentas as $venta) { ?>
							<?php echo  '"' . $venta["fecha_venta"] . '"' . ","; ?>
						<?php } ?>],
				datasets : [
					{
						label: "Ventas",
						fillColor : "rgba(255,115,115,0.2)",
						strokeColor : "rgba(255,58,58,1)",
						pointColor : "rgba(255,0,0,1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(255,0,0,1)",
						data : [<?php foreach ($allVentas as $venta) { ?>
									<?php echo $venta['numVentas'] . ","; ?>
								<?php } ?>]
					}
				]

			}

			window.onload = function(){
				var ctx = document.getElementById("canvas").getContext("2d");
				window.myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true
			});
		}


		</script>
	<?php endif; ?>
	<!-- end: JavaScript-->
	
</body>
</html>
<?php
else:
	header('Location: index.php');
endif;
?>