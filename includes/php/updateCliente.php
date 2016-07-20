<?php
session_start();
require 'FunctionsClientes.php';
$obj = new FunctionsClientes();

if(isset($_POST['userId'], $_POST['tipoCliente'], $_POST['email'], $_POST['direccion'], $_POST['tel'], $_POST['tipoTel'])){
	
	if(empty($_POST['tel']) || empty($_POST['tipoTel'])){
		$update = $obj->updateClienteNoPhone($_POST['userId'], $_POST['tipoCliente'], $_POST['email'], $_POST['direccion']);

		if($update == "true"){
			echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Cliente actualizado correctamente.</p>';
		}elseif($update == "false"){
			echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
		}elseif($update == "false1"){
			echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Datos duplicado, escriba uno no existente.</p>';
		}
	}else{
		$update = $obj->updateClienteWithPhone($_POST['userId'], $_POST['tipoCliente'], $_POST['email'], $_POST['direccion'], $_POST['tel'], $_POST['tipoTel']);

		if($update == "true"){
			echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Cliente actualizado correctamente.</p>';
		}elseif($update == "false"){
			echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
		}elseif($update == "false1"){
			echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Datos duplicado, escriba uno no existente.</p>';
		}

	}

}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}