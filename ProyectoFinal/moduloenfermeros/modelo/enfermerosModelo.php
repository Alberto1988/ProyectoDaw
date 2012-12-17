<?php
function buscarTodosLosEnfermeros(){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
		
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$resultado = $db->query('SELECT * FROM enfermeros');
		if ($db->errno != 0)
			throw new Exception('Error realizando consulta:'.$db->error, $db->errno); 
		$db->close(); 
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}	
	return $resultado;
}
function altaEnfermeros($cedula,$nombre,$apellido1_enfer,$apellido2_enfer,$fecha_en,$especialidad,$usu,$pass){

	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
			
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$consulta = "insert into enfermeros(cedula,nombre_enf,apellido_enf1,apellido_enf2,fecha_enfermero,especialidad,usu_enfermero,pass_enfermero) values ('$cedula','$nombre','$apellido1_enfer','$apellido2_enfer','$fecha_en','$especialidad','$usu','$pass')";
		if ($db->query($consulta) === false)
			throw new ExcepcionEnTransaccion();
			
		if ($consulta->num_rows > 0){
	//session
			header("Location: ../../index.php?val=ok");
			//index.php?val?ppal
		}
	else
		header("Location: ../../index.php?val=");	
		
		$db->commit();
		$db->close();
	}catch (ExcepcionEnTransaccion $e){
		echo 'No se ha podido realizar el alta';
		$db->rollback();
		$db->close();
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}	
}

function actualizar($id,$cedula,$nombre,$apellido1,$apellido2,$fecha,$especialidad,$usu,$pass){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
			
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$consulta = "update enfermeros set cedula='".$cedula."',nombre_enf='".$nombre."',apellido_enf1='".$apellido1."',apellido_enf2='".$apellido2."',fecha_enfermero='".$fecha."',especialidad='".$especialidad."',usu_enfermero='".$usu."',pass_enfermero='".$pass."' where id_enfermero='".$id."'";
		if ($db->query($consulta) === false)
			throw new ExcepcionEnTransaccion();
		$db->commit();
		$db->close();
	}catch (ExcepcionEnTransaccion $e){
		echo 'No se ha podido realizar la modificación';
		$db->rollback();
		$db->close();
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}	
}

function enfermerosModificar($id){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
		
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$resultado = $db->query("SELECT * FROM enfermeros where id_enfermero='".$id."'");
		if ($db->errno != 0)
			throw new Exception('Error realizando consulta:'.$db->error, $db->errno); 
		$db->close(); 
	}catch (Exception $e){
		echo $e->getMessage();
		if (mysqli_connect_errno() == 0)
			$db->close();
		exit();
	}	
	return $resultado;
}
?>