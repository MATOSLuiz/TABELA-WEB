<link href="../assets/bootstrap.min.css" rel="stylesheet">
<?php
require_once "protect.php";
verificaIntersolid($_SESSION['id']);

require_once "conexaomysql.php";

$id = $_SESSION['id'];

$selectSenha = "SELECT * from tab_usuario WHERE id= $id";
$result = $con->query($selectSenha);

if ($result->num_rows > 0) {
    while ($user_data = mysqli_fetch_assoc($result)) {
        $senha = $user_data['senha'];
    }
}

?>

<?php

require_once("layouts/header.php");

?>

<body>
    <?php

    require_once("layouts/navbar.php");

    ?>

    <div class="container mt-5">

        <form action="salvarSenha.php" method="POST">

            <div class="form-floating mb-3">
                <input type="email" class="form-control text-uppercase" disabled id="floatingInput" placeholder="name@example.com" value="<?php echo $_SESSION['usuario'] ?>">
                <label for="floatingInput">Usuario</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="novasenha" id="floatingPassword" placeholder="Password" value="<?php echo $senha ?>">
                <label for="floatingPassword">Digite sua nova senha</label>
            </div>
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input class="btn btn-success" type="submit" name="update" value="Alterar Senha" onclick="return confirm('Senha alterada com sucesso!')">
        </form>
    </div>