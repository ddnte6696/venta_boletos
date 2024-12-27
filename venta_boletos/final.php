<?php
  //Incluimos el archivo de conexion
    include_once '../../connection/yahualica.sql.db.php';
  //inicio la variable de sesion
    session_start();
  //Extraigo datos del arreglo para hacer consultas
    $prefijo=$_SESSION['oyg_vb']['prefijo'];
    $corrida=$_SESSION['oyg_vb']['corrida'];
    $referencia=$_SESSION['oyg_vb']['referencia'];
    $nombre_destino=$_SESSION['oyg_vb']['nombre_destino'];
  //Obtengo el nombre de la corrida
    $query=$conn->prepare("SELECT * FROM corridas_$prefijo where id_corrida='$corrida';");
    $query->execute();
    $tabla=$query->fetch(PDO::FETCH_ASSOC);
    $nombre_corrida=$tabla['corrida'];
  //Separo los registros de los boletos 
    $filas=explode('$$',$_SESSION['oyg_vb']['boletos']);
  //Cuento cuantos boletos que 
    $numero_filas=count($filas);
  //Inicio un cilo for para imprimir la tabla
    for ($i=0; $i <$numero_filas ; $i++) {
      $columnas=explode('||',$filas[$i]);
      $numero_columnas=count($columnas);
    }
  //Calculo cual seria el importe total
    $importe_total=$_SESSION['oyg_vb']['precio_destino']*$numero_filas; 
  //Obtengo el resultado con descuento
    
  //Obtengo el 3.19 % del importe que se va a cobrar
    $porcentaje=$importe_total*0.0319;
  //Calculo el IVA del porcentaje
    $iva=$porcentaje*0.16;
  //Calculo el precio que se va a cobrar
    $datos=$importe_total-($porcentaje+$iva+4.64);
?>
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
<body>
  <div class="container-fluid">
    <div class="card text-center">
      <div class="card-header">
        <h3>Confirma tu informacion</h3>
      </div>
      <div id="response"></div>
      <div class="card-body">
        <!--datos de viaje-->
          <h4>Datos de viaje</h4>
          <table class="table table-bordered table-striped table-responsive-sm">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Origen</th>
                <th>Destino</th>
                <th>corrida</th>
                <th>Precio</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $_SESSION['oyg_vb']['fecha'] ?></td>
                <td><?php echo $_SESSION['oyg_vb']['taquilla'] ?></td>
                <td><?php echo $_SESSION['oyg_vb']['nombre_destino'] ?></td>
                <td><?php echo $nombre_corrida ?></td>
                <td>$ <?php echo round($_SESSION['oyg_vb']['precio_destino'],2) ?>
                </td>
              </tr>
            </tbody>
          </table>
        <!--datos de los pasajeros-->
          <h4>Pasajeros</h4>
          <?php
            //separo los registros de los boletos 
              $filas=explode('$$',$_SESSION['oyg_vb']['boletos']);
            //cuento cuantos boletos que 
              $numero_filas=count($filas);
            //creo el encabezado de la tabla de pasajeros
              echo "
                <table class='table table-sm table-hover table-bordered table-responsive-sm'>
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
            //
          ?>
          <table class="table table-bordered table-responsive-sm">
            <tr>
              <th>Descuento</th>
              <td><code>-$ <?php echo round(($datos),2); ?></code></td>
            </tr>
            <tr>
              <th><h4>Total a pagar</h4></th>
              <td><h4>$ <?php echo round(($importe_total),2); ?></h4></td>
            </tr>
          </table>
        <a class='btn btn-block btn-success' href="procesar_pago.php"><strong>PAGAR</strong></a>
      </div>
    </div>
  </div>
</body>
