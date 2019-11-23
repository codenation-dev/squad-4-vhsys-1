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
                <a href="index.html" style="color: white;"><img src="Icones/logout.png" alt="Sair" width=25 height=25></a>
            </div>
            <div style="font-size: 25px;">Squad 4 - Projeto Final - Central de Erros</div>
        </div>
    </div>
    Central de Erros - Usu&aacute;rio X - Token: <?php session_start(); 
    echo $_SESSION['Token']; ?>
    <br>
    <div style="font-size: 15px; text-align: right;">
        <a href="cadastroLogs.html" >Novo Erro</a>
    </div>
    <br>
    <div class="table-responsive" align="center">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Tipo</th>
                <th scope="col">Titulo</th>
                <th scope="col">Descri&ccedil;&atilde;o</th>
                <th scope="col">Status</th>
                <th scope="col">Usu&aacute;rio</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Erro</th>
                <td>Login</td>
                <td>Usu&aacute;rio n&atilde;o cadastrado</td>
                <td>Ativo</td>
                <td>Xxxx</td>
            </tr>
            <tr>
                <th scope="row">Erro2</th>
                <td>Login</td>
                <td>Usu&aacute;rio n&atilde;o cadastrado</td>
                <td>Conclu&iacute;do</td>
                <td>Xxxx</td>
            </tr>
            <tr>
                <th scope="row">Erro3</th>
                <td>Login</td>
                <td>Usu&aacute;rio n&atilde;o cadastrado</td>
                <td>Ativo</td>
                <td>ZZZzzz</td>
            </tr>
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
