<?php

$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://backacelera.codeinfinity.com.br/api/v1/registerUser",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "name=". $_POST['nome']."&email=".$_POST['email']."&password=".$_POST['password'],
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: cdf3b5e9-c2d4-4d86-9c86-c58949dc029a",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $retornoToken = json_decode($response,TRUE);
  print_r($retornoToken);
}