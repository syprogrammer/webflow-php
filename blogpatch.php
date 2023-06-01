<?php
header('Content-Type:application/json');
header('Access-control-Allow-Origin: *');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
$data = json_decode(file_get_contents("php://input"),true);


$postsummary = $data['post-summary'];
$postid = $data['id'];
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.webflow.com/collections/6475ae8d7697e6b0c0d28cfe/items/$postid",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PATCH",
  CURLOPT_POSTFIELDS => "{\"fields\":{\"post-summary\":\".$postsummary.\"}}",
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer 1abf0a43a28577c22b0cab7336be859b626d38968e68f04544361ed61c400287",
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