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
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Accept-Encoding: gzip, deflate",
        "Authorization: bearer " . $_SESSION['Token'],
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Type: application/x-www-form-urlencoded",
        "Host: backacelera.codeinfinity.com.br",
        "Postman-Token: 6f166e67-eccc-4ad4-b2b4-80dd7f1f59e6,a6f53345-29eb-4564-9ca4-4802c6319c1b",
        "User-Agent: PostmanRuntime/7.20.1",
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