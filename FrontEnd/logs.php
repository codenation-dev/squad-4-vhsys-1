<?php

session_start();

if (!isset($_SESSION['Token'])) {
    header("location: index.html");
}

include 'search.php';

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
        <div style="height: 145px; padding-left: 20px; padding-right: 20px; padding-top: 5px;">
            <div style="font-size: 15px; text-align: right;">
                <a href="doLogout.php?token=<?php echo $_SESSION['Token']; ?>" style="color: white;"><img src="Icones/logout.png" alt="Sair" width=25 height=25></a>
            </div>
            <div style="font-size: 25px; color: #FFFFFF">Squad 4 - Projeto Final - Central de Erros</div>
            <div style="text-align:right;" ><a href="cadastroLogs.php" style="color: white; text-decoration:none">Cadastrar novo Log</a><br>
                <a href="logsExcluidos.php" style="color: #FFFFFF; text-decoration:none">Logs Exclu&iacute;dos</a><br>
                <a href="logsArquivados.php" style="color: #FFFFFF; text-decoration:none">Logs Arquivados</a></div>
        </div>
    </div>
    <div style="text-align: left; padding-left: 20px; padding-right: 20px;">
        Ol&aacute; <?php echo $_SESSION['user']; ?>,
        <br>
        Seu Token &eacute;: <div class="card" style="border: 0px; color: #5a6268"> <?php echo $_SESSION['Token']; ?></div>
    </div>
    <br>
    <hr>
    <form name="search" method="GET" action="">
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
                    <input class="form-control" type="search" placeholder="Search" name="search_name">
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
            <th scope="col">#</th>
            <th scope="col">Level</th>
            <th scope="col">Descri&ccedil;&atilde;o</th>
            <th scope="col">Eventos</th>
            <th scope="col">Detalhes</th>
            <th scope="col">Arquivar</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($response as $result){ ?>
            <?php print_r($result) ?>
            <tr style="text-align: center">
                <td>
                    <div class="input-group">
                        <form action="delete.php" method="POST"  >
                            <input  type="hidden" name="id" value="<?php echo $result['id']?>">
                            <button type="Submit" style="border: 0; background-color: transparent; color: #17a2b8 "><i class="fa fa-remove"></i></button>
                        </form>
                    </div>
                </td>
                <th scope="row"><?php echo $result['level'] ?></th>
                <td><?php echo $result['log'] ?></td>
                <td><?php echo $result['events'] ?></td>
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
                                            <b>Eventos</b><br><?php echo $result['events'] ?><br></div>
                                    </div>
                                </div>
                                <div class="modal-body" >
                                    <div class="row" style="text-align: justify">
                                        <div class="col-6" style="text-align: left; float: left"><b>Status</b><br><?php echo $result['status'] ?></div>
                                        <div class="col-6" style="color: #5a6268; text-align: right; float: right"><b>Usu&aacute;rio:</b><br><?php echo $result['name'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fim Modal -->
                </td>
                <?php if ($result['admin']=1) { ?>
                <td>
                    <div class="input-group">
                        <form action="arquivar.php" method="POST"  >
                            <input  type="hidden" name="id" value="<?php echo $result['id']?>">
                            <button type="Submit" style="border: 0; background-color: transparent; color: #17a2b8 "><i class="fa fa-archive"></i></button>
                        </form>
                    </div>
                </td>
                <?php } ?>
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
