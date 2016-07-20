<?php
require 'init.php';
if(isset($_POST['estado_id'])){
	$query = $pdo->prepare("
		SELECT municipio_id, municipio
		FROM municipios
		WHERE estado_id = :id
		ORDER BY municipio ASC
	");
	$query->execute([
		'id' => $_POST['estado_id']
	]);

	$allMunicipios = $query->fetchAll();

	echo '<option value="0">-- Seleccionar Municipio --</option>';
	foreach ($allMunicipios as $municipio): ?>
		<option value="<?php echo $municipio['municipio_id']; ?>"><?php echo mb_convert_encoding($municipio['municipio'], "UTF-8"); ?></option>
	<?php
	endforeach;
}elseif(isset($_POST['municipio_id'])){
	$query = $pdo->prepare("
		SELECT localidad_id, localidad
		FROM localidades
		WHERE municipio_id = :id
		ORDER BY localidad ASC
	");
	$query->execute([
		'id' => $_POST['municipio_id']
	]);

	$allLocalidades = $query->fetchAll();

	echo '<option value="0">-- Seleccionar Localidad --</option>';
	foreach ($allLocalidades as $localidad): ?>
		<option value="<?php echo $localidad['localidad_id']; ?>"><?php echo mb_convert_encoding($localidad['localidad'], "UTF-8"); ?></option>
	<?php
	endforeach;
}