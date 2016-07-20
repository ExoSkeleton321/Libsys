<?php 
session_start();
if(isset($_POST['type'], $_POST['query'])):
	require 'FunctionsUsuarios.php';
	$obj = new FunctionsUsuarios();
	if($_POST['type'] == 'name') {
		$users = $obj->searchForUserByName($_POST['query']);
	?>
		<h2 style="margin-top: 20px;">Termino: <?php echo '<b>' . $_POST['query'] . '</b>'; ?> | Resultados(<?php echo count($users); ?>)</h2>
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
			<?php if(!$users){echo '<tr><td colspan="3"><b>No se encontraron usuarios.</b></td></tr>';} ?>
			<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user['usuario_id']; ?></td>
					<td><?php echo $user['nombre']; ?></td>
					<td><?php echo $user['apellido_pat']; ?></td>
					<td><?php echo $user['apellido_mat']; ?></td>
					<td><?php echo $user['tipo']; ?></td>
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
						<a href="#myModal4" role="button" data-toggle="modal" data-userId="<?php echo $user['usuario_id']; ?>" class="btn btn-danger btnDeleteUserFirst" title="Eliminar Usuario">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php
	}elseif($_POST['type'] == 'id'){
		$users = $obj->searchForUserById($_POST['query']);
	?>
		<h2 style="margin-top: 20px;">ID: <?php echo '<b>' . $_POST['query'] . '</b>'; ?> | Resultados(<?php echo count($users); ?>)</h2>
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
			<?php if(!$users){echo '<tr><td colspan="3"><b>No se encontraron usuarios.</b></td></tr>';} ?>
			<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user['usuario_id']; ?></td>
					<td><?php echo $user['nombre']; ?></td>
					<td><?php echo $user['apellido_pat']; ?></td>
					<td><?php echo $user['apellido_mat']; ?></td>
					<td><?php echo $user['tipo']; ?></td>
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
						<a href="#myModal4" role="button" data-toggle="modal" data-userId="<?php echo $user['usuario_id']; ?>" class="btn btn-danger btnDeleteUserFirst" title="Eliminar Usuario">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php
	}elseif($_POST['type'] == 'username'){
		$users = $obj->searchForUserByUsername($_POST['query']);
	?>
		<h2 style="margin-top: 20px;">Usuario: <?php echo '<b>' . $_POST['query'] . '</b>'; ?> | Resultados(<?php echo count($users); ?>)</h2>
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
			<?php if(!$users){echo '<tr><td colspan="3"><b>No se encontraron usuarios.</b></td></tr>';} ?>
			<?php foreach($users as $user): ?>
				<tr>
					<td><?php echo $user['usuario_id']; ?></td>
					<td><?php echo $user['nombre']; ?></td>
					<td><?php echo $user['apellido_pat']; ?></td>
					<td><?php echo $user['apellido_mat']; ?></td>
					<td><?php echo $user['tipo']; ?></td>
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
						<a href="#myModal4" role="button" data-toggle="modal" data-userId="<?php echo $user['usuario_id']; ?>" class="btn btn-danger btnDeleteUserFirst" title="Eliminar Usuario">
							<i class="halflings-icon white trash"></i> 
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php
	}
endif;

