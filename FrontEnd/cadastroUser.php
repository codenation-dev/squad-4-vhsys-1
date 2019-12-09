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
  CURLOPT_POSTFIELDS => "name=". $_POST['nome']."&email=".$_POST['email']."&password=".$_POST['password']."&admin=".$_POST['admin'],
  CURLOPT_HTTPHEADER => array(
    "Accept: application/json",
    "Content-Type: application/x-www-form-urlencoded",
    "Postman-Token: cdf3b5e9-c2d4-4d86-9c86-c58949dc029a",
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

print_r($_POST);die;

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $retornoCad = json_decode($response,TRUE);
  if ($retornoCad['Message']=='Registered Successfully') {
    header('Location: login.html');
    exit;
  }
}