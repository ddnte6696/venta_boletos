<?php
  include_once '../../connection/yahualica.sql.db.php';
  //destruyo la variable de sesion
    session_start();
    session_destroy();
  //Extraigo datos del arreglo para hacer consultas
    $referencia=$_GET['referencia'];
  //
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <link rel="icon" href="../../img/icon.png" type="image/ico" />
    <title>Comprobante - <?php echo $referencia;?></title>
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
    <style type="text/css">
      @media print {
          @page { size: auto; }
      }
    </style>
    <div class="card">
      <div class="card-header text-center">
        <div class="row">
          <div class="col-2"><img src="../../img/logo_yahua.jpg" style="width: 200px"></div>
          <div class="col-10"><h4>Pase de abordar<br>(Comprobante - <?php echo $referencia;?>)</h4></div>
        </div>
      </div>
      <div class="card-text text-center">
          Conserva el numero <strong><?php echo $referencia;?></strong> para imprimir tus boletos en taquilla o 
          <a class="btn btn-outline-primary" onclick="imprime_pagina();">Da clic aqui para imprimir tu comprobante</a>
        </div>
      <div class="card-body border">
        
        <div class="row border">
          <div class="col-8 border">
            <?php
              //Identifico todos los boletos ligados a la referencia
                  $query=$conn->prepare("SELECT * FROM pre_boletos_web where referencia='$referencia'");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $id_boleto="VW ".$tabla['id'];
                    $origen=$tabla['origen'];
                    $destino=$tabla['destino'];
                    $precio=$tabla['precio'];
                    $nombre=$tabla['nombre'];
                    $asciento=$tabla['asciento'];
                    $id_corrida=$tabla['id_corrida'];
                    $fecha=$tabla['fecha'];
                    //identifico de que taquilla de la que va a salir y defino el prefijo
                      switch ($origen) {
                        case 'Guadalajara':
                          $prefijo='gdl';
                          break;
                        case 'Yahualica':
                          $prefijo='yahualica';
                          break;
                      }
                    //saco los asientos que estan ocupados en ese momento
                      $query2=$conn->prepare("SELECT * FROM corridas_$prefijo where id_corrida='$id_corrida';");
                      $query2->execute();
                      $tabla2=$query2->fetch(PDO::FETCH_ASSOC);
                      $corrida=$tabla2['corrida'];
                      $datos_corrida=explode("//", $corrida);
                      $hora_corrida=$datos_corrida[1];
                      $nombre_corrida=$datos_corrida[0];
                    ?>
                    <div class="row">
                      <div class="col-6 border text-center" style="font-size: x-small;">
                        <strong>OMNIBUS YAHUALICA GUADALAJARA S.A. DE CV.</strong>
                        <table class="table table-sm">
                          <tbody>
                            <tr>
                              <th>Folio</th>
                              <td><?php echo $id_boleto;?></td>
                            </tr>
                            <tr>
                              <th>Corrida</th>
                              <td><?php echo $nombre_corrida;?></td>
                            </tr>
                            <tr>
                              <th>Hora</th>
                              <td><?php echo $hora_corrida;?></td>
                            </tr>
                            <tr>
                              <th>Asiento</th>
                              <td><?php echo $asciento;?></td>
                            </tr>
                            <tr>
                              <th>Pasajero</th>
                              <td><?php echo $nombre;?></td>
                            </tr>
                            <tr>
                              <th>Origen</th>
                              <td><?php echo $origen;?></td>
                            </tr>
                            <tr>
                              <th>Destino</th>
                              <td><?php echo $destino;?></td>
                            </tr>
                            <tr>
                              <th>Total</th>
                              <td>$ <?php echo number_format($precio,2);?></td>
                            </tr>
                            <tr>
                              <th colspan="2">Boleto de operador</th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-6 border text-center" style="font-size: x-small;">
                        <strong>OMNIBUS YAHUALICA GUADALAJARA S.A. DE CV.</strong>
                        <table class="table table-sm">
                          <tbody>
                            <tr>
                              <th>Folio</th>
                              <td><?php echo $id_boleto;?></td>
                            </tr>
                            <tr>
                              <th>Corrida</th>
                              <td><?php echo $nombre_corrida;?></td>
                            </tr>
                            <tr>
                              <th>Hora</th>
                              <td><?php echo $hora_corrida;?></td>
                            </tr>
                            <tr>
                              <th>Asiento</th>
                              <td><?php echo $asciento;?></td>
                            </tr>
                            <tr>
                              <th>Pasajero</th>
                              <td><?php echo $nombre;?></td>
                            </tr>
                            <tr>
                              <th>Origen</th>
                              <td><?php echo $origen;?></td>
                            </tr>
                            <tr>
                              <th>Destino</th>
                              <td><?php echo $destino;?></td>
                            </tr>
                            <tr>
                              <th>Total</th>
                              <td>$ <?php echo number_format($precio,2);?></td>
                            </tr>
                            <tr>
                              <th colspan="2">Boleto de pasajero</th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  <?php }
              //
            ?>
          </div>
          <div class="col-4 border"  style="font-size: x-small;">
            <h5>Condiciones del servicio</h5>
            <p>Para abordar la unidad es necesario presentar este pase de abordar de manera impresa al conductor de la unidad.</p>
            <p>Presentarse al anden 20 minutos antes de la salida de su viaje, para abordar en tiempo y forma.</p>
            <p>Los menores de edad no pueden viajar solos y solo podrán viajar acompañados de un adulto con boleto pagado.</p>
            <strong><p>Este pase no es cancelable y no se realiza reembolso total o parcial del monto pagado.</p>
            <p>Este pase de abordar es válido únicamente para la fecha y hora indicada, de no abordar la unidad en tiempo y forma será la pérdida del viaje.</p></strong>
            <p>No se permite viajar con animales exóticos o en peligro de extinción, armas de fuego o punzo cortantes, como navajas, picahielo, etc., así como objetos o sustancias peligrosas (tanques de gas, oxigeno, solventes, etc.)</p>
            <h5>Requisitos legales</h5>
            <p>Por disposición del Gobierno Federal es necesario al momento de abordar y durante el viaje, presentar una identificación oficial vigente (INE, PASAPORTE, CEDULA PROFESIONAL, LICENCIA DE CONDUCIR)</p>
            <p>Para personas extranjeras, deberán presentar una identificación con fotografía y su forma migratoria múltiple (FMM) la cual es expedida por el instituto Nacional de Migración.</p>
            <strong><p>En caso de no presentar estos requisitos no podrá abordar la unidad y será la perdida de su viaje, por lo que no se realizará cancelación o reembolso.</p></strong>
            <h5>Recomendaciones del sector salud</h5>
            <p>Es obligatorio el uso de cubrebocas al momento de abordar la unidad, durante u al término del viaje.</p>
            <p>Se recomienda llevar consigo Gel Antibacterial de bolsillo y usarlo de manera constante.</p>
          </div>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript">
    function imprime_pagina() {
      window.print();
    }
  </script>
</html>