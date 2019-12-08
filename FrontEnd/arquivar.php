<?php

session_start();

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://backacelera.codeinfinity.com.br/api/v1/logs/tofile/" . $_POST['id'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Accept-Encoding: gzip, deflate",
        "Authorization: bearer ".$_SESSION['Token'],
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Length: 0",
        "Content-Type: application/x-www-form-urlencoded",
        "Host: backacelera.codeinfinity.com.br",
        "Postman-Token: a66105da-999b-4096-a166-f8932b0229c1,660f1f2d-c059-401a-9558-b38e90322b9e",
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
    $retornoArq = json_decode($response, TRUE);
    if ($retornoArq['message'] == 'Success in archiving the log!') {
        header('Location: logs.php');
        exit;
    }
}
