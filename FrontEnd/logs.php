<?php 

session_start();

if (!isset($_SESSION['Token'])) {
    header("location: index.html");
}

if (!empty($_POST)) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://backacelera.codeinfinity.com.br/api/v1/logs/search?select=level,log,status,events&ambience=".$_POST['ambience']."&order=".$_POST['order'],
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
            "Postman-Token: 2f7e2ccb-46c9-41aa-99ae-16b234b4c418,3fbbae0e-82b0-40a8-84e5-7a29d9a7a021",
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
} else {
    include 'listLogs.php';
}
?>

<!DOCTYPE html>
<html lang="br" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <title> Central de Erros </title>
</head>
<body>
<div style="height: 100%">
    <div style="background-color: #17a2b8; text-align: center">
        <div style="height: 100px; padding-left: 20px; padding-right: 20px; padding-top: 5px;">
            <div style="font-size: 15px; text-align: right;">
            <a href="doLogout.php?token=<?php echo $_SESSION['Token']; ?>" style="color: white;"><img src="Icones/logout.png" alt="Sair" width=25 height=25></a>
            </div>
            <div style="font-size: 25px; color: #FFFFFF">Squad 4 - Projeto Final - Central de Erros</div>
            <div style="text-align:right;" ><a href="cadastroLogs.php" style="color: white; text-decoration:none">Cadastrar novo Erro</a></div>
        </div>
    </div>
    <div style="text-align: left; padding-left: 20px; padding-right: 20px;">
        Ol&aacute; <?php echo $_SESSION['user']; ?>,
        <br>
        Seu Token &eacute;: <div class="card" style="border: 0px; color: #5a6268"> <?php echo $_SESSION['Token']; ?></div>
    </div>
    <br>
    <hr>
    <form name="search" method="POST" action="logs.php">
        <div  style="text-align: left; float: left; padding-left: 20px; padding-right: 20px;">
            <p>
                <select class="form-control" id="ambience" name="ambience">
                    <option value="">Origem:  </option>
                    <option value="Produção">Produ&ccedil;&atilde;o </option>
                    <option value="Homologação">Homologa&ccedil;&atilde;o</option>
                    <option value="Desenvolvimento">Desenvolvimento</option>
                </select>
            </p>
        </div>
        <div  style="text-align: left; float: left ; padding-left: 20px; padding-right: 20px;">
            <p>
                <select class="form-control" id="order" name="order">
                    <option value="">Ordenar por: </option>
                    <option value="level">Level</option>
                    <option value="events">Eventos</option>
                </select>
            </p>
        </div>
        <div  style="text-align: left; float: left ; padding-left: 20px; padding-right: 20px;">
            <p style=" float: left">
                <select class="form-control" name="search">
                    <option value="">Burcar por: </option>
                    <option value="level">Level</option>
                    <option value="log">Descri&ccedil;&atilde;o</option>
                    <option value="ambience">Origem</option>
                </select>
            </p>
            <div style=" float: right">
                <div class="input-group" style="width: 50vh; padding-left: 20px; padding-right: 20px;">
                    <input class="form-control" type="search" placeholder="Search">
                    <input type="submit"></div>
                </div>
            </div>
        </div>
    </form>
    <br>
    <div class="table-responsive" align="center" style="padding-left: 20px; padding-right: 20px;">
        <table class="table table-striped">
            <thead>
            <tr style="text-align: center">
                <th scope="col">Level</th>
                <th scope="col">Descri&ccedil;&atilde;o</th>
                <th scope="col">Eventos</th>
                <th scope="col">Status</th>
                <th scope="col">Detalhes</th>
            </tr>
            </thead>
            <tbody>
            <?php print_r($response); ?>
        <?php foreach($response['data'] as $result){ ?>

           <tr style="text-align: center">
                <th scope="row"><?php echo $result['level'] ?></th>
                <td><?php echo $result['log'] ?></td>
               <td><?php echo $result['events'] ?></td>
               <td><?php echo $result['status'] ?></td>
                <td>
                    <div class="container">
                       <a data-toggle="modal" data-target="#myModal<?php echo $result['id'] ?>" style="color: #17a2b8">
                           <i class="fa fa-plus"></i></a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $result['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><?php echo $result['title'] ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                </div>
                                <div class="modal-body" >
                                    <div class="row" style="text-align: justify">
                                        <div class="col-6" style="text-align: left"><?php echo $result['level'] ?> em <?php echo $result['ambience'] ?></div>
                                    </div>
                                </div>
                                <div class="modal-body" >
                                    <div class="row" style="text-align: justify">
                                        <div class="col-6" style="text-align: left; float: left"><b>Descri&ccedil;&atilde;o</b><br> <?php echo $result['log'] ?></div>
                                        <div class="col-6" style="color: #5a6268; text-align: right; float: right"><b>Level</b><br><?php echo $result['level'] ?><br><br>
                                            <b>Eventos</b><br><?php echo $result['events'] ?><br><br>
                                            <b>Usu&aacute;rio:</b><br><?php echo $result['name'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fim Modal -->
                </td>
            </tr>
        <?php } ?>
            </tbody>
        </table>
        <br>
    </div>
    <div>
        <div style="height: 100px; background-color: #17a2b8; text-align: center">
            <div style="color: #FFFFFF; padding-top: 35px"> Central de Erros @VHSYS</div>
        </div>
    </div>
</div>
</body>
</html>
