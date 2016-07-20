<?php
session_start();
require 'FunctionsUsuarios.php';
$obj = new FunctionsUsuarios();

if(isset($_POST['userId'], $_POST['nombre'], $_POST['apellido_pat'], $_POST['apellido_mat'], $_POST['email'], $_POST['tel'], $_POST['tipoTel'], $_POST['tipoUsuario'])){
	$anio = explode('-', $_POST['fecha_nacimiento'])[0];

	if(empty($_POST['tel']) || empty($_POST['tipoTel'])){
		$update = $obj->updateUserNoPhone($_POST['userId'], $_POST['nombre'], $_POST['apellido_pat'], $_POST['apellido_mat'], $_POST['email'], $_POST['tipoUsuario'], $anio, $_POST['usuarioInicial']);

		if($update == "true"){
			echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Usuario actualizado correctamente.</p>';
		}elseif($update == "false"){
			echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
		}elseif($update == "false1"){
			echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Datos duplicado, escriba uno no existente.</p>';
		}
	}else{
		$update = $obj->updateUserWithPhone($_POST['userId'], $_POST['nombre'], $_POST['apellido_pat'], $_POST['apellido_mat'], $_POST['email'], $_POST['tel'], $_POST['tipoTel'], $_POST['tipoUsuario'], $anio, $_POST['usuarioInicial']);

		if($update == "true"){
			echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Usuario actualizado correctamente.</p>';
		}elseif($update == "false"){
			echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
		}elseif($update == "false1"){
			echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Datos duplicado, escriba uno no existente.</p>';
		}

	}

}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}