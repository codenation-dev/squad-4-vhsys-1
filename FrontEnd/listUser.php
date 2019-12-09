<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://backacelera.codeinfinity.com.br/api/v1/users/list",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Accept-Encoding: gzip, deflate",
        "Authorization: bearer "  . $_SESSION['Token'],
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Type: application/x-www-form-urlencoded",
        "Host: backacelera.codeinfinity.com.br",
        "Postman-Token: b4e01f9c-8f9c-4ccb-84aa-fa75a0babdb5,33879ea7-de17-4873-9dd7-1be422f4cb71",
        "User-Agent: PostmanRuntime/7.20.1",
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $response=json_decode($response,TRUE);
}