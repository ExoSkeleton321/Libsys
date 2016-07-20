<?php 
error_reporting(0);
session_start();
require 'FunctionsClientes.php';
require 'FunctionsUsuarios.php';
$obj  = new FunctionsClientes();
$obj2 = new FunctionsUsuarios();

//Get my profile
$profile = $obj2->getMyProfile($_SESSION['u_up']);

if(isset($_POST['query']) && $_POST['query'] !== ""):
	$clientes = $obj->searchForCliente($_POST['query']);
?>
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
		<?php if(!$clientes): ?>
			<tr>
				<th colspan="3">No se encontraron clientes con su criterio.</th>
			</tr>
		<?php endif; ?>
		<?php foreach($clientes as $user): ?>
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
					<a href="#myModal5" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-info btnEditCliente" title="Editar Usuario">
						<i class="halflings-icon white edit"></i>  
					</a>
					<a href="#myModal4" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-danger btnDeleteClienteFirst" title="Eliminar Usuario">
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
		<?php foreach($clientes as $user): ?>
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
<?php
elseif(isset($_POST['query']) && $_POST['query'] == ""): 
	//Get all libros
	$allClientes = $obj->getAllClientes();
?>
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
		<?php if(!$allClientes): ?>
			<tr>
				<th colspan="3">No se encontraron clientes con su criterio.</th>
			</tr>
		<?php endif; ?>
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
					<a href="#myModal5" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-info btnEditCliente" title="Editar Usuario">
						<i class="halflings-icon white edit"></i>  
					</a>
					<a href="#myModal4" role="button" data-toggle="modal" data-userId="<?php echo $user['cliente_id']; ?>" class="btn btn-danger btnDeleteClienteFirst" title="Eliminar Usuario">
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
<?php
endif;

