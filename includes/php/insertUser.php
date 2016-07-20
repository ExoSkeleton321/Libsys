<?php
session_start();
if(isset($_POST['nombre'], $_POST['apellido_pat'], $_POST['apellido_mat'], $_POST['email'], $_POST['tel'], $_POST['tipoTel'], $_POST['tipoUsuario'], $_POST['mes'], $_POST['dia'], $_POST['anio'])){
	require 'FunctionsUsuarios.php';
	$obj = new FunctionsUsuarios();

	$insert = $obj->insertUsuario($_POST['nombre'], $_POST['apellido_pat'], $_POST['apellido_mat'], $_POST['email'], $_POST['tel'], $_POST['tipoTel'], $_POST['tipoUsuario'], $_POST['mes'], $_POST['dia'], $_POST['anio']);
	if($insert == "true"){
		echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Usuario insertado Correctamente.</p>';
	}elseif($insert == "false"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
	}elseif($insert == "false1"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Usuario duplicado, escriba uno no existente.</p>';
	}
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}