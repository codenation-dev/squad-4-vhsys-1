<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://backacelera.codeinfinity.com.br/api/v1/users/listdeleted",
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
        "Host: backacelera.codeinfinity.com.br",
        "Postman-Token: 93979f48-d289-4c02-9a63-ce8db7a21900,c2c4fada-bc16-4a42-ac1d-3009cc144455",
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
    $response = json_decode($response, TRUE);
}