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
        <form method="POST" action="login.php" style="width: 70%">
            <div  style="text-align: left;">
                <label>Titulo</label>
                <input type="text" class="form-control" id="titulo" placeholder="Titulo do Log">
            </div>
            <br>
            <div  style="text-align: left;">
                <label>Descri&ccedil;&atilde;o do Erro</label>
                <input type="text" class="form-control" id="descricao" placeholder="255 caracteres" style="height: 255px">
            </div>
            <br>
            <a href="logs.html" class="btn btn-outline-secondary">Voltar</a>
            <a href="" class="btn btn-outline-secondary">Cadastrar</a>

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
