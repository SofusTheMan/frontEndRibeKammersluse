<?php
date_default_timezone_set('UTC');

if (!isset($_GET['paymentId'])) {
    header('Location: index.php');
    exit;
}

$paymentId = $_GET['paymentId'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://test.api.dibspayment.eu/v1/payments/$paymentId");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: test-secret-key-cb3942dc0347404c88c9ddf687e889ff',
    'Accept: application/json'
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if ($response === false) {
    $error = curl_error($ch);
    echo "Error retrieving payment info: $error";
    exit();
}

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if ($httpCode !== 200) {
    echo "Error retrieving payment info: HTTP status code $httpCode";
    exit();
}

curl_close($ch);

$paymentInfo = json_decode($response);

if (json_last_error() !== JSON_ERROR_NONE) {
    // handle error
    echo "Error decoding payment info JSON: " . json_last_error_msg();
    exit();
}

// Access the purchased items in the payment info object
if (isset($paymentInfo->payment->charges[0]->orderItems[0])) {
    if ($paymentInfo->payment->orderDetails->reference === "notused") {
        $purchasedItems = $paymentInfo->payment->charges[0]->orderItems[0];

        $unit = explode("_", $purchasedItems->unit);

        $url = 'localhost:8888/';

        if ($unit[0] === "multi-boat") {

            $quantity = $purchasedItems->quantity;
            // Send data to API endpoint
            $url = $url . 'moreBoats';
            $data = array(
                'boatAmount' => $quantity,
                'liftDriveBridge' => $unit[1] === "true" ? true : false,
                'liftWalkBridge' => $unit[2] === "true" ? true : false
            );
        } elseif ($unit[0] === 'single-boat') {
            $url = $url . 'oneBoat';

            $data = array(
                'liftDriveBridge' => $unit[1] === "true" ? true : false,
                'liftWalkBridge' => $unit[2] === "true" ? true : false
            );
        } elseif ($unit[0] === 'korebro') {
            $url = $url . "driveBridge";
            $data = array(
                'liftWalkBridge' => $unit[2] === "true" ? true : false
            );
        }


        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_TIMEOUT => 1,
            CURLOPT_RETURNTRANSFER => true
        );

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        curl_exec($curl);
        curl_close($curl);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://test.api.dibspayment.eu/v1/payments/{$paymentId}/referenceinformation",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => "{\"checkoutUrl\": \"https://ribekammersluse.com/completed.php\",\"reference\": \"used\"}",
            CURLOPT_HTTPHEADER => [
                "Authorization: test-secret-key-cb3942dc0347404c88c9ddf687e889ff",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
} else {
    header('Location: incompleted.php');
}
?>

<!DOCTYPE html>
<html lang="dk">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
        <title>Ribe Kammersluse</title>

        <style type="text/css">
            body {
                background-color: #f2f2f2;
            }

            h1 {
                margin-top: 10%;
            }

            button {
                margin-top: 2%;
            }
        </style>

        <script type="text/javascript">
            function goBack() {
                window.location.href = "https://ribekammersluse.com/"
            }
        </script>

    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col text-center">
                    <h1>Betaling fuldført</h1>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button type="button" class="btn btn-danger btn-lg" onclick="goBack()">Gå tilbage</button>
                </div>
            </div>
        </div>

    </body>
</html>