<?php
require '../../modelo/conexion.php';
if($_GET["mas"]!=""){
	if($_GET["mas"]!="all")
		$mas="limit 0,".$_GET["mas"];
	else
		$mas="limit 0,100";
}else
	$mas="limit 0,10";

if($_GET["radio1"]=="true")
	$orden="desc";
else if($_GET["radio2"]=="true")
	$orden="asc";
else
	$orden="asc";
	
if($_GET["criterio_ord"]!="")
	$criterio_ord=$_GET['criterio_ord']; 
else
	$criterio_ord="nombre_medico"; 
	
$sql="SELECT * FROM medicos order by $criterio_ord ".$orden." ".$mas;
if($_GET["cedula"]!=""){
	$cedula="%".$_GET["cedula"]."%";
	$sql="SELECT * FROM medicos where (nombre_medico like '$cedula') or (cedula like '$cedula') order by $criterio_ord ".$orden." ".$mas;
}
else if($_GET["cedula"]=="")//el us no introduce nada en el input text
	$sql = "select * from medicos where nombre_medico not LIKE '%'";
	
$cadena="";
try{
	@ $db = new mysqli($servidor, $usuario, $contrasenia);
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db($bd);
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$resultado = $db->query($sql);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

	if ($resultado->num_rows > 0){
		$cadena.= '<TABLE id="muestra">';
			$cadena.='<tr>';
				$cadena.='<th>ID</th>';
				$cadena.='<th>CEDULA</th>';
				$cadena.='<th>NOMBRE</th>';
				$cadena.='<th>1erAPELLIDO</th>';
				$cadena.='<th>2doAPELLIDO</th>';
				$cadena.='<th>NACIMIENTO</th>';
				$cadena.='<th>ESPECIALIDAD</th>';
				$cadena.='<th>USUARIO</th>';
				$cadena.='<th>PASSWORD</th>';
			$cadena.='</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				$cadena.='<tr>';
					$cadena.='<td align="center">'.$obj->id_medico.'</td>';
					$cadena.='<td align="center">'.$obj->cedula.'</td>';
					$cadena.='<td align="center">'.$obj->nombre_medico.'</td>';
					$cadena.='<td align="center">'.$obj->apellido_medico1.'</td>';
					$cadena.='<td align="center">'.$obj->apellido_medico2.'</td>';
					$cadena.='<td align="center">'.$obj->fecha_medico.'</td>';
					$cadena.='<td align="center">'.$obj->especialidad.'</td>';
					$cadena.='<td align="center">'.$obj->usu_medico.'</td>';
					$cadena.='<td align="center">'.$obj->pass_medico.'</td>';
					
				$cadena.='</tr>';
				
			}
		$cadena.='</TABLE>';
		
	}
	$resultado->free(); 
	$db->close(); 
}catch (Exception $e){
	echo $e->getMessage();
	if (mysqli_connect_errno() == 0)
		$db->close();
	exit();
}
echo utf8_encode($cadena);
?>
