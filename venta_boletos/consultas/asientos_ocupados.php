<?php
	//llamo ala base de datos
		include_once '../../../connection/yahualica.sql.db.php';
	//inicio la variable de sesion
		session_start();
	//Extraigo datos del arreglo para hacer consultas
		$prefijo=$_SESSION['oyg_vb']['prefijo'];
		$corrida=$_SESSION['oyg_vb']['corrida'];
	//saco los asientos que estan ocupados en ese momento
		$query=$conn->prepare("SELECT ascientos FROM corridas_$prefijo where id_corrida='$corrida';");
		$query->execute();
		$tabla=$query->fetch(PDO::FETCH_ASSOC);
		$array_ascientos=$tabla['ascientos'];
	//separo los asientos en un arreglo
		$asientos=explode(" ", $array_ascientos);
	//extraigo la longitud del arreglo creado
		$longitud=sizeof($asientos);
	//creo un ciclo for para recorrer el arreglo completamente
		for ($i=0; $i < $longitud ; $i++) { 
			echo "
			<script>
				$('#ta".$asientos[$i]."').removeClass('btn-primary');
				$('#ta".$asientos[$i]."').addClass('btn-danger disabled');
			</script>
		";
		}
	//
?>
