<?php 

session_start();

if (!isset($_SESSION['Token'])) {
    header("location: index.html");
}

include 'listLogs.php';

?>

<!DOCTYPE html>
<html lang="br">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <title> Central de Erros </title>
</head>
<body>
<div class="card text-center" style="height: 100%;">
    <div class="card text-white bg-info mb-3">
        <div class="card-header" style="height: 100px;">
            <div style="font-size: 15px; text-align: right;">
            <a href="doLogout.php?token=<?php echo $_SESSION['Token']; ?>" style="color: white;"><img src="Icones/logout.png" alt="Sair" width=25 height=25></a>
            </div>
            <div style="font-size: 25px;">Squad 4 - Projeto Final - Central de Erros</div>
            <div style="text-align:right;" ><a href="cadastroLogs.php" style="color: white; text-decoration:none">Cadastrar novo Erro</a></div>
        </div>
    </div>
    <div style="text-align: left">
        Ol&aacute; Usu&aacute;rio X
        <br>
        <br>
        Seu Token &eacute;: <?php echo $_SESSION['Token']; ?>
    </div>
    <br>
    <br>
    <div class="table-responsive" align="center">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Titulo</th>
                <th scope="col">Ambiente</th>
                <th scope="col">Eventos</th>
                <th scope="col">Status</th>
                <th scope="col">Usu&aacute;rio</th>
                <th scope="col">Detalhes</th>
            </tr>
            </thead>
            <tbody>

        <?php foreach($response['data'] as $result){ ?>
           <tr>
                <th scope="row"><?php echo $result['level'] ?></th>
                <td><?php echo $result['log'] ?></td>
                <td><?php echo $result['ambience'] ?></td>
               <td><?php echo $result['events'] ?></td>
               <td><?php echo $result['status'] ?></td>
                <td><?php echo $result['user_created'] ?></td>
                <td>
                    <div class="container">
                       <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Detalhes</button>
                   </div>
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><?php echo $result['log'] ?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <div class="fetched-data">
                                        <?php echo $result['ambience'] ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
        <?php } ?>
            </tbody>
        </table>
        <br>
    </div>
    <div class="card text-white bg-info mb-3">
        <div class="card-footer" style="height: 100px;">
            <div style="margin-top: 25px"> Central de Erros @VHSYS</div>
        </div>
    </div>
</div>
</body>
</html>
