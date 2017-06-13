<?php
require_once "../../../lib/mercadopago.php";

$mp = new MP("5186169867844597", "i9ZNDa4Xmgoyo70jTemE9KvZF7gSY9Em");

$preference_data = array(
    "items" => array(
        array(
            "title" => "Title of what you are paying for",
            "currency_id" => "VEF",
            "category_id" => "Category",
            "quantity" => 1,
            "unit_price" => 54000.2
        )
    )
);

$preference = $mp->create_preference($preference_data);
?>

<!doctype html>
<html>
    <head>
        <title>MercadoPago SDK - Create Preference and Show Checkout Example</title>
    </head>
    <body>
       	<a href="<?php echo $preference["response"]["init_point"]; ?>" name="MP-Checkout" class="orange-ar-m-sq-arall">Pay</a>
        <script type="text/javascript" src="//resources.mlstatic.com/mptools/render.js"></script>
    </body>
</html>
