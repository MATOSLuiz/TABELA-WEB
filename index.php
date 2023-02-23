<?php
require_once('conexaomysql.php');

if (isset($_POST['usuario']) || isset($_POST['senha'])) {

    if (strlen($_POST['usuario']) == 0) {
        echo  "<script>alert('Digite seu usuário');</script>";
    } else if (strlen($_POST['senha']) == 0) {
        echo  "<script>alert('Digite sua senha!');</script>";
    } else {
        $usuario = $con->real_escape_string($_POST['usuario']);
        $senha = $con->real_escape_string($_POST['senha']);

        $sqlcode = "SELECT * FROM tab_usuario WHERE usuario = '$usuario' AND senha = '$senha'";
        $sqlquery = $con->query($sqlcode) or die("Falha na execução do código SQL: " . $con->error);

        $quantidade = $sqlquery->num_rows;

        if ($quantidade == 1) {
            $user = $sqlquery->fetch_assoc();

            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $user['id'];
            $_SESSION['usuario'] = $user['usuario'];
            $_SESSION['cod_revenda'] = $user['cod_revenda'];

            if (!$_SESSION['id'] == 0) {
                header("location: priorizacao.php");
            } else {
                header("location: ./intersolid/index.php");
            }
        } else {
            echo "<script>alert('Usuário ou senha incorretos, Tente novamente!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prioriza - Login</title>
    <link rel="shortcut icon" href="assets/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="assets/styles.css">
    <link href="assets/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
    }

    .login {
        width: 360px;
        height: min-content;
        padding: 20px;
        border-radius: 12px;
        background-color: #242424;
    }

    .login h1 {
        margin-bottom: 25px;
    }

    .login form {
        font-size: 20px;
    }

    .login form .form-group {
        margin-bottom: 12px;
    }

    .login form input[type="submit"] {
        font-size: 20px;
        margin-top: 15px;
    }

    .logo {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 50px;
        padding: 25px;
    }

    img {
        width: 100px;
        height: 50px;
        margin-bottom: -35px;
    }
</style>

<body>
    <div class="login">
        <div class="logo">
            <img src="./assets/lgc.png">
            <img src="./assets/softtec.png">
            <img src="./assets/custom.png">
            <img src="./assets/VS.png">
        </div>

        <form action="" method="POST">
            <div class="form-group">
                <label class="form-label" for="usuario">Usuário</label>
                <input class="form-control" type="text" name="usuario" id="usuario">
            </div>
            <div class="form-group">
                <label class="form-label" for="senha">Senha</label>
                <input class="form-control" type="password" name="senha" id="senha">
            </div>

            <input class="btn btn-success w-100" type="submit" name="submit" value="Entrar">
        </form>
    </div>
</body>

</html>