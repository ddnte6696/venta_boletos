<?php
	//llamo ala base de datos
		include_once '../../../connection/yahualica.sql.db.php';
	//inicio la variable de sesion
		session_start();
	//obtengo los datos mandados por el formulario
		$taquilla=htmlspecialchars($_POST['origen'],ENT_QUOTES);
		$datos_destino=htmlspecialchars($_POST['destino'],ENT_QUOTES);
		$fecha=htmlspecialchars($_POST['fecha_viaje'],ENT_QUOTES);
	//creo un numero randoom para la referencia bancaria de 5 digitos
		$referencia=rand(10000,99999);
	
		
	//dividos los datos del destino para poder hacer un tratamiento
		$datos=explode('||', $datos_destino);
		$id_destino=$datos[0];
		$nombre_destino=$datos[1];
	//creo un arreglo con algunos campos
	$datos =array (
		'referencia'=>null,
		'fecha'=>null,
		'taquilla'=>null,
		'prefijo'=>null,
		'id_destino'=>null,
		'nombre_destino'=>null,
		'precio_destino'=>null,
		'corrida'=>null,
		'boletos'=>null
	);
	//creo un array de sesion que va a almacenar esos campos y les dara permanencia durante el proceso y le referencio el array anterior
		$_SESSION['oyg_vb']=$datos;
	//identifico de que taquilla de la que va a salir y defino el prefijo
		switch ($taquilla) {
			case 'Guadalajara':
				$prefijo='gdl';
				break;
			case 'Yahualica':
				$prefijo='yahualica';
				break;
		}
	//recupero el precio del destino
		$query=$conn->prepare("SELECT * FROM destinos_$prefijo where id_destino='$id_destino';");
		$query->execute();
		$tabla=$query->fetch(PDO::FETCH_ASSOC);
		$precio=$tabla['precio'];
	//empiezo a asignar datos en los campos
		$_SESSION['oyg_vb']['referencia']=$referencia;
		$_SESSION['oyg_vb']['fecha']=$fecha;
		$_SESSION['oyg_vb']['taquilla']=$taquilla;
		$_SESSION['oyg_vb']['prefijo']=$prefijo;
		$_SESSION['oyg_vb']['id_destino']=$id_destino;
		$_SESSION['oyg_vb']['nombre_destino']=$nombre_destino;
		$_SESSION['oyg_vb']['precio_destino']=$precio;
	//creo las corridas para el dia seleccionado
		$query=$conn->prepare("SELECT count(id_corrida) as cuenta FROM corridas_$prefijo where fecha='$fecha';");
		$query->execute();
		$tabla=$query->fetch(PDO::FETCH_ASSOC);
		$cuenta=$tabla['cuenta'];
		if ($cuenta<1) {
			$query=$conn->prepare("EXEC [central_omnibus].[dbo].[Genera_Corridas_Fecha] '".$taquilla."','".$fecha."'");
			$query->execute();
		}
	//redirijo al siguiente paso
		echo '
			<script type="text/javascript">
				window.location.href = "segundo_paso.php";
			</script>
		';
	//
?>