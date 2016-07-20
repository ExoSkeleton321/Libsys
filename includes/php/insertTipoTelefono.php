<?php
session_start();
if(isset($_POST['tipo'])){
	require 'FunctionsTelefono.php';
	$obj = new FunctionsTelefono();

	$insert = $obj->insertTipoTel($_POST['tipo']);
	if($insert == "true"){
		echo '<p class="resTipoTel"><i class="halflings-icon ok" style="color: green;"></i> Insertado Correctamente.</p>';
	}elseif($insert == "false"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
	}elseif($insert == "false1"){
		echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Tipo duplicado, escriba uno no existente.</p>';
	}
}else{
	echo '<p class="resTipoTel"><i class="halflings-icon remove" style="color: red;"></i> Hubo un error, intelelo de nuevo.</p>';
}