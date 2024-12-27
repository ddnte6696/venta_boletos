<?php
  include_once '../../connection/yahualica.sql.db.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <link rel="icon" href="../../img/torres.jpeg" type="image/ico" />
  <title>Paso 1</title>
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
      <div class="card-header"><h1>VENTA DE BOLETOS</h1></div>
      <div class="card-text">
        <strong>
          Por favor, selecciona los datos correspondientes y posteriormente da clic en el boton continuar para iniciar el proceso
        </strong>
      </div>
      <div class="card-body">
        <form enctype="multipart/form-data" class="form-horizontal" method="post" name="frm_primer_paso" id="frm_primer_paso">
          <div class="row text-center">
            <div class="col-md-4">
              <div class="form-group">
                <label ><strong>Fecha de viaje</strong></label>
                <input type="date" name="fecha_viaje" id="fecha_viaje" class="form-control" required="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label ><strong>Origen</strong></label>
                <select  name='origen' class="custom-select" required="">
                  <option value="Guadalajara">Guadalajara</option>
                  <option value="Yahualica">Yahualica</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label ><strong>Destino</strong></label>
                <select  name='destino' class="custom-select" required="">
                  <?php
                    //primer movimiento (venta neta)
                    $query=$conn->prepare("SELECT * FROM destinos_ixtlahuacan order by destino;");
                    $query->execute();
                    while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                      $id=$tabla['id_destino'];
                      $destino=$tabla['destino'];
                      echo "<option value='$id||$destino'>$destino</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="form-actions">
            <input type="submit" value="Siguiente" class="btn btn-success btn-block" onclick="paso_2();">
          </div>
          <div id="response"></div>
        </form>
        <img src="../../img/262.png" class="img-fluid">
      </div>
    </div>
  </div>
</body>
<script>
  $(function paso_2(){
    $("#frm_primer_paso").on("submit", function(e){
      e.preventDefault();
      var f = $(this);
      var formData = new FormData(document.getElementById("frm_primer_paso"));
      formData.append("dato", "valor");
      //formData.append(f.attr("name"), $(this)[0].files[0]);
      $.ajax({
        url: "consultas/datos_primer_paso.php",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function(){
          $("#response").html("<div class='spinner-border'></div>");
        },
      })
      .done(function(res){
        $("#response").html(res);
      });
    });
  });
</script>
