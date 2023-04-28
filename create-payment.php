<?php
date_default_timezone_set('Europe/Copenhagen');
header('Content-Type: text/plain');
$payload = file_get_contents('OneBoat.json');
$data = json_decode($payload, true);

$tag = $_POST['tag'];
$num_boats = $_POST['num_boats'];

$lift="_".$_POST["liftDriveBridge"]."_".$_POST["liftWalkBridge"];

if ($tag === 'multi-boat') {
    // Calculate price based on number of boats
    $price_per_boat = 7500;
    

    // Modify order items quantity, grossTotalAmount, and netTotalAmount
    $data['order']['items'][0]['quantity'] = $num_boats<100?$num_boats:100;
    $data['order']['items'][0]['grossTotalAmount'] = $price_per_boat * $num_boats;
    $data['order']['items'][0]['netTotalAmount'] = $price_per_boat * $num_boats;
    $data['order']['items'][0]['unit'] = "multi-boat".$lift;
    // Add discount item
    $discount_item = array(
        'reference' => 'multi-boat-discount',
        'name' => 'Discount (-25 kr per boat)',
        'quantity' => $num_boats,
        'unit' => 'Boats',
        'unitPrice' => -2500,
        'grossTotalAmount' => -2500 * $num_boats,
        'netTotalAmount' => -2500 * $num_boats
    );
    array_push($data['order']['items'], $discount_item);
    
    // Modify order amount
    $data['order']['amount'] = ($price_per_boat - 2500) * $num_boats;

}else{
    if ($tag === "single-boat"){
        $data['order']['items'][0]['name'] = "Boat (50 kr)";
        $data['order']['items'][0]['unit'] = "single-boat".$lift;
        $price = 7500;
    }else{
        $price = 5000;
        $data['order']['items'][0]['name'] = "Kørebro (50 kr)";
        $data['order']['items'][0]['unit'] = "korebro".$lift;
    }
    $num_boats = 1;
    $data['order']['items'][0]['reference'] = $tag;
    $data['order']['items'][0]['quantity'] = $num_boats;
    $data['order']['items'][0]['grossTotalAmount'] = $price;
    $data['order']['items'][0]['netTotalAmount'] = $price;

    $data['order']['amount'] = $price;

}


// Encode modified data back into JSON
$payload = json_encode($data);

assert(json_decode($payload) && json_last_error() == JSON_ERROR_NONE);
$ch = curl_init('https://test.api.dibspayment.eu/v1/payments');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Accept: application/json',
        'Authorization: test-secret-key-cb3942dc0347404c88c9ddf687e889ff'));                                                
$result = curl_exec($ch);
echo $result;
