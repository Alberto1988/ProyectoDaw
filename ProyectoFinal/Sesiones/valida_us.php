<?php 

function login($login,$pass,$tipousuario){
	global $servidor, $bd, $usuario, $contrasenia;
	$datosLoginValidos=false;
	try{
	@ $db = new mysqli('localhost', 'root', 'root');
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db('clinica');
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
	
	$consulta = "select Usuario,Password from usuarios where Usuario='".$login."' AND Password='".$pass."' AND tipo_usuario='".$tipousuario."'";
	$resultado = $db->query($consulta);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);
	assert($resultado !== false);
if ($resultado->num_rows > 0)
	$datosLoginValidos=true;
$resultado->free();
		$db->close();
	}catch (Exception $e){
		echo '<p>'.$e->getMessage().'</p>';
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit;
	}
	return $datosLoginValidos;
}

?>

