<?php
error_reporting(1);
session_start();
require 'FunctionsPedidos.php';
$obj = new FunctionsPedidos();

//Get all clientes
$allPedidos = $obj->getAllPedidos();
?>
	<meta charset="iso-8859-1">
	<tr>
		<th>ID Pedido</th>
		<th>Cliente</th>
		<th>Anticipo</th>
		<th>Valor Venta Total</th>
		<th>Cantidad Restante</th>
		<th>Acciones</th>
	</tr>
	<?php foreach($allPedidos as $pedido): ?>
		<tr>
			<td><?php echo $pedido['pedido_id']; ?></td>
			<td>
				<?php echo "<b>" . $pedido['CURP'] . "</b> - " . $pedido['nombre_cliente'] . " " . $pedido['apellido_pat'] . " " . $pedido['apellido_mat']; ?>
			</td>
			<td><?php echo "$" . number_format($pedido['anticipo'], 2); ?></td>
			<td><?php echo "$" . number_format($pedido['valor_total'], 2); ?></td>
			<td><?php echo "$" . number_format((double) $pedido['valor_total'] - (double) $pedido['anticipo'], 2); ?></td>
			<td class="center">
				<a href="#myModal3" role="button" data-toggle="modal" data-pedidoId="<?php echo $pedido['pedido_id']; ?>" class="btn btn-success btnViewMorePedido" title="Ver Mas">
					<i class="halflings-icon white zoom-in"></i>  
				</a>
				<a href="#myModal4" role="button" data-toggle="modal" data-pedidoId="<?php echo $pedido['pedido_id']; ?>" class="btn btn-danger btnDeletePedidoFirst" title="Eliminar Pedido">
					<i class="halflings-icon white trash"></i> 
				</a>
			</td>
		</tr>
	<?php endforeach; ?>