<?php

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.webflow.com/collections/6475ae8d7697e6b0c0d28cfe/items",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer bca210c02bfc95656dc4dedef489838a369fd5792c79770d2d0da86a7b6afc55"
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $arr = json_decode($response,true);
  
  
  for ($i = 0; $i <= 10; $i++) {
   
    echo "<h2>".$arr['items'][$i]['name']."</h2><br>";
    echo "<li>". $arr['items'][$i]['main-image']['url']."</li><br>";
  }

}