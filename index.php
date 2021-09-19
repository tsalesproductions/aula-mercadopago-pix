<?php
    include_once("vendor/autoload.php");

    MercadoPago\SDK::setAccessToken("SEUTOKENAQUI");
    //https://www.mercadopago.com/mlb/account/credentials

    $preference = new MercadoPago\Preference();

    # Building an item

    $item1 = new MercadoPago\Item();
    $item1->id = "00001";
    $item1->title = "item"; 
    $item1->quantity = 1;
    $item1->unit_price = 100;

    $preference->items = array($item1);

    $preference->payment_methods = array(
    "excluded_payment_types" => array(
        array("id" => "credit_card"),
        array("id" => "ticket"),
        array("id" => "digital_wallet"),
        array("id" => "digital_currency")
    ),
    "installments" => 12
    );

    $payer = new MercadoPago\Payer();
    $payer->name = "Joao";
    $payer->surname = "Silva";
    $payer->email = "user@email.com";
    $payer->date_created = "2018-06-02T12:58:41.425-04:00";
    $payer->phone = array(
        "area_code" => "11",
        "number" => "4444-4444"
    );
        
    $payer->identification = array(
        "type" => "CPF",
        "number" => "19119119100"
    );
        
    $payer->address = array(
        "street_name" => "Street",
        "street_number" => 123,
        "zip_code" => "06233200"
    );

    $preference = new MercadoPago\Preference();
    $preference->back_urls = array(
        "success" => "https://www.seu-site/success",
        "failure" => "http://www.seu-site/failure",
        "pending" => "http://www.seu-site/pending"
    );
    $preference->auto_return = "approved";

    $preference->external_reference = "A Custom External Reference";

    $preference->save(); # Save the preference and send the HTTP Request to create

    # Return the HTML code for button

    echo "<a href='$preference->init_point'> Pagar </a>";