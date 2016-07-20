<?php
session_start();
if(isset($_POST['userId'])){
	require 'FunctionsUsuarios.php';
	$obj = new FunctionsUsuarios();

	$user = $obj->getUserProfile($_POST['userId']);

?>
	<fieldset>
		<div class="control-group">
		<label class="control-label" for="focusedInput">Usuario ID</label>
		<div class="controls">
			<?php echo $user['usuario_id']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="selectError">Tipo De Usuario</label>
		<div class="controls control-tipoUsuario">
			<?php echo $user['tipo']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="focusedInput">Nombre(s)</label>
		<div class="controls">
			<?php echo $user['nombre']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Apellido Paterno</label>
		<div class="controls">
			<?php echo $user['apellido_pat']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Apellido Materno</label>
		<div class="controls">
			<?php echo $user['apellido_mat']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Nombre De Usuario</label>
		<div class="controls">
			<?php echo $user['usuario']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Correo Electronico</label>
		<div class="controls">
			<?php echo $user['correo']; ?>
		</div>
	  </div>
	  <div class="control-group">
	  	<label class="control-label">Fecha De Nacimiento (yyyy-mm-dd)</label>
	  	<div class="controls">
	  		<?php echo $user['fecha_nacimiento']; ?>
	  	</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Telefono(s)</label>
		<div class="controls">
			<?php
				if(!empty($user['telefonos'])):
					$allTipos = explode('|', $user['tipos_tel']);
					$allTelefonos = explode('|', $user['telefonos']);
					$i = 0;
					foreach($allTelefonos as $telefono):
						echo '- ' . $telefono . ' [' . $allTipos[$i] . ']<br />';
						$i++;
					endforeach;
				else:
					echo '<span>No hay telefonos.</span>';
				endif;
			?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Fecha De Registro</label>
		<div class="controls">
			<?php echo $user['fecha_registro']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Resetear Contraseña</label>
		<div class="controls">
			<input type="button" class="btn btn-warning resetPass" value="Resetear" />
		</div>
	  </div>
	</fieldset>
<?php
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}