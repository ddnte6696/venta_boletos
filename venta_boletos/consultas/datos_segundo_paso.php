<?php
	//inicio la variable de sesion
		session_start();
	//obtengo los datos mandados por el formulario
		$corrida=htmlspecialchars($_POST['corrida'],ENT_QUOTES);
	//empiezo a asignar datos en los campos
		$_SESSION['oyg_vb']['corrida']=$corrida;
	//redirijo al siguiente paso
		echo '
			<script type="text/javascript">
				window.location.href = "tercer_paso.php";
			</script>
		';
	//
?>