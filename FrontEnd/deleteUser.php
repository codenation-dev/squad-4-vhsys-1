<?php

session_start();

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "http://backacelera.codeinfinity.com.br/api/v1/users/delete/" . $_POST['id'],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "DELETE",
    CURLOPT_HTTPHEADER => array(
        "Accept: application/json",
        "Accept-Encoding: gzip, deflate",
        "Authorization: bearer " .$_SESSION['Token'],
        "Cache-Control: no-cache",
        "Connection: keep-alive",
        "Content-Length: 0",
        "Host: backacelera.codeinfinity.com.br",
        "Postman-Token: 1f3ab6f5-516f-49a3-a2f4-64be9bce7db4,964ac829-4153-40fa-98a6-399cfd2c82fc",
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
    $retornoDelUser = json_decode($response, TRUE);

    if ($retornoDelUser['Message'] == 'Deleted!') {

        header('Location: listUsuarios.php');
        exit;
    }
}