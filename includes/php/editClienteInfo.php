<?php
error_reporting(0);
session_start();
if(isset($_POST['userId'])){
	require 'FunctionsClientes.php';
	require 'FunctionsTelefono.php';
	$obj  = new FunctionsClientes();
	$obj2 = new FunctionsTelefono();

	//Get user info
	$user = $obj->getCliente($_POST['userId']);

	//Get all tipo de usarios
	$allTipoClientes = $obj->getTipoClientes();

	//Get all tipo de telefonos
	$allTipoTel = $obj2->getAllTipoTel();
?>
	<fieldset>
	  <div class="control-group">
		<label class="control-label" for="focusedInput">Cliente ID</label>
		<div class="controls">
		  <input class="input-xlarge focused" value="<?php echo $user['cliente_id']; ?>" disabled type="text">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="focusedInput">Nombre(s)</label>
		<div class="controls">
		  <input class="input-xlarge focused" value="<?php echo $user['nombre']; ?>" disabled type="text">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Apellido Paterno</label>
		<div class="controls">
		  <input class="input-xlarge" value="<?php echo $user['apellido_pat']; ?>" disabled type="text">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Apellido Materno</label>
		<div class="controls">
		  <input class="input-xlarge" value="<?php echo $user['apellido_mat']; ?>" disabled type="text">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">CURP</label>
		<div class="controls">
		  <input class="input-xlarge" value="<?php echo $user['CURP']; ?>" disabled type="text">
		</div>
	  </div>
	  <?php if($_POST['userType'] == '1'): ?>
	  <div class="control-group">
		<label class="control-label" for="selectError">Seleccionar Tipo De Cliente</label>
		<div class="controls control-tipoClienteUpdate">
		  <select data-rel="chosen" class="tipoClienteUpdate">
		  	<option value="<?php echo $user['tipoCliente_id']; ?>">-- Actual: <?php echo $user['tipo']; ?> --</option>
		  	<?php foreach($allTipoClientes as $tipoCliente): ?>
				<option value="<?php echo $tipoCliente['tipoCliente_id']; ?>"><?php echo $tipoCliente['tipo']; ?></option>
		  	<?php endforeach; ?>
		  </select>
		</div>
	 </div>
	 <?php endif; ?>
	 <div class="control-group">
		<label class="control-label">Correo Electronico</label>
		<div class="controls">
		  <input class="input-xlarge correoClienteTxtUpdate" placeholder="Correo Electronico" type="email" value="<?php echo $user['correo']; ?>" />
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Dirección De Domicilio</label>
		<div class="controls">
		  <input class="input-xlarge direccionClienteTxtUpdate" placeholder="Direccion" type="text"  value="<?php echo $user['direccion']; ?>">
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Telefono</label>
		<div class="controls control-tipoClienteUpdate">
		    <input class="input-xlarge telClienteTxtUpdate" type="text" pattern="[()0-9 ]+" placeholder="Nuevo Telefono Ej. (712) 123 4567" style="outline: 1px solid #ccc;" /><br />
			<select data-rel="chosen" class="tipoTelClienteUpdate" style="outline: 1px solid #ccc; margin: 10px 0 10px 0; width: 92%;">
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
	</fieldset>
<?php
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}