<?php
session_start();
if(isset($_POST['userId'])){
	require 'FunctionsClientes.php';
	$obj = new FunctionsClientes();

	$user = $obj->getCliente($_POST['userId']);

?>
	<fieldset>
	  <div class="control-group">
		<label class="control-label" for="focusedInput">ID</label>
		<div class="controls">
		  <?php echo $user['cliente_id']; ?>
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
		<label class="control-label">CURP</label>
		<div class="controls">
		    <?php echo $user['CURP']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="selectError">Seleccionar Tipo De Cliente</label>
		<div class="controls control-tipoCliente">
		  <?php echo $user['tipo']; ?>
		</div>
	 </div>
	 <div class="control-group">
		<label class="control-label">Correo Electronico</label>
		<div class="controls">
		  <?php echo $user['correo']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Dirección De Domicilio</label>
		<div class="controls">
		  <?php echo $user['direccion']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Telefono</label>
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

	</fieldset>
<?php
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}