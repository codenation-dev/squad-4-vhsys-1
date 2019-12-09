<?php

session_start();

if (!isset($_SESSION['Token'])) {
    header("location: index.html");
}

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
<div class="card text-center" style="height: 100%;">
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
        <h4>Cadastrado de Logs</h4>
    </div>
    <hr style="margin-left: 20px; margin-right: 20px;">
    <br>
    <div class="card-body" align="center">
        <form method="POST" action="createLog.php" style="width: 70%">
            <div  style="text-align: left;">
                <label>Tipo</label>
                <p>
                    <select class="form-control" id="level" name="level">
                        <option value="Warning">Warning</option>
                        <option value="Error">Error</option>
                        <option value="Bug">Bug</option>
                    </select>
                </p>
            </div>
            <div  style="text-align: left;">
                <label>Titulo</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Titulo do Log.">
            </div>
            <br>
            <div  style="text-align: left;">
                <label>Descri&ccedil;&atilde;o do Log</label>
                <input type="text" class="form-control" id="log" name="log" placeholder="255 caracteres" style="height: 255px">
            </div>
            <br>
            <div  style="text-align: left;">
                <label>Eventos</label>
                <input type="number" class="form-control" id="events" name="events" placeholder="Número de Eventos Ocorridos.">
            </div>
            <br>
            <div  style="text-align: left;">
                <label>Status</label>
                <p>
                    <select class="form-control" id="status" name="status">
                        <option value="Ativo">Ativo</option>
                        <option value="Pendente">Pendente</option>
                        <option value="Resolvido">Resolvido</option>
                    </select>
                </p>
            </div>
            <div  style="text-align: left;">
                <label>Ambiente</label>
                <p>
                    <select class="form-control" id="ambience" name="ambience">
                        <option value="Producao">Produ&ccedil;&atilde;o </option>
                        <option value="Homologacao">Homologa&ccedil;&atilde;o</option>
                        <option value="Desenvolvimento">Desenvolvimento</option>
                    </select>
                </p>
            </div>
            <br>
            <a href="logs.php" class="btn btn-outline-secondary">Voltar</a>
            <button type="submit" class="btn btn-outline-secondary">Cadastrar</button>

        </form>
    </div>
    <div class="card text-white bg-info mb-3">
        <div class="card-footer" style="height: 100px;">
            <div style="margin-top: 25px"> Central de Erros @VHSYS</div>
        </div>
    </div>
</div>
</body>
</html>
