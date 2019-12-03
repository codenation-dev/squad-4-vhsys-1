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
    <br>
    <div  style="text-align: left; float: left; padding-left: 20px; padding-right: 20px;">
        <p>
            <select class="form-control" id="ambience" name="ambience">
                <option value="">Produ&ccedil;&atilde;o </option>
                <option value="">Homologa&ccedil;&atilde;o</option>
                <option value="">Desenvolvimento</option>
            </select>
        </p>
    </div>
    <div  style="text-align: left; float: left ; padding-left: 20px; padding-right: 20px;">
        <p>
            <select class="form-control" id="order" name="order">
                <option value="">Ordenar por: </option>
                <option value="">Level</option>
                <option value="">Eventos</option>
            </select>
        </p>
    </div>
    <div  style="text-align: left; float: left ; padding-left: 20px; padding-right: 20px;">
        <p>
            <select class="form-control" id="search" name="search">
                <option value="">Burcar por: </option>
                <option value="">Level</option>
                <option value="">Descri&ccedil;&atilde;o</option>
                <option value="">Origem</option>
            </select>
        </p>
    </div>
    <div style=" float: left">
        <div class="input-group" style="width: 50vh; padding-left: 20px; padding-right: 20px;">
            <input class="form-control" type="search" placeholder="Search" >
            <div class="input-group-append" >
                <div class="input-group-text"><i class="fa fa-search"></i></div>
            </div>
        </div>
    </div>
    <br>
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

        <?php foreach($response['data'] as $result){ ?>
           <tr style="text-align: center">
                <th scope="row"><?php echo $result['level'] ?></th>
                <td><?php echo $result['log'] ?></td>
               <td><?php echo $result['events'] ?></td>
               <td><?php echo $result['status'] ?></td>
                <td>
                    <div class="container">
                       <button type="button" data-id="<?php  echo $result['id']?>" data-toggle="modal" data-target="#myModal">
                           <i class="fa fa-plus"></i></button>
                    </div>
                    <div class="modal fade" id="myModal" style="text-align: left">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo $result['title'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body" >
                                    <div class="fetched-data" style="float: left">
                                        <h5 class="modal-title">Descri&ccedil;&atilde;o </h5>
                                        <?php echo $result['log'] ?>
                                    </div>
                                    <div class="fetched-data" style="float: right; color: #5a6268">
                                        <h5 class="modal-title">Level </h5>
                                        <?php echo $result['level'] ?>
                                    </div>
                                </div>
                                <div class="modal-body">
                                    <div class="fetched-data" style="float: left">
                                        <h5 class="modal-title">Origem </h5>
                                        <?php echo $result['ambience'] ?>
                                    </div>
                                    <div class="fetched-data" style="float: right; color: #5a6268">
                                        <h5 class="modal-title">Usu&aacute;rio </h5>
                                        <?php echo $result['user_created'] ?>
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
    <div>
        <div style="height: 100px; background-color: #17a2b8; text-align: center">
            <div style="color: #FFFFFF; padding-top: 35px"> Central de Erros @VHSYS</div>
        </div>
    </div>
</div>
</body>
</html>
