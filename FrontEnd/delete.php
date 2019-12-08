<?php

session_start();

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://backacelera.codeinfinity.com.br/api/v1/logs/delete/" . $_POST['id'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Accept-Encoding: gzip, deflate",
        "Authorization: bearer ".$_SESSION['Token'],
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Length: 0",
        "Content-Type: application/x-www-form-urlencoded",
        "Host: backacelera.codeinfinity.com.br",
        "Postman-Token: b2a4fffc-8cb3-42da-8ba0-c5f54891f4ca,fdf8dd1a-62f4-4d65-b734-bf86041e5c8e",
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
    $retornoDelete = json_decode($response, TRUE);
    if ($retornoDelete['message'] == 'Success in deleting log!') {
        header('Location: logs.php');
        exit;
    }
}