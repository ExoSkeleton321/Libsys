<?php
error_reporting(1);
session_start();
if(isset($_POST['pedidoId'])){
	require 'FunctionsPedidos.php';
	require 'FunctionsLibros.php';
	$obj  = new FunctionsPedidos();
	$obj2 = new FunctionsLibros();

	//Get pedido info
	$pedido = $obj->getPedidoInfo($_POST['pedidoId']);

?>
	<fieldset>
	  <div class="control-group">
		<label class="control-label" for="focusedInput">Pedido ID</label>
		<div class="controls">
		  <?php echo $pedido['pedido_id']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="focusedInput">Nombre(s) Cliente</label>
		<div class="controls">
		  <?php echo "<b>" . $pedido['CURP'] . "</b> - " . $pedido['nombre_cliente'] . " " . $pedido['apellido_pat'] . " " . $pedido['apellido_mat']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label" for="selectError">Anticipo</label>
		<div class="controls">
		  <?php echo "$" . number_format($pedido['anticipo'], 2); ?>
		</div>
	 </div>
	 <div class="control-group">
		<label class="control-label">Valor Total De Venta</label>
		<div class="controls">
		  <?php echo "$" . number_format($pedido['valor_total'], 2); ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Cantidad Restante</label>
		<div class="controls">
		  <?php echo "$" . number_format((double) $pedido['valor_total'] - (double) $pedido['anticipo'], 2); ?>
		</div>
	  </div>
	  <div class="control-group">
		<label class="control-label">Proveedor</label>
		<div class="controls">
		  <?php echo "<b>" . $pedido['RFC'] . "</b> - " . $pedido['nombre']; ?>
		</div>
	  </div>
	  <div class="control-group">
		<?php 
			$allLibrosId = explode('|', $pedido['libro_id']);	
		?>
			<h5>Libros En El Pedido</h5>
			<table class="table table-hover">
				<tr>
					<th style="text-align: center;">ISBN</th>
					<th style="text-align: center;">Nombre</th>
					<th style="text-align: center;">Precio</th>
					<th style="text-align: center;">Existencias</th>
					<th style="text-align: center;">Edicion</th>
					<th style="text-align: center;">Genero</th>
				</tr>
				<?php if(count($allLibrosId) > 0 && $pedido['libro_id'] !== null): ?>

					<?php foreach($allLibrosId as $libroId): 
						$libro = $obj2->getLibroInfo($libroId);
					?>
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