<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
</head>
<body>
    <h1>Currency Converter</h1>
    <form action="convert.php" method="GET">
        <label for="fromCurrency">Choose currency to convert from:</label>
        <select name="fromCurrency" id="fromCurrency">
            <option value="CAD">Canadian Dollar</option>
            <option value="KRW">South Korean Won</option>
            <option value="USD">US Dollar</option>
        </select>
        <br>
        <label for="amount">Enter amount:</label>
        <input type="text" name="amount" id="amount">
        <button type="submit">Convert</button>
    </form>
    <div id="result">
        <?php
        if (isset($_GET['fromCurrency']) && isset($_GET['amount'])) {
            $fromCurrency = $_GET['fromCurrency'];
            $amount = $_GET['amount'];
            
            $url = "https://currency-converter5.p.rapidapi.com/currency/convert?format=json&from=$fromCurrency&to=EUR&amount=$amount&language=en";

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'x-rapidapi-host: currency-converter5.p.rapidapi.com',
                    'x-rapidapi-key: 22e4862dc5mshbd6cdbeb8446d2bp15bd7ejsn7344d44dba05' // Replace 'key' with your actual RapidAPI key
                ),
            ));

            $response = curl_exec($curl);
            $data = json_decode($response, true);

            if (isset($data['rates']['EUR']['rate'])) {
                echo "Converted amount to EUR: " . $data['rates']['EUR']['rate'] * $amount;
            } else {
                echo "Unable to perform conversion.";
            }

            curl_close($curl);
        }
        ?>
    </div>
</body>
</html>
