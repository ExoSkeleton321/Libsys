<?php
session_start();
if(isset($_POST['proveedor'], $_POST['clienteId'], $_POST['anticipo'], $_POST['total'], $_POST['pedidos'])){
	require 'FunctionsPedidos.php';
	$obj = new FunctionsPedidos();

	$librosEnPedido = implode("|", $_POST['pedidos']);

	$insert = $obj->insertPedido($_POST['proveedor'], $_POST['clienteId'], $_POST['anticipo'], $_POST['total'], $librosEnPedido);
	if($insert == "true"){
		echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Pedido ingresado.</p>';
	}elseif($insert == "false"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
	}elseif($insert == "false1"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Tipo duplicado, escriba uno no existente.</p>';
	}
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}