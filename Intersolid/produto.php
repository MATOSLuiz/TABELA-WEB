<?php
require_once("./layouts/header.php");
?>

<body>
  <?php

  require_once("layouts/navbar.php");

  require_once("../conexaomysql.php");

  $campoFornecedorCad = "SELECT id, NOME_FANTASIA from tab_fornecedor";
  $result = $conexao->prepare($campoFornecedorCad);
  $result->execute();

  $campoFornecedorEdit = "SELECT id, NOME_FANTASIA from tab_fornecedor";
  $result2 = $conexao->prepare($campoFornecedorEdit);
  $result2->execute();


  ?>

  <style>
    table tbody td {
      cursor: default;
    }
  </style>

  <div class="container">
    <div class="row mt-5">
      <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div>
          <h4>Produtos</h4>
        </div>

        <div>
          <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#cadProdutoModal">
            Novo Produto
          </button>
        </div>
      </div>
    </div>
    <hr>
    <span id="msgAlerta"></span>
    <div class="row">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Fornecedor</th>
              <th>Valor Tabela</th>
              <th>Valor Mínimo</th>
              <th>Valor Implantação</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="modal fade" id="cadProdutoModal" tabindex="-1" aria-labelledby="cadProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cadProdutoModalLabel">Cadastrar Produto </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="cadProdutoForm" class="row g-3 mt-3">
            <div class="col-md-6">
              <label for="NOME" class="form-label">Nome</label>
              <input name="NOME" type="text" class="form-control" id="NOME" required>
            </div>
            <div class="col-md-6">
              <label for="FORNECEDOR" class="form-label">Fornecedor</label>
              <select id="FORNECEDOR" name="FORNECEDOR_ID" class="form-select" required>
                <option value="">Selecione</option>
                <?php while ($row_fornecedor = $result->fetch(PDO::FETCH_ASSOC)) {
                  extract($row_fornecedor);
                  echo "<option value='$id'>" . $NOME_FANTASIA . "</option>";
                } ?>
              </select>
            </div>
            <div class="col-12">
              <label for="TIPO_VALOR" class="form-label">Tipo de valor</label>
              <select id="TIPO_VALOR" name="TIPO_VALOR" class="form-select" onchange="desabilitaCampo()" required>
                <option value="Fixo">Fixo</option>
                <option value="Composto">Composto</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="VALOR_MINIMO" class="form-label">Valor Mínimo</label>
              <input name="VALOR_MINIMO" type="text" class="form-control" onInput="mascaraMoeda(event);" id="VALOR_MINIMO" required">
            </div>
            <div class="col-md-6">
              <label for="VALOR_TABELA" class="form-label">Valor Tabela</label>
              <input name="VALOR_TABELA" class="form-control" id="VALOR_TABELA" onInput="mascaraMoeda(event);" required>
            </div>
            <div class="col-md-6">
              <label for="EXIBE_PEDIDO" class="form-label">Exibe Pedido?</label>
              <select id="EXIBE_PEDIDO" name="EXIBE_PEDIDO" class="form-select" required>
                <option value="">Selecione</option>
                <option value="S">Sim</option>
                <option value="N">Não</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="VALOR_IMPLANTACAO" class="form-label">Valor Implantação</label>
              <input name="VALOR_IMPLANTACAO" type="text" class="form-control" id="VALOR_IMPLANTACAO" onInput="mascaraMoeda(event);">
            </div>
            <div class="col-12">
              <div class="form-floating">
                <textarea name="OBSERVACAO" class="form-control mb-2" style="resize: none;" placeholder="OBS" id="OBSERVACAO"></textarea>
                <label for="floatingTextarea">Observação</label>
              </div>
              <div class="col-12 mt-5 mb-3">
                <div id="formulario">
                  <div class="row mb-4">
                    <div class="col-md-2 d-flex justify-content-start">
                      <h4>Módulos</h4>
                    </div>
                    <div class="col-md-10"><button type="button" onclick="adicionarModulo()" class="btn btn-sm btn-success inline-block">+</button></div>
                  </div>

                  <div class="row">
                    <label for="modulo" class="col-md-5">Módulo</label>
                    <label for="valor" class="col-md-5  d-flex justify-content-start">Valor</label>
                  </div>
                  <div class="row">
                  </div>
                </div>

              </div>
              <span id="msgAlertaErroCad"></span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
              <input type="submit" class="btn btn-success" value="Gravar" id="cadProdutoBtn">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="editProdutoModal" tabindex="-1" aria-labelledby="editProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProdutoModalLabel">Editar Produto </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="editProdutoForm" class="row g-3 mt-3">

            <input name="id" type="hidden" class="form-control" id="editId" required>

            <div class="col-md-6">
              <label for="NOME" class="form-label">Nome</label>
              <input name="NOME" type="text" class="form-control" id="editNOME" required>
            </div>
            <div class="col-md-6">
              <label for="FORNECEDOR" class="form-label">Fornecedor</label>
              <select id="editFORNECEDOR" name="FORNECEDOR_ID" class="form-select" required>
                <option value="">Selecione</option>
                <?php while ($row_fornecedor = $result2->fetch(PDO::FETCH_ASSOC)) {
                  extract($row_fornecedor);
                  echo "<option value='$id'>" . $NOME_FANTASIA . "</option>";
                } ?>
              </select>
            </div>
            <div class="col-12">
              <label for="TIPO_VALOR" class="form-label">Tipo de valor</label>
              <select id="editTIPO_VALOR" name="TIPO_VALOR" onchange="desabilitaCampoEdit()" class="form-select" required>
                <option value="">Selecione</option>
                <option value="Fixo">Fixo</option>
                <option value="Composto">Composto</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="VALOR_MINIMO" class="form-label">Valor Mínimo</label>
              <input name="VALOR_MINIMO" type="text" class="form-control" id="editVALOR_MINIMO" oninput="mascaraMoeda(event);" required>
            </div>
            <div class="col-md-6">
              <label for="VALOR_TABELA" class="form-label">Valor Tabela</label>
              <input name="VALOR_TABELA" class="form-control" id="editVALOR_TABELA" oninput="mascaraMoeda(event);" required>
            </div>
            <div class="col-md-6">
              <label for="EXIBE_PEDIDO" class="form-label">Exibe Pedido?</label>
              <select id="editEXIBE_PEDIDO" name="EXIBE_PEDIDO" class="form-select" required>
                <option value="">Selecione</option>
                <option value="S">Sim</option>
                <option value="N">Não</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="VALOR_IMPLANTACAO" class="form-label">Valor Implantação</label>
              <input name="VALOR_IMPLANTACAO" type="text" class="form-control" id="editVALOR_IMPLANTACAO" oninput="mascaraMoeda(event);">
            </div>
            <div class="col-12">
              <label for="OBSERVACAO">Observação</label>
              <textarea name="OBSERVACAO" class="form-control mb-2" rows="5" cols="30" style="resize: none;" id="editOBSERVACAO"></textarea>
            </div>

            <div class="col-12 mt-5 mb-3">
              <div class="row mb-4">
                <div class="col-md-3 d-flex justify-content-start">
                  <h4>Editar Módulos</h4>
                </div>
                <div id="btnAdicionar" class="col-md-9">

                </div>
              </div>

              <div class="row">
                <label for="modulo" class="col-md-5">Módulo</label>
                <label for="valor" class="col-md-5  d-flex justify-content-start">Valor</label>
              </div>
              <div class="row">
              </div>
            </div>

            <div id="modulosEdit" class="row mt-3 mb-3">

              <div id="editModulos" class="col-md-5">

              </div>
              <div id="editValores" class="col-md-5">

              </div>


            </div>
            <span id="msgAlertaErroEdit"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <input type="submit" class="btn btn-success" value="Salvar" id="editProdutoBtn">
        </div>
        </form>
      </div>
    </div>
  </div>
  </div>


  <div class="modal fade" id="infoProduto" tabindex="-1" aria-labelledby="infoProdutoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="infoProdutoLabel">Detalhes Produto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span id="msgAlertaErroInfo"></span>
          <div class="container">
            <div class="row">
              <div class="col-md-6 mb-2">
                Nome: <span id="nome"></span>
              </div>

              <div class="col-md-6 mb-2">
                Fornecedor: <span id="fornecedor"></span>
              </div>

              <hr>
              <div class="row">
                <div class="col-md-6 mb-2">
                  Tipo de Valor: <span id="tipoValor"></span>
                </div>
                <div class="col-md-6 mb-2">
                  Exibe Para Pedido: <span id="exibePedido"></span>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-4 mb-2">
                  Valor Tabela: <span id="valorTabela"></span>
                </div>
                <div class="col-md-4 mb-2">
                  Valor Mínimo: <span id="valorMinimo">
                </div>
                <div class="col-md-4 mb-2">
                  Valor Implantação: <span id="valorImplantacao">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col mb-2">
                  Observação: <span id="observacao"></span>
                </div>
              </div>
              <hr class="mb-5">
              <h4>Módulos</h4>
              <span id="modulos">

              </span>
            </div>
          </div>
        </div>
      </div>

</body>

</html>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="../js/jquery.mask.js"></script>
<script src="../js/produtos.js"></script>