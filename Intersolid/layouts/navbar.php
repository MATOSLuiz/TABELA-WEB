<header>
    <div class="container" id="nav-container">
        <div class="navbar navbar-expand-lg">
            <a class="navbar-brand fs-5" href="index.php">
                <img id="logo" src="../assets/Logo.png" alt="logo"> Painel WEB
            </a>

            <div class="collapse navbar-collapse justify-content-end" id="navbar-links">
                <div class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php" id="prioriza-menu" class="nav-link nav-item">Priorização</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cadastrar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="cliente.php">Cliente</a></li>
                            <li><a class="dropdown-item" href="fornecedor.php">Fornecedor</a></li>
                            <li><a class="dropdown-item" href="revenda.php">Revenda</a></li>
                            <li><a class="dropdown-item" href="produto.php">Produtos</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="pedido.php" id="prioriza-menu" class="nav-link nav-item">Gerar Pedido</a>
                    </li>
                    <li class="nav-item">
                        <a onclick="return confirm('Deseja realmente sair do sistema?')" href="../sair.php" id="adm-menu" class="nav-link nav-item sair">Sair</a>
                    </li>

                </div>
            </div>

        </div>
    </div>
</header>