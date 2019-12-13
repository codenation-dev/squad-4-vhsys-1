<?php

session_start();

if (!isset($_SESSION['Token'])) {
    header("location: index.html");
}

if ($_SESSION['admin'] == 0) {
    header("location: logs.php");
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
<div style="height: 100%;">
    <div style="background-color: #17a2b8; text-align: center">
        <div style="padding-bottom: 15px; padding-left: 20px; padding-right: 20px; padding-top: 5px;">
            <div style="font-size: 15px; text-align: right;">
                <a href="doLogout.php?token=<?php echo $_SESSION['Token']; ?>" style="color: white;"><img src="Icones/logout.png" alt="Sair" width=25 height=25></a>
            </div>
            <div style="font-size: 25px; color: #FFFFFF">Squad 4 - Projeto Final - Central de Erros</div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="listUsuarios.php">Usu&aacute;rios</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="usuariosExcluidos.php">Usu&aacute;rios Exclu&iacute;dos</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="cadastro.php">Cadastrar Usu&aacute;rio</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="logs.php">Gerenciar Logs</a>
                </li>

            </ul>
        </div>
    </nav>
    <br>
    <div style="text-align: left; padding-left: 20px; padding-right: 20px;">
        Ol&aacute; <?php echo $_SESSION['user']; ?>,
        <br>
        Seu Token &eacute;: <div class="card" style="border: 0px; color: #5a6268"> <?php echo $_SESSION['Token']; ?></div>
    </div>
    <br>
    <hr style="margin-left: 20px; margin-right: 20px;">
    <div style="text-align: center; width: 100%; color: #5a6268">
        <h4>Cadastrado de Usu&aacute;rios</h4>
    </div>
            <br>
            <br>
            <div align="center">
                <form method="POST" action="cadastroUser.php" style="width: 70%">
                    <div  style="text-align: left;">
                        <label>Nome Completo</label>
                        <input type="nome" class="form-control" required oninvalid="this.setCustomValidity('Nome Obrigatório')" onchange="try{setCustomValidity('')}catch(e){}" id="nome" name="nome" placeholder="Nome Completo">
                    </div>
                    <br>
                    <div  style="text-align: left;">
                        <label>E-mail</label>
                        <input type="email" class="form-control" required oninvalid="this.setCustomValidity('E-mail Obrigatório')" onchange="try{setCustomValidity('')}catch(e){}" id="email" name="email" placeholder="Email">
                    </div>
                    <br>
                    <div style="text-align: left;">
                        <label>Senha</label>
                        <input type="password" class="form-control" required oninvalid="this.setCustomValidity('Senha Obrigatório')" onchange="try{setCustomValidity('')}catch(e){}" id="password" name="password" placeholder="Senha">
                    </div>
                    <br>
                    <div style="text-align: left;">
                        <input type="checkbox" name="admin" value="1"> Administrador do Sistema
                    </div>
                    <br>
                    <button type="submit" class="btn btn-outline-secondary">Cadastrar</button>
                    <br>
                    <br>
                </form>
            </div>
            <div>
                <div style="padding-bottom: 15px; padding-left: 20px; padding-right: 20px; padding-top: 15px; background-color: #17a2b8; text-align: center">
                    <div style="color: #FFFFFF;"> Central de Erros @VHSYS</div>
                </div>
            </div>
        </div>
    </body>
</html>