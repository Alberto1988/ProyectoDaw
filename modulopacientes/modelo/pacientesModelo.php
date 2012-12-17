<?php
function buscarTodosLosPacientes(){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
		
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$resultado = $db->query('SELECT * FROM pacientes');
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
function altaPaciente($clave,$nombre,$apellido_paterno,$apellido_materno,$tiposexo,$domicilio,$fecha_pa,$fecha_co,$diagnostico,$us_paciente,$ct_paciente){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
			
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$consulta = "insert into pacientes(clave,nombre,apellido_paterno,apellido_materno,sexo,domicilio,fecha_pa,fecha_consulta,diagnostico,usu_paciente,pass_paciente) values ('$clave','$nombre','$apellido_paterno','$apellido_materno','$tiposexo','$domicilio','$fecha_pa','$fecha_co','$diagnostico','$us_paciente','$ct_paciente')";
		if ($db->query($consulta) === false)
			throw new ExcepcionEnTransaccion();
			
		if ($consulta->num_rows > 0){

			header("Location: ../../index.php?val=ok");
			
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

function actualizar($id,$clave,$nombre,$apellido_paterno,$apellido_materno,$tiposexo,$domicilio,$fecha_pa,$fecha_co,$diagnostico,$us_paciente,$ct_paciente){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
			
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$consulta = "update pacientes set clave='".$clave."',nombre='".$nombre."',apellido_paterno='".$apellido_paterno."',apellido_materno='".$apellido_materno."',sexo='".$tiposexo."',domicilio='".$domicilio."',fecha_pa='".$fecha_pa."',fecha_consulta='".$fecha_co."',diagnostico='".$diagnostico."',usu_paciente='".$us_paciente."',pass_paciente='".$ct_paciente."' where id_paciente='".$id."'";
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
function pacientesModificar($id){
	global $servidor, $bd, $usuario, $contrasenia;
	try{
		@ $db = new mysqli($servidor, $usuario, $contrasenia);
		if (mysqli_connect_errno() != 0)
			throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
		
		$db->select_db($bd);
		if ($db->errno != 0)
			throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
			
		$resultado = $db->query("SELECT * FROM pacientes where id_paciente='".$id."'");
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