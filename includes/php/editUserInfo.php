<?php
error_reporting(1);
session_start();
if(isset($_POST['userId'])){
	require 'FunctionsUsuarios.php';
	require 'FunctionsTelefono.php';
	$obj  = new FunctionsUsuarios();
	$obj2 = new FunctionsTelefono();

	//Get user info
	$user = $obj->getUserProfile($_POST['userId']);

	//Get all tipo de usarios
	$allTipoUsuarios = $obj->getAllTipoUsuarios();

	//Get all tipo de telefonos
	$allTipoTel = $obj2->getAllTipoTel();
?>
	<fieldset>
		<div class="control-group">
		<label class="control-label" for="focusedInput">Usuario ID</label>
		<div class="controls">
			<input type="number" class="input-xlarge" value="<?php echo $user['usuario_id']; ?>" disabled />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="selectError">Tipo De Usuario</label>
		<div class="controls control-tipoUsuarioUpdate">
			<select id="selectError" data-rel="chosen" class="tipoUsuarioUpdate" style="outline: 1px solid #ccc; width: 92%;">
			  	<option value="<?php echo $user['tipoUsuarioId']; ?>">-- Actual: <?php echo $user['tipo']; ?> --</option>
			  	<?php foreach($allTipoUsuarios as $tipoUsuario): ?>
					<option value="<?php echo $tipoUsuario['tipoUsuario_id']; ?>"><?php echo $tipoUsuario['tipo']; ?></option>
			  	<?php endforeach; ?>
			</select>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="focusedInput">Nombre(s)</label>
		<div class="controls">
			<input type="text" class="nameUsuarioTxtUpdate input-xlarge" value="<?php echo $user['nombre']; ?>" placeholder="Nombre(s)" style="outline: 1px solid #ccc;" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Apellido Paterno</label>
		<div class="controls">
			<input type="text" class="apellidoPatUsuarioTxtUpdate input-xlarge" value="<?php echo $user['apellido_pat']; ?>" placeholder="Apellido Paterno" style="outline: 1px solid #ccc;" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Apellido Materno</label>
		<div class="controls">
			<input type="text" class="apellidoMatUsuarioTxtUpdate input-xlarge" value="<?php echo $user['apellido_mat']; ?>" placeholder="Apellido Materno" style="outline: 1px solid #ccc;" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Correo Electronico</label>
		<div class="controls">
			<input type="text" class="emailUsuarioTxtUpdate input-xlarge" value="<?php echo $user['correo']; ?>" placeholder="Correo Electronico" style="outline: 1px solid #ccc;" />
		</div>
	  </div>
	  <div class="control-group">
	  	<label class="control-label">Fecha De Nacimiento (yyyy-mm-dd)</label>
	  	<div class="controls">
	  		<!--Put selects here-->
	  		<input type="text" value="<?php echo $user['fecha_nacimiento']; ?>" class="fecha_nacimiento" placeholder="Fecha de Nacimiento" disabled />
	  	</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Telefono(s)</label>
		<div class="controls control-tipoUsuarioUpdate">
			<input class="input-xlarge telUsuarioTxtUpdate" type="text" pattern="[()0-9 ]+" placeholder="Nuevo Telefono Ej. (712) 123 4567" style="outline: 1px solid #ccc;" /><br />
			<select data-rel="chosen" class="tipoTelUsuarioUpdate" style="outline: 1px solid #ccc; margin: 10px 0 10px 0; width: 92%;">
			  	<option value="0">-- Seleccionar Tipo De Telefono --</option>
			  	<?php foreach($allTipoTel as $tipoTel): ?>
					<option value="<?php echo $tipoTel['tipoTel_id']; ?>"><?php echo $tipoTel['tipo']; ?></option>
			  	<?php endforeach; ?>
			</select>
			<span class="allTelephones">
				<?php
					if(!empty($user['telefonos'])):
						$allId = explode('|', $user['telId']);
						$allTipos = explode('|', $user['tipos_tel']);
						$allTelefonos = explode('|', $user['telefonos']);
						$i = 0;
						foreach($allTelefonos as $telefono):
							echo '<p>- ' . $telefono . ' [' . $allTipos[$i] . '] <i class="halflings-icon minus-sign deleteTelephone" title="Quitar Telefono" style="vertical-align: inherit; cursor: pointer;" data-phoneId="' . $allId[$i] . '"></i></p>';
							$i++;
						endforeach;
					else:
						echo '<span>No hay telefonos.</span>';
					endif;
				?>
			</span>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Fecha De Registro</label>
		<div class="controls">
			<input type="text" class="input-xlarge" value="<?php echo $user['fecha_registro']; ?>" disabled />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Resetear Contraseña</label>
		<div class="controls">
			<input type="button" class="btn btn-warning resetPass" value="Resetear" />
		</div>
	  </div>
	  <input type="hidden" class="usuarioInicial" value="<?php echo $user['usuario']; ?>" />
	</fieldset>
<?php
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}