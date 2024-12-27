<?php
  include_once '../../connection/yahualica.sql.db.php';
  //inicio la variable de sesion
    session_start();
    $_SESSION['oyg_vb']['boletos']=null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="icon" href="../../img/icon.png" type="image/ico" />
  <title>Paso 2</title>
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
  <script src="js/funciones.js"></script>
</head>
<body>
  <div class="container-fluid">
    <div class="card text-center">
      <div class="card-header">
        <h3>
          Salida de 
            <code><?php echo $_SESSION['oyg_vb']['taquilla'] ?></code> 
          hacia 
            <code><?php echo $_SESSION['oyg_vb']['nombre_destino'] ?></code>
        </h3>
      </div>
      <div class="card-text">
        <strong>selecciona la corrida en la que desees viajar</strong>
      </div>
      <div id="response"></div>
      <div class="card-body">
        <table class="table table-bordered table-sm table-striped" id="tabla">
          <thead>
            <tr>
              <th>Hora</th>
              <th>Corrida</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              //Busco el destino en la ruta CUQ-GDL-DIR
                $sentencia="SELECT id_destino from [CUQ-GDL-DIR] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'CUQ-GDL-DIR-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta CUQ-GDL-X4
                $sentencia="SELECT id_destino from [CUQ-GDL-X4] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'CUQ-GDL-X4-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta CUQ-YAH-DIR
                $sentencia="SELECT id_destino from [CUQ-YAH-DIR] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'CUQ-YAH-DIR-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta GDL-CUQ-DIR
                $sentencia="SELECT id_destino from [GDL-CUQ-DIR] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'GDL-CUQ-DIR-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta GDL-CUQ-XSJ
                $sentencia="SELECT id_destino from [GDL-CUQ-XSJ] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'GDL-CUQ-XSJ-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta GDL-JAL
                $sentencia="SELECT id_destino from [GDL-JAL] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'GDL-JAL-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta GDL-MAS
                $sentencia="SELECT id_destino from [GDL-MAS] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'GDL-MAS-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta GDL-MOY
                $sentencia="SELECT id_destino from [GDL-MOY] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'GDL-MOY-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta GDL-TRE
                $sentencia="SELECT id_destino from [GDL-TRE] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'GDL-TRE-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta GDL-YAH-DIR
                $sentencia="SELECT id_destino from [GDL-YAH-DIR] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'GDL-YAH-DIR-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta GDL-YAH-X4
                $sentencia="SELECT id_destino from [GDL-YAH-X4] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'GDL-YAH-X4-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta GDL-YAH-XSJ
                $sentencia="SELECT id_destino from [GDL-YAH-XSJ] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'GDL-YAH-XSJ-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta JAL-GDL
                $sentencia="SELECT id_destino from [JAL-GDL] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'JAL-GDL-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta MAS-GDL
                $sentencia="SELECT id_destino from [MAS-GDL] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'MAS-GDL-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta MOY-GDL
                $sentencia="SELECT id_destino from [MOY-GDL] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'MOY-GDL-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta TRE-GDL
                $sentencia="SELECT id_destino from [TRE-GDL] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'TRE-GDL-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta YAH-GDL-DIR
                $sentencia="SELECT id_destino from [YAH-GDL-DIR] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'YAH-GDL-DIR-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta YAH-GDL-X4
                $sentencia="SELECT id_destino from [YAH-GDL-X4] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'YAH-GDL-X4-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
              //Busco el destino en la ruta YAH-GDL-XSJ
                $sentencia="SELECT id_destino from [YAH-GDL-XSJ] where id_destino = '".$_SESSION['oyg_vb']['id_destino']."'";
                $query=$conn->prepare($sentencia);
                $query->execute();
                $tabla=$query->fetch(PDO::FETCH_ASSOC);
                $resultado=$tabla['id_destino'];
                if ($resultado!=null||$resultado!=0) {
                  $query=$conn->prepare("SELECT * FROM corridas_".$_SESSION['oyg_vb']['prefijo']." where id_corrida like 'YAH-GDL-XSJ-%' and fecha='".$_SESSION['oyg_vb']['fecha']."' and estado=''");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_corrida=$tabla['id_corrida'];
                    $corrida=$tabla['corrida'];
                    $datos_corrida=explode("//", $corrida);
                    $hora_corrida=$datos_corrida[1];
                    $nombre_corrida=$datos_corrida[0];
                    echo "
                      <tr>
                        <td>$hora_corrida</td>
                        <td>$nombre_corrida</td>
                        ";?><td><a onclick="selecciona_corrida('<?php echo $id_corrida ?>')" class='btn btn-success btn-block text-light'>Seleccionar</a></td><?php echo "
                      </tr>
                    ";
                  }
                }
              //
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
  //funcion para confirmar la llegada del paquete
   function selecciona_corrida(opcion){
        var url="consultas/datos_segundo_paso.php"
        $.ajax({
            type: "POST",
            url:url,
            data:{
              corrida:opcion
            },
            success: function(datos){$('#response').html(datos);}
        });
    }
  //
</script>
