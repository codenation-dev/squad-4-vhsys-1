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
    CURLOPT_POSTFIELDS =>  "level=". $_POST['level']."title=". $_POST['title']."&status=".$_POST['status']."&log=".$_POST['log']."&ambience=".$_POST['ambience']."&events=".$_POST['events']."&user_created=".$_POST['user_created'],
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Accept-Encoding: gzip, deflate",
        "Authorization: bearer " . $_SESSION['Token'],
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Length: 97",
        "Content-Type: application/x-www-form-urlencoded",
        "Host: backacelera.codeinfinity.com.br",
        "Postman-Token: 1848dae1-39d8-4471-973f-908996ba897e,644eccb9-4d5c-4d27-9734-4f22f7889000",
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
    $retornoCad = json_decode($response, TRUE);
    if ($retornoCad['Message'] == 'Log criado com sucesso!') {
        header('Location: logs.php');
        exit;
    }
}