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
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
    <title> Central de Erros </title>
</head>
<body>
<div class="card text-center" style="height: 100%;">
    <div class="card text-white bg-info mb-3">
        <div class="card-header" style="height: 100px;">
            <div style="font-size: 15px; text-align: right;">
            <a href="doLogout.php?token=<?php echo $_SESSION['Token']; ?>" style="color: white;"><img src="Icones/logout.png" alt="Sair" width=25 height=25></a>
            </div>
            <div style="margin-top: 15px; font-size: 25px;">Squad 4 - Projeto Final - Central de Erros</div>
        </div>
    </div>
    Cadastrar novos Erros.
    <br>
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
                        <option value="Produca">Produ&ccedil;&atilde;o </option>
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
