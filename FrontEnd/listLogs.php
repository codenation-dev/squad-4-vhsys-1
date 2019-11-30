<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://backacelera.codeinfinity.com.br/api/v1/logs/list",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "email=rosubtil%40gmail.com&password=123456",
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Accept-Encoding: gzip, deflate",
    "Authorization: bearer " . $_SESSION['Token'],
    "Cache-Control: no-cache",
    "Connection: keep-alive",
    "Content-Length: 42",
    "Content-Type: application/x-www-form-urlencoded",
    "Host: backacelera.codeinfinity.com.br",
    "Postman-Token: f7cdbca5-34c6-4ae7-b01d-bc5d3095ab90,21953a58-ec26-4718-9bf9-ea126058a5cf",
    "User-Agent: PostmanRuntime/7.19.0",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  $err;
} else {
  $response=json_decode($response,TRUE);
}