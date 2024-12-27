<?php
    //inicio la variable de sesion
    session_start();
    //Incluyo el archivo con el procesador de pagos de mercado pago
    include_once 'consultas/store.php';
    // Verifico si los datos de sesion tienen datos
    if (isset($_SESSION['oyg_vb'])) {
        //
        var_dump($_SESSION['oyg_vb']);
        //Compras::createPreference($array_datos);
    } else {
        echo "Error: No se han recibido todos los datos necesarios del formulario.";
    }
?>