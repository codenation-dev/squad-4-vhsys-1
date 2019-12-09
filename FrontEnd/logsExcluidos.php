<?php 

session_start();

if (!isset($_SESSION['Token'])) {
    header("location: index.html");
}

include 'listExcluidos.php';

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
        <div style="height: 160px; padding-left: 20px; padding-right: 20px; padding-top: 5px;">
            <div style="font-size: 15px; text-align: right;">
                <a href="doLogout.php?token=<?php echo $_SESSION['Token']; ?>" style="color: white;"><img src="Icones/logout.png" alt="Sair" width=25 height=25></a>
            </div>
            <div style="font-size: 25px; color: #FFFFFF">Squad 4 - Projeto Final - Central de Erros</div>
            <hr color="#FFFFFF">
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #17a2b8 ">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active" href="#" style="border-right-style: groove; color: #FFFFFF; text-decoration:none">Gerenciar Logs</a>
                        <a class="nav-item nav-link active" href="logs.php" style="border-right-style: groove; color: #FFFFFF; text-decoration:none">Logs</a>
                        <a class="nav-item nav-link active" href="logsExcluidos.php" style="border-right-style: groove; color: #FFFFFF; text-decoration:none">Logs Exclu&iacute;dos</a>
                        <a class="nav-item nav-link active" href="logsArquivados.php" style="border-right-style: groove;color: #FFFFFF; text-decoration:none">Logs Arquivados</a>
                        <a class="nav-item nav-link active" href="cadastroLogs.php" style="border-right-style: groove; color: white; text-decoration:none">Cadastrar novo Log</a>
                        <a class="nav-item nav-link active" href="listUsuarios.php" style="color: #FFFFFF; text-decoration:none">Gerenciar Usu&aacute;rios</a>
                    </div>
                </div>
            </nav>

        </div>
    </div>
    <br>
    <div style="text-align: left; padding-left: 20px; padding-right: 20px;">
        Ol&aacute; <?php echo $_SESSION['user']; ?>,
        <br>
        Seu Token &eacute;: <div class="card" style="border: 0px; color: #5a6268"> <?php echo $_SESSION['Token']; ?></div>
    </div>
    <br>
    <hr style="margin-left: 20px; margin-right: 20px;">
    <div style="text-align: center; width: 100%; color: #5a6268">
        <h4>Lista de Logs Exclu&iacute;dos</h4>
    </div>
    <br>
    <div class="table-responsive" align="center" style="padding-left: 20px; padding-right: 20px;">
        <table class="table table-striped">
            <thead>
            <tr style="text-align: center">
                <th scope="col">Level</th>
                <th scope="col">Descri&ccedil;&atilde;o</th>
                <th scope="col">Eventos</th>
                <th scope="col">Detalhes</th>
            </tr>
            </thead>
            <tbody>

        <?php foreach($response['data'] as $key => $result){ ?>
            <?php $teste = json_decode($result['value']); ?>

           <tr style="text-align: center">
                <th scope="row"><?php if (!isset($teste->level)) { echo "User"; } else { echo $teste->level; } ?></th>
                <td><?php if (!isset($teste->log)) { echo "User: ".$teste->name . ", Email: ".$teste->email; } else { echo $teste->log; } ?></td>
               <td><?php if (!isset($teste->events)) { echo "0"; } else { echo $teste->events; } ?></td>
                <td>
                    <div class="container">
                       <a data-toggle="modal" data-target="#myModal<?php echo $teste->id ?>" style="color: #17a2b8">
                           <i class="fa fa-plus"></i></a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal<?php echo $teste->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel"><?php if (!isset($teste->title)) { echo "Usu&aacute;rio Exclu&iacute;do"; } else { echo $teste->title; } ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                </div>
                                <div class="modal-body" >
                                    <div class="row" style="text-align: justify">
                                        <div class="col-6" style="text-align: left"><?php if (!isset($teste->level)) { echo "User"; } else { echo $teste->level . " em "; } ?> <?php echo $teste->ambience ?></div>
                                    </div>
                                </div>
                                <div class="modal-body" >
                                    <div class="row" style="text-align: justify">
                                        <div class="col-6" style="text-align: left; float: left"><b>Descri&ccedil;&atilde;o</b><br> <?php if (!isset($teste->log)) { echo "User: ".$teste->name . ", Email: ".$teste->email; } else { echo $teste->log; } ?></div>
                                        <div class="col-6" style="color: #5a6268; text-align: right; float: right"><b>Level</b><br><?php if (!isset($teste->level)) { echo "User"; } else { echo $teste->level; } ?><br><br>
                                            <b>Eventos</b><br><?php if (!isset($teste->events)) { echo "0"; } else { echo $teste->events; } ?><br></div>
                                    </div>
                                </div>
                                <div class="modal-body" >
                                    <div class="row" style="text-align: justify">
                                        <div class="col-6" style="text-align: left; float: left"><b>Status</b><br><?php if (!isset($teste->status)) { echo "Exclu&iacute;do"; } else { echo $teste->status; } ?></div>
                                        <div class="col-6" style="color: #5a6268; text-align: right; float: right"><b>Usu&aacute;rio:</b><br><?php echo $result['name'] ?></div>
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
        <hr>
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
