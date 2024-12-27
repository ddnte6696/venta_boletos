<?php
	/**
	 * **Requisitos:**
	 * 1. Instalar el SDK: `composer require "mercadopago/dx-php:3.0.5"`
	 * 2. Agregar autoload: `require_once '/vendor/autoload.php';`
	 * 3. Modo de uso: `Compras::createPreference($array_datos);`
	 */
	require_once '../vendor/autoload.php';

	use MercadoPago\MercadoPagoConfig;
	use MercadoPago\Client\Preference\PreferenceClient;
	use MercadoPago\Exceptions\MPApiException;

	class Compras {
	  private $model; // Objeto para guardar información en la base de datos (opcional)
	  /**
	   * Crea una preferencia de pago en MercadoPago.
	   *
	   * @param array $array_datos Datos necesarios para crear la preferencia, como:
	   *  - `total_boleto`: Monto total del boleto.
	   *  - `currency_id`: ID de la moneda (ej: MXN).
	   *  - `precio_boleto`: Precio unitario del boleto.
	   *
	   * @return string|null ID de la preferencia creada o `null` en caso de error.
	   */
	  public static function createPreference($array_datos) {
	  	$id_rand=rand(5, 15);
	  	$divisa="MXN";
	  	$imagen="https://omnibus-guadalajara.com/img/logo_oyg/logo_02.png";
      // Configurar acceso a MercadoPago
      $access_token = 'TEST-3907237835175069-042513-4ba0835c69c15add57a7291180b6807d-1773584073';
      MercadoPagoConfig::setAccessToken($access_token);
      //Definimos un texto para la descripcion
      $descripcion=$array_datos['cantidad']." BOLETOS";
      //Obtengo el importe que se va a cobrar
      $importe=$array_datos['precio'] * $array_datos['cantidad'];
      // Definir información del producto
      $producto1 = [
          "title" => 'BOLETO DE VIAJE', // Título del producto
          "description" => $descripcion, // Descripción del producto
          "quantity" =>$array_datos['cantidad'] , // Cantidad de unidades del producto
          "currency_id" => $divisa, // ID de la moneda
          "unit_price" => intval($array_datos['precio']), // Precio unitario del producto
          "id" => $id_rand, // id del item
          "picture_url" => $imagen // Imagen de referencia
      ];

      // Configurar URLs de retorno
      $back_url = array(
          "success" => "https://omnibus-guadalajara.com/lmpv/confirmar_pago.php?reference=".$id_rand, // URL a la que redirigir en caso de pago exitoso
          "pending" => "https://omnibus-guadalajara.com/lmpv/pending_pago.php", // URL a la que redirigir en caso de pago pendiente
          "failure" => "https://omnibus-guadalajara.com/lmpv/failure_pago.php" // URL a la que redirigir en caso de pago fallido
      );

      // Definir campos de la preferencia
      $fields = [
          "items" => array($producto1), // Array de productos
          "back_urls" => $back_url, // URLs de retorno
          "expires" => true, // Indicar si la preferencia expira
          "auto_return" => 'approved', // Redireccionar automáticamente al aprobar el pago
          "payment_methods" => array(
            "excluded_payment_methods" => array(),
            "excluded_payment_types" => array(
              'id' => 'credit_card',
              'id' => 'bank_transfer',
              'id' => 'ticket',
            ),
            "installments" => 1
          )
        ];

      // Crear la preferencia de pago
      $client = new PreferenceClient();
      try {
          $preference = $client->create($fields);

          /*// Instanciar modelo para guardar información en DB (opcional)
          $this->model = new ModelDB();

           Guardar información de la preferencia en la base de datos (opcional)
          if ($this->model->save_data($preference)) {*/
              // Si se guarda correctamente, redirigir a la página de pago
              //header('location: compra_realizada.php?pref_id=' . $preference->id);
              header('location: '.$preference->init_point);
          //}*/

      } catch (MPApiException $error) {
          // Manejar error de API de MercadoPago
          return null;
      }

      // Devolver ID de la preferencia creada
      return $preference->id;
    }
	}