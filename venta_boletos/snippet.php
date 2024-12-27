
      <?php
        require_once 'vendor/autoload.php';
        MercadoPagoSDK::setAccessToken("YOUR_ACCESS_TOKEN");
        $contents = json_decode(file_get_contents('php://input'), true);

        $payment = new MercadoPagoPayment();
        $payment->transaction_amount = $contents['transaction_amount'];
        $payment->token = $contents['token'];
        $payment->installments = $contents['installments'];
        $payment->payment_method_id = $contents['payment_method_id'];
        $payment->issuer_id = $contents['issuer_id'];
        $payer = new MercadoPagoPayer();
        $payer->email = $contents['payer']['email'];
        $payer->identification = array(
            "type" => $contents['payer']['identification']['type'],
            "number" => $contents['payer']['identification']['number']
        );
        $payment->payer = $payer;
        $payment->save();
        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );
        echo json_encode($response);
    ?>
    
      <?php
        require_once 'vendor/autoload.php';

        MercadoPagoSDK::setAccessToken("ENV_ACCESS_TOKEN");

        $payment = new MercadoPagoPayment();
        $payment->transaction_amount = 100;
        $payment->description = "Título do produto";
        $payment->payment_method_id = "pix";
        $payment->payer = array(
            "email" => "test@test.com",
            "first_name" => "Test",
            "last_name" => "User",
            "identification" => array(
                "type" => "CPF",
                "number" => "19119119100"
            ),
            "address"=>  array(
                "zip_code" => "06233200",
                "street_name" => "Av. das Nações Unidas",
                "street_number" => "3003",
                "neighborhood" => "Bonfim",
                "city" => "Osasco",
                "federal_unit" => "SP"
            )
          );

        $payment->save();

      ?>
    
      <?php
      require_once 'vendor/autoload.php';

      MercadoPagoSDK::setAccessToken("ENV_ACCESS_TOKEN");

      $payment = new MercadoPagoPayment();
      $payment->transaction_amount = 100;
      $payment->description = "Título do produto";
      $payment->payment_method_id = "bolbradesco";
      $payment->payer = array(
          "email" => "test@test.com",
          "first_name" => "Test",
          "last_name" => "User",
          "identification" => array(
              "type" => "CPF",
              "number" => "19119119100"
           ),
          "address"=>  array(
              "zip_code" => "06233200",
              "street_name" => "Av. das Nações Unidas",
              "street_number" => "3003",
              "neighborhood" => "Bonfim",
              "city" => "Osasco",
              "federal_unit" => "SP"
           )
        );

      $payment->save();

     ?>

    