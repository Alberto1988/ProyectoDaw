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
	$criterio_ord="clave"; 
	
$sql="SELECT * FROM pacientes order by $criterio_ord ".$orden." ".$mas;
if($_GET["nombre"]!=""){
	$nombre="%".$_GET["nombre"]."%";
	$sql="SELECT * FROM pacientes where (clave like '$nombre') or (nombre like '$nombre') order by $criterio_ord ".$orden." ".$mas;
}
else if($_GET["nombre"]=="")//el us no introduce nada en el input text
	$sql = "select * from pacientes where clave not LIKE '%'";

$cadena="";
try{
	@ $db = new mysqli($servidor, $usuario, $contrasenia);
	if (mysqli_connect_errno() != 0)
		throw new Exception('Error conectando:'.mysqli_connect_error(), mysqli_connect_errno());
	
	$db->select_db($bd);
	if ($db->errno != 0)
		throw new Exception('Error seleccionando bd:'.$db->error, $db->errno);
		
	$resultado= $db->query($sql);
	if ($db->errno != 0)
		throw new Exception('Error realizando consulta:'.$db->error, $db->errno);

	if ($resultado->num_rows > 0){
			$cadena.= '<TABLE id="muestra">';
			$cadena.='<tr>';
				$cadena.='<th>ID</th>';
				$cadena.='<th>CLAVE</th>';
				$cadena.='<th>1erAPELLIDO</th>';
				$cadena.='<th>2doAPELLIDO</th>';
				$cadena.='<th>SEXO</th>';
				$cadena.='<th>DOMICILIO</th>';
				$cadena.='<th>NACIMIENTO</th>';
				$cadena.='<th>CONSULTA</th>';
				$cadena.='<th>DIAGNOSTICO</th>';
				$cadena.='<th>USUARIO</th>';
				$cadena.='<th>PASSWORD</th>';
			$cadena.='</tr>';
			while ($obj = $resultado->fetch_object()){
				LimpiaResultados($obj);
				$cadena.='<tr>';
					$cadena.='<td align="center">'.$obj->id_paciente.'</td>';
					$cadena.='<td align="center">'.$obj->clave.'</td>';
					$cadena.='<td align="center">'.$obj->nombre.'</td>';
					$cadena.='<td align="center">'.$obj->apellido_paterno.'</td>';
					$cadena.='<td align="center">'.$obj->apellido_materno.'</td>';
					$cadena.='<td align="center">'.$obj->sexo.'</td>';
					$cadena.='<td align="center">'.$obj->domicilio.'</td>';
					$cadena.='<td align="center">'.$obj->fecha_pa.'</td>';
					$cadena.='<td align="center">'.$obj->fecha_consulta.'</td>';
					$cadena.='<td align="center">'.$obj->diagnostico.'</td>';
					$cadena.='<td align="center">'.$obj->usu_paciente.'</td>';
					$cadena.='<td align="center">'.$obj->pass_paciente.'</td>';
					$cadena.= '<td align="right"><a href="index.php?controlador=pacientes&accion=modificar2&val=ok&mod='.$obj->id_paciente.'">Modifica</a></td>'; 
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