<?php
session_start();
if(isset($_POST['nombre'], $_POST['apellido_pat'], $_POST['apellido_mat'], $_POST['email'], $_POST['tel'], $_POST['tipoTel'], $_POST['tipoCliente'], $_POST['curp'], $_POST['direccion'])){
	require 'FunctionsClientes.php';
	$obj = new FunctionsClientes();

	$insert = $obj->insertCliente($_POST['nombre'], $_POST['apellido_pat'], $_POST['apellido_mat'], $_POST['email'], $_POST['tel'], $_POST['tipoTel'], $_POST['tipoCliente'], $_POST['curp'], $_POST['direccion']);
	if($insert == "true"){
		echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Cliente insertado Correctamente.</p>';
	}elseif($insert == "false"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
	}elseif($insert == "false1"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Cliente duplicado, escriba uno no existente.</p>';
	}
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}