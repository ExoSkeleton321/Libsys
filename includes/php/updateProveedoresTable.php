<?php
error_reporting(1);
session_start();

require 'FunctionsProveedores.php';
require 'FunctionsUsuarios.php';
$obj  = new FunctionsProveedores();
$obj2 = new FunctionsUsuarios();

//Get my profile
$profile = $obj2->getMyProfile($_SESSION['u_up']);

//Get all clientes
$allProveedores = $obj->getAllProveedores();
?>
	<meta charset="iso-8859-1">
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