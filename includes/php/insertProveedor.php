<?php
session_start();
if(isset($_POST['rfc'], $_POST['nombre'], $_POST['tel'], $_POST['web'], $_POST['calle'], $_POST['numero_calle'], $_POST['estado_id'], $_POST['municipio_id'], $_POST['localidad_id'], $_POST['cp'])){
	require 'FunctionsProveedores.php';
	$obj = new FunctionsProveedores();
	$insert = $obj->insertProveedor($_POST['rfc'], $_POST['nombre'], $_POST['tel'], $_POST['web'], $_POST['calle'], $_POST['numero_calle'], $_POST['estado_id'], $_POST['municipio_id'], $_POST['localidad_id'], $_POST['cp']);
	
	if($insert == "true"){
		echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Insertado Correctamente.</p>';
	}elseif($insert == "false"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
	}elseif($insert == "false1"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Proveedor duplicado, escriba uno no existente.</p>';
	}
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}

