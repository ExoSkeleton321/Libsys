<?php
session_start();
if(isset($_SESSION['u_up'])):
	require 'includes/php/FunctionsIndexPage.php';
	$obj = new FunctionsIndexPage();

	//Get my profile.
	$profile = $obj->getMyProfile($_SESSION['u_up']);

	//Get how many users exist
	$userCount = $obj->getNumeroUsuarios();

	//Get how many books exist
	$bookCount = $obj->getNumeroLibros();

	//Get how many clients exist
	$clientCount = $obj->getNumeroClientes();

	//Get how many pedidos exist
	$pedidosCount = $obj->getNumeroPedidos();

	//Get how many proveedores exist
	$provCount = $obj->getNumeroProveedores();
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
</head>
<body>
	<!-- start: Header -->
	<?php include 'includes/header.php'; ?>
	<!-- start: Header -->
	
	<div class="container-fluid-full">
		<?php if($profile['tutorial'] == "0"): ?>
			<div class="tut0">
				<h1>Bienvenido <?php echo $profile['nombre'] . " " . $profile['apellido_pat']; ?></h1>
				<p>
					<p>
						Hemos detectado que es su primera vez utilizando este sistema, por lo que a continuación se le brindara un poco de ayuda con todas las opciones que le va a hacer de utilidad.
					</p>
					<p>
						Usted esta ha iniciado session como: <b><?php echo $profile['tipo']; ?></b>
					</p>
					<p style="text-align: right;">
						<a href="#" class="skipTutorial">Saltar Ayuda</a> | <a href="#" class="next">Siguiente</a>
					</p>
				</p>
			</div>
		<?php endif; ?>

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
				<?php if($profile['tutorial'] == "0"): ?>
					<div class="backdrop"></div>
				<?php endif; ?>	
			
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="index.php">Inicio</a> 
						<i class="icon-angle-right"></i>
					</li>
					<li><a href="#">Principal</a></li>
				</ul>
				<?php if($profile['tipoId'] == '1'): ?>
					<div class="row-fluid">	
						<a class="quick-button metro yellow span2" href="usuarios">
							<i class="icon-group"></i>
							<p>Usuarios</p>
							<span class="badge"><?php echo $userCount[0]; ?></span>
						</a>
						<a class="quick-button metro black span2" href="clientes">
							<i class="icon-user"></i>
							<p>Clientes</p>
							<span class="badge"><?php echo $clientCount[0]; ?></span>
						</a>
						<a class="quick-button metro green span2" href="libros">
							<i class="icon-book"></i>
							<p>Libros</p>
							<span class="badge"><?php echo $bookCount[0]; ?></span>
						</a>
						<a class="quick-button metro blue span2"href="ventas">
							<i class="icon-bar-chart"></i>
							<p>Ventas</p>
						</a>
						<a class="quick-button metro purple span2" href="pedidos">
							<i class="icon-shopping-cart"></i>
							<p>Pedidos De Clientes</p>
							<span class="badge"><?php echo $pedidosCount[0]; ?></span>
						</a>
						<!--<a class="quick-button metro red span2" href="editoriales">
							<i class="icon-star"></i>
							<p>Editoriales</p>
							<span class="badge">46</span>
						</a>-->
						<a class="quick-button metro pink span2" href="proveedores">
							<i class="icon-barcode"></i>
							<p>Proveedores</p>
							<span class="badge"><?php echo $provCount[0]; ?></span>
						</a>						
						<div class="clearfix"></div>			
					</div><!--/row-->
				<?php else: ?>
					<div class="row-fluid">	
						<a href="libros?buscar" class="quick-button metro green span2">
							<i class="icon-book"></i>
							<p>Buscar Libros</p>
							<span class="badge"><?php echo $bookCount[0]; ?></span>
						</a>
						<a  href="ventas?realizar" class="quick-button metro blue span2">
							<i class="icon-shopping-cart"></i>
							<p>Realizar Venta</p>
						</a>
						<a href="pedidos?realizar" class="quick-button metro yellow span2">
							<i class="icon-barcode"></i>
							<p>Realizar Pedido</p>
						</a>
						<a href="clientes?buscar" class="quick-button metro black span2">
							<i class="icon-user"></i>
							<p>Clientes</p>
							<span class="badge"><?php echo $clientCount[0]; ?></span>
						</a>
						<div class="clearfix"></div>			
					</div><!--/row-->
				<?php endif; ?>
								
			</div><!--end: Content-->
		</div><!--/.row-container-->
	</div><!--/.fluid-container-->
	<div class="clearfix"></div>
	
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
	if(isset($_POST['user'], $_POST['pass'])){
		require 'includes/php/FunctionsLogIn.php';
		$login = new FunctionsLogIn();
		$user = trim($_POST['user']);
		$pass = trim($_POST['pass']);

		$logcheck = $login->login($user, $pass);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Iniciar Sesion - Control De Liberia</title>
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
			body { background: url(img/bg-login.jpg) !important; }
		</style>
		
		
		
</head>

<body>
		<div class="container-fluid-full">
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<div class="icons">
						<a href="#"><i class="halflings-icon home"></i></a>
						<a href="#"><i class="halflings-icon cog"></i></a>
					</div>
					<h2>Ingrese A Su Cuenta</h2>
					<form class="form-horizontal" action="" method="post" autocomplete="off">
						<fieldset>
							<?php
								if(isset($logcheck)){
									echo $logcheck;
								}
							?>
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="halflings-icon user"></i></span>
								<input class="input-large span10" name="user" id="username" type="text" placeholder="Usuario/Correo Electronico"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="halflings-icon lock"></i></span>
								<input class="input-large span10" name="pass" id="password" type="password" placeholder="Contraseña" data-rel="popover" data-content="Contraseña Original: dd/mm/aa de su nacimiento." />
							</div>
							<div class="clearfix"></div>
							
							<div class="button-login">	
								<button type="submit" class="btn btn-primary">Iniciar Sesion</button>
							</div>
							<div class="clearfix"></div>
					</form>	
				</div><!--/span-->
			</div><!--/row-->
			

	</div><!--/.fluid-container-->
	
		</div><!--/fluid-row-->
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
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
endif;
?>