<?php

session_start();

$curl = curl_init();


curl_setopt_array($curl, array(
    CURLOPT_URL => "http://backacelera.codeinfinity.com.br/api/v1/logs/create",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "level=".$_POST['level']."&log=".$_POST['log']."&events=".intval($_POST['events'])."&ambience=".$_POST['ambience']."&status=".$_POST['status']."&title=".$_POST['title']."",
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Authorization: bearer ".$_SESSION['Token'],
        "Content-Type: application/x-www-form-urlencoded",
        "Postman-Token: cbfbfbee-1d18-477d-9686-8e4076dfd35c",
        "cache-control: no-cache"
    ),
));



$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $retornoCad = json_decode($response, TRUE);
    if ($retornoCad['message'] == 'Log criado com sucesso!') {
        header('Location: logs.php');
        exit;
    }
}
