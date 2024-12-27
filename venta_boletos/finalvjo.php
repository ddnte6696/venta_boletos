<?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
  // Incluimos la biblioteca de MercadoPago
  require "vendor/autoload.php";
  // Incluimos el archivo de credenciales que contiene el access token
  include_once "credenciales.php";
  //Incluimos el archivo de conexion
  include_once '../../connection/yahualica.sql.db.php';
  //inicio la variable de sesion
  session_start();
  //Extraigo datos del arreglo para hacer consultas
  $prefijo=$_SESSION['oyg_vb']['prefijo'];
  $corrida=$_SESSION['oyg_vb']['corrida'];
  $referencia=$_SESSION['oyg_vb']['referencia'];
  //var_dump($_SESSION['oyg_vb']);
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
  //Obtengo el total a pagar
  $precio=round(($_SESSION['oyg_vb']['precio_destino']* $numero_filas),2);
  // Configuramos el access token de MercadoPago
  MercadoPago\SDK::setAccessToken($access_token);
  // Definimos el producto que se va a pagar
  $producto = [
    'id' => $referencia,
    'precio' => $precio,
    'cantidad' => $numero_filas ,
    'titulo' => 'BOLETOS DE AUTOBUS'
  ];
  // Creamos una nueva instancia de Preference para generar el link de pago
  $preference = new MercadoPago\Preference();
  // Creamos un nuevo ítem para agregar al carrito de compra
  $item= new MercadoPago\Item();
  $item->id = $producto['id']; // Identificador único del ítem (puede ser el código del producto)
  $item->title = $producto['titulo']; // Título del producto
  $item->quantity = $producto['cantidad']; // Cantidad de unidades a comprar
  $item->unit_price = $producto['precio']; // Precio unitario del producto
  // Agregamos el ítem a la lista de ítems en la preferencia
  $preference->items = array($item);
  // Guardamos la preferencia para obtener el link de pago
  $preference->save();
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
                <td>$ <?php echo round($_SESSION['oyg_vb']['precio_destino'],2) ?></td>
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
        <h4>Total a pagar: $ <?php echo round(($_SESSION['oyg_vb']['precio_destino']* $numero_filas),2) ?></h4>
        <a class='btn btn-block btn-success' <?php echo "href='$preference->sandbox_init_point'";?> ><strong>PAGAR</strong></a>
      </div>
    </div>
  </div>
</body>
