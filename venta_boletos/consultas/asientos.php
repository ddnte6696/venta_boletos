<?php
	//inicio la variable de sesion
		session_start();
	//obtengo los datos mandados por el formulario
		$numero=htmlspecialchars($_POST['id_asiento'],ENT_QUOTES);
		$nombre=htmlspecialchars($_POST['nombre'],ENT_QUOTES);
	//creo un concatenado con los datos
		$nuevo=$numero.'||'.$nombre;
	//ingreso la variable a su lugar correspondiente en el arreglo
		if ($_SESSION['oyg_vb']['boletos']!=null) {
			$_SESSION['oyg_vb']['boletos']=$_SESSION['oyg_vb']['boletos'].'$$'.$nuevo;
		}else{
			$_SESSION['oyg_vb']['boletos']=$nuevo;
		}
	//separo los registros de los boletos 
		$filas=explode('$$',$_SESSION['oyg_vb']['boletos']);
	//cuento cuantos boletos que 
		$numero_filas=count($filas);
	//creo el encabezado de la tabla de pasajeros
		echo "
			<table class='table table-sm table-hover table-bordered'>
	          <thead>
	            <tr>
	              <th>Asiento</th>
	              <th>Nombre</th>
	            </tr>
	          </thead>
	          <tbody>
		";
	//inicio un cilo for para imprimir la tabla
		for ($i=0; $i <$numero_filas ; $i++) {
			$columnas=explode('||',$filas[$i]);
			$numero_columnas=count($columnas);
			echo "
				<tr>
					<td>".$columnas[0]."</td>
					<td>".$columnas[1]."</td>
				</tr>
			";
		}
		echo "
			<tbody></table>
	          
		";
		echo "
			<script>
				$('#asientos').modal('hide');
				$('#ta".$numero."').removeClass('btn-primary text-light');
				$('#ta".$numero."').addClass('btn-warning disabled');
			</script>
		";
	//imprimo un boton para mandar a l final del proceso
		echo "<a class='btn btn-block btn-success' href='final.php'><strong>Continuar al ultimo paso</strong></a>";
?>