<?php
session_start();

if(isset($_POST['oldPass'], $_POST['newPass'], $_POST['newPassRepeat']) && $_POST['newPass'] === $_POST['newPassRepeat']){
	require 'FunctionsUsuarios.php' ;
	$obj = new FunctionsUsuarios;

	$profile = $obj->getMyProfile($_SESSION['u_up']);

	if(password_verify($_POST['oldPass'], $profile['password'])){
		$new_pass = password_hash($_POST['newPass'], PASSWORD_BCRYPT);

		$query = $pdo->prepare('
			UPDATE usuarios 
			SET password = :pass 
			WHERE usuario_id = :id
		');
		$query->execute([
			'pass' => $new_pass,
			'id' => $profile['usuario_id']
		]);

		if($query){
			echo '<span style="color: green;" class="successChangePass">Contraseña actualizada.</span>';
		}else{
			echo '<span class="errorPost successChangePass">Hubo un error, intente de nuevo.</span>';
		}
	}else{
		echo '<span class="errorPost successChangePass">Porfavor inserte su contraseña actual correctamente.</span>';
	}

}elseif(isset($_POST['oldPass'], $_POST['newPass'], $_POST['newPassRepeat']) && $_POST['newPass'] !== $_POST['newPassRepeat']){
    echo '<span class="errorPost successChangePass">Something went wrong, please try again.</span>';
}