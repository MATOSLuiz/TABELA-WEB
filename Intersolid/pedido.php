<?php
require_once("../conexaomysql.php");
require_once("layouts/header.php");
?>

<body>
  <?php

  require_once("layouts/navbar.php");

  ?>

  <style>
    table tbody td {
      cursor: default;
    }
  </style>

  <div class="container mt-5">

    <h2 class="mb-4">Gerar Pedido</h2>

    <div class="row">
      <div class="col-md-4">
        <label for="Número">Número</label>
        <input value="1" type="text" class="form-control" disabled>
      </div>
      <div class="col-md-4">
        <label for="">Apelido</label>
        <input class="form-control" type="text" name="apelido" id="apelido">
      </div>
      <div class="col-md-4">
        <label for="">CNPJ</label>
        <input class="form-control cnpj" type="text" name="cnpj" id="cnpjMatriz">
      </div>
    </div>


    <div class="col-12 mt-5 mb-3">
      <div>
        <div class="row mb-4">
          <div class="mb-3">
            <h4>Lojas</h4>
            <button type="button" onclick="adicionarLoja()" class="btn btn-success">Adicionar Loja</button>
          </div>
        </div>

        <table class="table">
          <thead>
            <tr>
              <th scope="col">CNPJ</th>
              <th scope="col">PDVs</th>
              <th scope="col">Produto</th>
              <th scope="col">Total</th>
              <th scope="col">% Desconto</th>
              <th scope="col">Total com desconto</th>
              <th scope="col">Valor desejado</th>
            </tr>
          </thead>
          <tbody id="formulario">

          </tbody>
        </table>
        <div class="col-12 mt-5 mb-3">
          <div>
            <div class="row mb-4">
              <div class="col-md-1 d-flex justify-content-start">
                <h4>Produto</h4>
              </div>
              <div class="col-md-11"><button type="button" data-bs-toggle="modal" data-bs-target="#modalPedido" class="btn btn-sm btn-success inline-block">+</button></div>
            </div>
            <div class="col-md-4 mb-5">
              <div id="card" class="card">
                <div class="card-header">
                  Produto1
                </div>
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Múdulo</th>
                        <th scope="col">Inclui</th>
                        <th scope="col">Valor</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">Base</th>
                        <td>
                          <div class="form-check">
                            <input checked disabled class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label>
                          </div>
                        </td>
                        <td>R$ 55,00</td>
                      </tr>
                      <tr>
                        <th scope="row">Movimento</th>
                        <td>
                          <div class="form-check">
                            <input checked disabled class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label>
                        </td>
                        <td>R$ 57,00</td>
                      </tr>
                      <tr>
                        <th scope="row">Compras</th>
                        <td>
                          <div class="form-check">
                            <input checked disabled class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            </label>
                        </td>
                        <td>R$ 59,00</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <input type="submit" class="btn btn-success" value="Continuar">


    <!-- Modal -->
    <div class="modal fade" id="modalPedido" tabindex="-1" aria-labelledby="modalPedidoLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalPedidoLabel">Adicionar Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <select onchange="visModulo()" class="form-control form-select" name="PRODUTO[]" id="">
              <option value="" selected>Selecione o Produto</option>
              <option value="Intersolid ERP">Intersolid ERP</option>
            </select>
            <div style="display: none;" id="modulosvisu">
              <table id="pedido" class="table">
                <thead>
                  <tr>
                    <th scope="col">Múdulo</th>
                    <th scope="col">Inclui</th>
                    <th scope="col">Valor</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Base</th>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        </label>
                      </div>
                    </td>
                    <td>R$ 55,00</td>
                  </tr>
                  <tr>
                    <th scope="row">Movimento</th>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        </label>
                    </td>
                    <td>R$ 57,00</td>
                  </tr>
                  <tr>
                    <th scope="row">Compras</th>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                        </label>
                    </td>
                    <td>R$ 59,00</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" onclick="adicionarLoja()" class="btn btn-success">Adicionar ao Pedido</button>
          </div>
        </div>
      </div>
    </div>

  </div>



  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="../js/jquery.mask.js"></script>
  <script src="../js/pedido.js"></script>
  <script>
    document.getElementById("card").style.display = "none";
  </script>