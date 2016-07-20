<?php
error_reporting(1);
session_start();

require 'FunctionsClientes.php';
require 'FunctionsUsuarios.php';
$obj  = new FunctionsClientes();
$obj2 = new FunctionsUsuarios();

//Get my profile
$profile = $obj2->getMyProfile($_SESSION['u_up']);

//Get all clientes
$allClientes = $obj->getAllClientes();
?>
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