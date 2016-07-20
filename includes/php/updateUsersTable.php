<?php
session_start();

require 'FunctionsUsuarios.php';
$obj = new FunctionsUsuarios();

//Get my profile
$profile = $obj->getMyProfile($_SESSION['u_up']);

//Get all users
$allUsers = $obj->getAllUsuarios();
?>
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