<?php
error_reporting(1);
session_start();
if(isset($_POST['userId'])){
	require 'FunctionsProveedores.php';
	require 'FunctionsLibros.php';
	$obj  = new FunctionsProveedores();
	$obj2 = new FunctionsLibros();

	$user = $obj->getProveedorInfo($_POST['userId']);

?>
	<fieldset>
		<div class="control-group">
		<label class="control-label" for="focusedInput">Proveedor ID</label>
		<div class="controls">
			<?php echo $user['proveedor_id']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="selectError">Razon Social</label>
		<div class="controls control-tipoUsuario">
			<?php echo $user['nombre']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="focusedInput">Telefono</label>
		<div class="controls">
			<?php echo $user['telefono']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Direccion(es)</label>
		<div class="controls">
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
					Calle <?php echo mb_convert_encoding($allCalles[0], "UTF-8"); ?> Numero <?php echo $allCallesNumeros[0]; ?>
					Colonia/Localidad <?php echo mb_convert_encoding($allLocalidades[0], "UTF-8"); ?>, <?php echo mb_convert_encoding($allMunicipio[0], "UTF-8"); ?>, <?php echo mb_convert_encoding($allEstados[0], "UTF-8"); ?> CP <?php echo $allCodigoPostales[0]; ?>
					</address>
			<?php }elseif(count($allCalles) > 1){  
					$allCalles = explode('|', $user['calles']);
					$i = 0;
					for($i = 0; $i < count($allCalles); $i++):
			?>
						<address>
						<p><b>Sucursal <?php echo $i + 1; ?></b></p>
						Calle <?php echo mb_convert_encoding($allCalles[$i], "UTF-8"); ?> Numero <?php echo $allCallesNumeros[$i]; ?>
						Colonia/Localidad <?php echo mb_convert_encoding($allLocalidades[$i], "UTF-8"); ?>, <?php echo mb_convert_encoding($allMunicipio[$i], "UTF-8"); ?>, <?php echo mb_convert_encoding($allEstados[$i], "UTF-8"); ?> CP <?php echo $allCodigoPostales[$i]; ?>
						</address>
					<?php endfor; ?>
			<?php } ?>
		</div>
	  </div>
	  <div class="control-group">
		<?php 
			$allLibrosId = explode('|', $user['libro_id']);	
		?>
			<h5>Libros Que Provee</h5>
			<table class="table table-hover">
				<tr>
					<th style="text-align: center;">ISBN</th>
					<th style="text-align: center;">Nombre</th>
					<th style="text-align: center;">Precio</th>
					<th style="text-align: center;">Existencias</th>
					<th style="text-align: center;">Edicion</th>
					<th style="text-align: center;">Genero</th>
				</tr>
				<?php if(count($allLibrosId) > 0 && $user['libro_id'] !== null): ?>

					<?php foreach($allLibrosId as $libroId): 
						$libro = $obj2->getLibroInfo($libroId);
					?>
						<?php if($libro): ?>
							<tr>
								<th style="text-align: center;"><?php echo $libro['ISBN']; ?></th>
								<td style="text-align: center;"><?php echo $libro['nombre']; ?></td>
								<td style="text-align: center;"><?php echo $libro['precio']; ?></td>
								<td style="text-align: center;"><?php echo $libro['numero_copias']; ?></td>
								<td style="text-align: center;"><?php echo $libro['edicion']; ?></td>
								<td style="text-align: center;">
									<span class="label label-important">
										<?php echo $libro['tipo']; ?>
									</span>
								</td>
							</tr>
						<?php endif; ?>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<th colspan="2">No se encontraron libros.</th>
					</tr>
				<?php endif; ?>
			</table>
	  </div>
	  
	</fieldset>
<?php
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}