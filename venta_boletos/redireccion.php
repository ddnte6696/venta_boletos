<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="icon" href="../../img/icon.png" type="image/ico" />
  <title>Final</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/display_deprisa.css">
  <link rel="stylesheet" href="../../css/stiky-footer.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous" >
  <script src="../../js/jquery.min.js"></script>
  <script src="../../js/popper.min.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/jspdf.min.js"></script>
</head>
<body class="text-center">
	<h1>
		Redireccionando <br>
		<div class='spinner-border'></div>
	</h1>
	<?php
		//llamo ala base de datos
			include_once '../../connection/yahualica.sql.db.php';
		//extraigo datos de fecha y hora actuales y los almacebno en una variable
	      $hoy = getdate();
	        $ano=$hoy['year'];
	        $month=$hoy['mon'];
	        $day=$hoy['mday'];
	        $horas=$hoy['hours'];
	        $minutos=$hoy['minutes'];
	      $fecha_actual="$ano-$month-$day";
	      $hora_actual="$horas:$minutos";
		//inicio la variable de sesion
			session_start();
		//almaceno los valores del areglo en variables para mayor facilidad
			$referencia=$_SESSION['oyg_vb']['referencia'];
			$fecha=$_SESSION['oyg_vb']['fecha'];
			$taquilla=$_SESSION['oyg_vb']['taquilla'];
			$prefijo=$_SESSION['oyg_vb']['prefijo'];
			$id_destino=$_SESSION['oyg_vb']['id_destino'];
			$nombre_destino=$_SESSION['oyg_vb']['nombre_destino'];
			$precio=round($_SESSION['oyg_vb']['precio_destino'],2);
			$corrida=$_SESSION['oyg_vb']['corrida'];
		//obtengo algunos datos de la corrida
			$query=$conn->prepare("SELECT * FROM corridas_$prefijo where id_corrida='$corrida';");
		    $query->execute();
		    $tabla=$query->fetch(PDO::FETCH_ASSOC);
		    $hora_corrida=$tabla['hora'];
		//separo los registros de los boletos 
			$filas=explode('$$',$_SESSION['oyg_vb']['boletos']);
		//cuento cuantos boletos que 
			$numero_filas=count($filas);
		//inicio un cilo for para imprimir la tabla
			for ($i=0; $i <$numero_filas ; $i++) {
				$columnas=explode('||',$filas[$i]);
				$numero_columnas=count($columnas);
				$nombre_pasajero=$columnas[1];
				$asiento_pasajero=$columnas[0];

				$sentencia="SELECT id from pre_boletos_web where nombre='nombre' and fecha='$fecha' and id_corrida='$corrida'";
	      $query=$conn->prepare($sentencia);
	      $query->execute();
	      $tabla=$query->fetch(PDO::FETCH_ASSOC);
	      $resultado=$tabla['id'];
	      if ($resultado==null||$resultado==0) {
					$sentencia="
						INSERT INTO pre_boletos_web(
							origen,
							destino,
							id_destino,
							precio,
							nombre,
							descuento,
							asciento,
							id_corrida,
							fecha,
							hora,
							total,
							hora_venta,
							fecha_venta,
							taquilla_venta,
							referencia
						) VALUES (
							'$taquilla',
							'$nombre_destino',
							'$id_destino',
							'$precio',
							'$nombre_pasajero',
							'Adulto',
							'$asiento_pasajero',
							'$corrida',
							'$fecha',
							'$hora_corrida',
							'$precio',
							'$hora_actual',
							'$fecha_actual',
							'Web',
							'$referencia'
						)
					";
					$query=$conn->prepare($sentencia);
					$query->execute();
				}
		//
				
			}
		//imprimo un boton para mandar a l final del proceso
			echo "<a class='btn btn-block btn-success' href='venta_boletos.php?referencia=$referencia'><strong>Imprimir boletos no pagados</strong></a> <br>";
			echo "<a class='btn btn-block btn-success' href='pagado.php?referencia=$referencia'><strong>Ingresar boleto pagado</strong></a>";
	?>
</body>
</html>
