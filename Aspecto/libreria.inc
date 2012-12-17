<?php
	//------------------------------SESIONES-------------------------------------------------------//
	
	function InicializarSesion($redirect=1){
		session_start();
		if (!isset($_SESSION['userId']) && $redirect == 1)
			header("Location:valida_us.php");
	}

?>