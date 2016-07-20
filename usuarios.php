<?php
error_reporting(0);
session_start();
if(isset($_SESSION['u_up'])):
	require 'includes/php/FunctionsUsuarios.php';
	require 'includes/php/FunctionsTelefono.php';
	$obj  = new FunctionsUsuarios();
	$obj2 = new FunctionsTelefono();

	//Get my profile
	$profile = $obj->getMyProfile($_SESSION['u_up']);

	if($profile['tipoId'] !== '1'){
		header('Location: index.php');
		exit();
	}

	//Get all users
	$allUsers = $obj->getAllUsuarios();

	//Get all tipo de telefonos
	$allTipoTel = $obj2->getAllTipoTel();

	//Get all tipo de usarios
	$allTipoUsuarios = $obj->getAllTipoUsuarios();
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
					<li><a href="#">Usuarios</a></li>
				</ul>
				<h1>Usuarios</h1>
				<div class="row-fluid tableUsers" style="margin-top: 20px;">
					<table class="table table-hover">
						<tr>
							<th>Id</th>
							<th>Nombre</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Tipo De Usuario</th>
							<th>Nombre De Usuario</th>
							<th>Fecha De Registro<br />(aaaa-mm-dd)</th>
							<th>Telefono(s)</th>
							<th>Acciones</th>
						</tr>
						<?php foreach($allUsers as $user): ?>
							<tr>
								<td><?php echo $user['usuario_id']; ?></td>
								<td><?php echo $user['nombre']; ?></td>
								<td><?php echo $user['apellido_pat']; ?></td>
								<td><?php echo $user['apellido_mat']; ?></td>
								<td>
									<?php if($user['tipo'] === "Administrador"): ?>
										<?php echo '<span class="label label-important">' . $user['tipo'] . '</span>'; ?>
									<?php else: ?>
										<?php echo '<span class="label label-warning">' . $user['tipo'] . '</span>'; ?>
									<?php endif; ?>
								</td>
								<td><?php echo $user['usuario']; ?></td>
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
									<a href="#myModal3" role="button" data-toggle="modal" data-userId="<?php echo $user['usuario_id']; ?>" class="btn btn-success btnViewMore" title="Ver Mas">
										<i class="halflings-icon white zoom-in"></i>  
									</a>
									<a href="#myModal5" role="button" data-toggle="modal" data-userId="<?php echo $user['usuario_id']; ?>" class="btn btn-info btnEditUser" title="Editar Usuario">
										<i class="halflings-icon white edit"></i>  
									</a>
									<?php if($user['usuario_id'] !== $profile['usuario_id']): ?>
										<a href="#myModal4" role="button" data-toggle="modal" data-userId="<?php echo $user['usuario_id']; ?>" class="btn btn-danger btnDeleteUserFirst" title="Eliminar Usuario">
											<i class="halflings-icon white trash"></i> 
										</a>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</table>
				</div>
				<div class="row-fluid">
					<input type="button" value="Consultar Por ID" class="btn btn-primary byId" />
					<input type="button" value="Consultar Por Nombre" class="btn btn-primary byName" />
					<input type="button" value="Consultar Por Usuario" class="btn btn-primary byUsername" />
					<a href="#myModal" role="button" class="btn btn-success" data-toggle="modal">Agregar Usuario</a>
					<a href="#myModal2" role="button" class="btn btn-success" data-toggle="modal">Nuevo Tipo De Telefono</a>
				</div>

				<div class="row-fluid">
					<div class="span4 hide formByName" style="margin-left: 2.564102564102564%">
						<fieldset>
							<legend>Consultar Un Usuario Por Nombre</legend>
							<label>
								Nombre: <input type="text" id="byNameTxt" pattern="[a-zA-Z ]+" placeholder="Nombre/Apellido" />
							</label>
						</fieldset>
					</div>
					<div class="span4 hide formById">
						<fieldset>
							<legend>Consultar Un Usuario Por ID</legend>
							<label>
								No De Usuario: <input type="number" id="byIdTxt" pattern="[0-9]+" placeholder="Ej. 66586" />
							</label>
						</fieldset>
					</div>
					<div class="span4 hide formByUsername">
						<fieldset>
							<legend>Consultar Un Usuario Por Nombre De Usuario</legend>
							<label>
								Usuario: <input type="text" id="byUsernameTxt" pattern="[a-zA-Z0-9]+" placeholder="Nombre De Usuario" />
							</label>
						</fieldset>
					</div>
				</div>
				<div class="resultSearch row-fluid">
					
				</div>			
			</div><!--end: Content-->
		</div><!--/.row-container-->
	</div><!--/.fluid-container-->
	<div class="clearfix"></div>

	<div class="modal hide fade" id="myModal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Agregar Usuario</h3>
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
								  <input class="input-xlarge focused nameUsuarioTxt" id="focusedInput" pattern="[a-zA-Z ]+" type="text" placeholder="Nombre(s)">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Apellido Paterno</label>
								<div class="controls">
								  <input class="input-xlarge apellidoPatUsuarioTxt" pattern="[a-zA-Z]+" type="text" placeholder="Apellido Paterno">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Apellido Materno</label>
								<div class="controls">
								  <input class="input-xlarge apellidoMatUsuarioTxt" pattern="[a-zA-Z]+" type="text" placeholder="Apellido Paterno">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Correo Electronico</label>
								<div class="controls">
								  <input class="input-xlarge emailUsuarioTxt" type="email" placeholder="Correo Electronico">
								</div>
							  </div>
							  <div class="control-group">
							  	<label class="control-label">Fecha De Nacimiento</label>
							  	<div class="controls">
							  		<span class="form" role="form">
	                                    <select class="form-control fechaNac_mes">
	                                        <option value="0" selected="1">Mes</option>
	                                        <option value="01">Ene</option>
	                                        <option value="02">Feb</option>
	                                        <option value="03">Mar</option>
	                                        <option value="04">Abr</option>
	                                        <option value="05">May</option>
	                                        <option value="06">Jun</option>
	                                        <option value="07">Jul</option>
	                                        <option value="08">Ago</option>
	                                        <option value="09">Sep</option>
	                                        <option value="10">Oct</option>
	                                        <option value="11">Nov</option>
	                                        <option value="12">Dic</option>
	                                    </select>
	                                    <select class="form-control fechaNac_dia">
	                                        <option value="0" selected="1">Dia</option>
	                                        <option value="01">1</option>
	                                        <option value="02">2</option>
	                                        <option value="03">3</option>
	                                        <option value="04">4</option>
	                                        <option value="05">5</option>
	                                        <option value="06">6</option>
	                                        <option value="07">7</option>
	                                        <option value="08">8</option>
	                                        <option value="09">9</option>
	                                        <option value="10">10</option>
	                                        <option value="11">11</option>
	                                        <option value="12">12</option>
	                                        <option value="13">13</option>
	                                        <option value="14">14</option>
	                                        <option value="15">15</option>
	                                        <option value="16">16</option>
	                                        <option value="17">17</option>
	                                        <option value="18">18</option>
	                                        <option value="19">19</option>
	                                        <option value="20">20</option>
	                                        <option value="21">21</option>
	                                        <option value="22">22</option>
	                                        <option value="23">23</option>
	                                        <option value="24">24</option>
	                                        <option value="25">25</option>
	                                        <option value="26">26</option>
	                                        <option value="27">27</option>
	                                        <option value="28">28</option>
	                                        <option value="29">29</option>
	                                        <option value="30">30</option>
	                                        <option value="31">31</option>
	                                    </select>
	                                    <select class="form-control fechaNac_anio">
	                                        <option value="0" selected="1">Año</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option>
	                                    </select>
	                                </span>
							  	</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">Telefono</label>
								<div class="controls">
								  <input class="input-xlarge telUsuarioTxt" type="text" pattern="[()0-9 ]+" placeholder="Ej. (712) 123 4567">
								</div>
								<div class="controls control-tipoTel" style="margin-top: 10px;">
								  <select data-rel="chosen" class="tipoTelUsuario">
								  	<option value="0">-- Seleccionar Tipo De Telefono --</option>
								  	<?php foreach($allTipoTel as $tipoTel): ?>
										<option value="<?php echo $tipoTel['tipoTel_id']; ?>"><?php echo $tipoTel['tipo']; ?></option>
								  	<?php endforeach; ?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError">Seleccionar Tipo</label>
								<div class="controls control-tipoUsuario">
								  <select id="selectError" data-rel="chosen" class="tipoUsuario">
								  	<option value="0">-- Seleccionar Tipo --</option>
								  	<?php foreach($allTipoUsuarios as $tipoUsuario): ?>
										<option value="<?php echo $tipoUsuario['tipoUsuario_id']; ?>"><?php echo $tipoUsuario['tipo']; ?></option>
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
			<a href="#" class="btn btn-primary addUsuario">Guardar</a>
		</div>
	</div>

	<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Nuevo Tipo De Telefono</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Tipo De Telefono</label>
								<div class="controls">
								  <input class="input-xlarge focused tipoTelTxt" id="focusedInput" pattern="[a-zA-Z ]+" type="text" placeholder="Tipo De Telefono">
									<fieldset class="span12">
										<legend>Tipos Ya Existentes</legend>
										<?php foreach($allTipoTel as $tipoTel): ?>
											<p ><?php echo $tipoTel['tipo']; ?></p>
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
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="#" class="btn btn-primary addTipoTel">Guardar</a>
		</div>
	</div>

	<div id="myModal3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Ver Mas De Usuario</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal verMasUsuarioModal">

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
			<h3>Eliminar Usuario</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal">
							<fieldset>
							  <div class="control-group">
								<label for="focusedInput"><h1>¿Esta seguro que desea eliminar este usuario?</h1></label>
							  </div>
							</fieldset>
						  </div>
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="#" class="btn btn-danger btnDeleteUser" data-dismiss="modal">Eliminar</a>
		</div>
	</div>

	<div id="myModal5" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Editar Usuario</h3>
		</div>
		<div class="modal-body">
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-content">
						<div class="form-horizontal editUsuarioModal">
						</div>
					</div>
				</div><!--/span-->
			</div><!-- /row-fluid -->
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Cancelar</a>
			<a href="#" class="btn btn-primary btnEditUserSecond">Actualizar</a>
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