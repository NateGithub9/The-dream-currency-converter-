<?php
$fromCurrency = $_GET['fromCurrency'];
$amount = $_GET['amount'];

$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => 'https://currency-converter5.p.rapidapi.com/currency/convert?format=json&from=' . $fromCurrency . '&to=EUR&amount=' . $amount . '&language=en',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => '',
    CURLOPT_HTTPHEADER => [
        'x-rapidapi-host: currency-converter5.p.rapidapi.com',
        'x-rapidapi-key: 22e4862dc5mshbd6cdbeb8446d2bp15bd7ejsn7344d44dba05'
    ],
]);

$response = curl_exec($curl);
curl_close($curl);

$convertedData = json_decode($response, true);
$convertedAmount = $convertedData['rates']['EUR']['rate_for_amount'];

echo "<h2>Converted amount:</h2>";
echo "<p>" . $convertedAmount . " Euros</p>";
?>
