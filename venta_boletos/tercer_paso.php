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
  <title>Paso 3</title>
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
  <script>
  //tablas de talonarios
    function asiento(opcion){
      var url="consultas/asientos_ocupados.php"
      $.ajax({
        type: "POST",
        url:url,
        data:{id:opcion},
        success: function(datos){
          $('#response').html(datos);
        }
      });
    }
  //
</script>
<?php echo "<script>$(document).ready(asiento());</script>
      ";
?>
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
        <strong>selecciona tus asientos y escribe el nombre de la persona que va a viajar</strong>

      </div>
      <div id="response"></div>
      <div class="card-body">
        <div class="row">
          <!--vista de los asientos-->
          <div class="col-md-8">
            <label><strong>PASAJEROS REGISTRADOS</strong></label>
            <div id="pasajeros"></div>
          </div>
          <!-- vista de los asientod del autobus-->
          <div class="col-md-3 text-center">
            <div class="row">
              <div class="col-md-4">
                <a class="btn btn-sm btn-block  btn-primary text-light"><strong>Asiento disponible</strong></a>
              </div>
              <div class="col-md-4">
                <a class="btn btn-sm btn-block  btn-danger disabled"><strong>Asiento no disponible</strong></a>
              </div>
              <div class="col-md-4">
                <a class="btn btn-sm btn-block  btn-warning disabled"><strong>Asiento seleccionado</strong></a>
              </div>
            </div>
            <div class="table table-sm">
              <table>
                <tr>
                  <td colspan="2"><a class="btn btn-sm btn-block  btn-danger disabled">Chofer</a></td>
                  <td>
                    <i class='fas fa-angle-double-down'></i>
                    <i class='fas fa-angle-double-left'></i><br>
                    <i class='fas fa-angle-double-down'></i>
                    
                    <i class='fas fa-angle-double-right'></i>
                  </td>
                  <td>
                    <i class='fas fa-angle-double-left'></i><br>
                    <i class='fas fa-angle-double-right'>
                    </td>
                  <td>
                    <i class='fas fa-angle-double-left'></i><br>
                    <i class='fas fa-angle-double-right'>
                    </td>
                </tr>
                <?php
                  $j=0;
                  for ($i=0; $i <10 ; $i++) { ?>
                    <tr>
                      <td><a class="btn btn-sm btn-block  btn-block btn-primary text-light" id="ta<?php echo $j+1 ?>" onclick="asientos_modal('<?php echo $j+1 ?>');"><?php echo $j+1 ?></a></td>
                      <td><a class="btn btn-sm btn-block  btn-primary text-light" id="ta<?php echo $j+2 ?>" onclick="asientos_modal('<?php echo $j+2 ?>');"><?php echo $j+2 ?></a></td>
                      <td>
                        <i class='fas fa-angle-double-down'></i>
                        <i class='fas fa-angle-double-up'></i>
                      </td>
                      <td><a class="btn btn-sm btn-block  btn-primary text-light" id="ta<?php echo $j+3 ?>" onclick="asientos_modal('<?php echo $j+3 ?>');"><?php echo $j+3 ?></a></td>
                      <td><a class="btn btn-sm btn-block  btn-primary text-light" id="ta<?php echo $j+4 ?>" onclick="asientos_modal('<?php echo $j+4 ?>');"><?php echo $j+4 ?></a></td>
                    </tr><?php
                    $j=$j+4;
                  }
                ?>
                <tr>
                  <td><a class="btn btn-sm btn-block  btn-primary text-light"id="ta<?php echo $j+1 ?>" onclick="asientos_modal('<?php echo $j+1 ?>');"><?php echo $j+1 ?></a></td>
                  <td><a class="btn btn-sm btn-block  btn-primary text-light" id="ta<?php echo $j+2 ?>" onclick="asientos_modal('<?php echo $j+2 ?>');"><?php echo $j+2 ?></a></td>
                  <td><a class="btn btn-sm btn-block  btn-primary text-light" id="ta<?php echo $j+3 ?>" onclick="asientos_modal('<?php echo $j+3 ?>');"><?php echo $j+3 ?></a></td>
                  <td><a class="btn btn-sm btn-block  btn-primary text-light" id="ta<?php echo $j+4 ?>" onclick="asientos_modal('<?php echo $j+4 ?>');"><?php echo $j+4 ?></a></td>
                  <td><a class="btn btn-sm btn-block  btn-primary text-light" id="ta<?php echo $j+5 ?>" onclick="asientos_modal('<?php echo $j+5 ?>');"><?php echo $j+5 ?></a></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php
  include_once('modal_pasajero.php');
?>
<script type="text/javascript">
  //funcion para llamada del modal
    function asientos_modal(datos){
      //Mando a llamar el modal
      $('#asientos').modal('show');
      //seteo los datos en su respectivo input
      $('#id_asiento').val(datos);
      $('#asiento').val(datos);
    }
  //Funcion para asignacion de la corrida
    function asientos(){
      $.ajax({
        type: "POST",
        url: "consultas/asientos.php",
        data: $("#frm_asientos").serialize(),
        success: function(data){
          $("#pasajeros").html(data);
        },
      });
      return false;
    }
  //
</script>