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
                <th scope="col">Descri&ccedil;&atilde;o</th>
                <th scope="col">Ambiente</th>
                <th scope="col">Status</th>
                <th scope="col">Usu&aacute;rio</th>
            </tr>
            </thead>
            <tbody>
  
        <?php foreach($response['data'] as $result){ ?>
           <tr>
                <th scope="row"><?php echo $result['level'] ?></th>
                <td><?php echo $result['log'] ?></td>
                <td><?php echo $result['ambience'] ?></td>
                <td><?php echo $result['status'] ?></td>
                <td><?php echo $result['user_created'] ?></td>
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
