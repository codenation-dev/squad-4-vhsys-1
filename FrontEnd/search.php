<?php

session_start();

$url = "http://backacelera.codeinfinity.com.br/api/v1/logs/search";
if(!empty($_GET)) {
    $uqeryString = http_build_query($_GET);
    $url = "http://backacelera.codeinfinity.com.br/api/v1/logs/search?".$uqeryString;
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
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
        "cache-control: no-cache"
    ),
));


$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if (! $err) {
    $response = json_decode($response, TRUE);
    print_r($response);die;
    header('Location: logsSearch.php');
    exit;
}
