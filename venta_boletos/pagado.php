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
	<h1>Boletos ingresados a la venta</h1>
	<?php
		//llamo ala base de datos
			include_once '../../connection/yahualica.sql.db.php';
		//inicio la variable de sesion
	    session_start();
	  //Extraigo datos del arreglo para hacer consultas
	    $referencia=$_GET['referencia'];
	   echo "<a class='btn btn-block btn-success' href='venta_boletos.php?referencia=$referencia'><strong>IMPRIMIR MIS BOLETOS</strong></a>";
	  //comienzo la busqueda de los boletos
	    $sentencia="SELECT * FROM pre_boletos_web where referencia='$referencia'";
	    $query=$conn->prepare($sentencia);
	    $query->execute();
	    while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
	      $id_boleto="VW ".$tabla['id'];
	      $origen=$tabla['origen'];
	      $destino=$tabla['destino'];
	      $id_destino=$tabla['id_destino'];
	      $precio=$tabla['precio'];
	      $nombre=$tabla['nombre'];
	      $asciento=$tabla['asciento'];
	      $id_corrida=$tabla['id_corrida'];
	      $fecha=$tabla['fecha'];
	      $hora=$tabla['hora'];
	      $total=$tabla['total'];
	      $hora_venta=$tabla['hora_venta'];
	      $fecha_venta=$tabla['fecha_venta'];
	      //identifico de que taquilla de la que va a salir y defino el prefijo
	        switch ($origen) {
	          case 'Guadalajara':
	            $prefijo='gdl';
	            break;
	          case 'Yahualica':
	            $prefijo='yahualica';
	            break;
	        }
	      //
	      $consulta = "
		      EXEC [central_omnibus].[dbo].[Inserta_Venta_Fecha] 
			      '".$id_boleto."',
			      '".$origen."',
			      '".$destino."',
			      ".$id_destino.",
			      ".$precio.",
			      '".$nombre."',
			      'Adulto',
			      ".$asciento.",
			      '".$id_corrida."'
			      ,'".$fecha."',
			      '".$hora."',
			      ".$total.",
			      0,
			      'Web',
			      0,
			      '".$hora_venta."',
			      '".$fecha_venta."'
		      ";
	      $query2=$conn->prepare($consulta);
	      $query2->execute();
	    }
			session_destroy();
	?>
</body>
</html>
