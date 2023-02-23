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



   <div class="container">
     <div class="row mt-5">
       <div class="col-lg-12 d-flex justify-content-between align-items-center">
         <div>
           <h4>Clientes</h4>
         </div>

         <div>
           <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#cadClienteModal">
             Novo Cliente
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
               <th>Razão Social</th>
               <th>Nome Fantasia</th>
             </tr>
           </thead>
           <tbody>

           </tbody>
         </table>
       </div>
     </div>
   </div>


   <div class="modal fade" id="cadClienteModal" tabindex="-1" aria-labelledby="cadClienteModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="cadClienteModalLabel">Cadastrar Cliente</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <form id="cadClienteForm" class="row g-3 mt-3">
             <div class="col-md-4">
               <label for="RAZAO_SOCIAL" class="form-label">Razão Social</label>
               <input name="RAZAO_SOCIAL" type="text" class="form-control" id="RAZAO_SOCIAL" required>
             </div>
             <div class="col-md-4">
               <label for="NOME_FANTASIA" class="form-label">Fantasia</label>
               <input name="NOME_FANTASIA" type="text" class="form-control" id="NOME_FANTASIA" required>
             </div>
             <div class="col-md-4">
               <label for="CNPJ" class="form-label">CNPJ</label>
               <input name="CNPJ" type="text" class="form-control cnpj" id="CNPJ" required>
             </div>
             <div class="col-md-4">
               <label for="ENDERECO" class="form-label">Endereço</label>
               <input name="ENDERECO" type="text" class="form-control" id="ENDERECO" required>
             </div>
             <div class="col-md-6">
               <label for="BAIRRO" class="form-label">Bairro</label>
               <input name="BAIRRO" type="text" class="form-control" id="BAIRRO" required>
             </div>
             <div class="col-md-2">
               <label for="NUMERO" class="form-label">Nº</label>
               <input name="NUMERO" type="number" class="form-control" id="NUMERO" required>
             </div>
             <div class="col-md-6">
               <label for="CIDADE" class="form-label">Cidade</label>
               <input name="CIDADE" type="text" class="form-control cidade" id="CIDADE" required>
             </div>
             <div class="col-md-3">
               <label for="UF" class="form-label">UF</label>
               <select id="UF" name="UF" class="form-select" required>
                 <option value="">Selecione</option>
                 <option value="AC">AC</option>
                 <option value="AL">AL</option>
                 <option value="AP">AP</option>
                 <option value="AM">AM</option>
                 <option value="BA">BA</option>
                 <option value="CE">CE</option>
                 <option value="DF">DF</option>
                 <option value="ES">ES</option>
                 <option value="GO">GO</option>
                 <option value="MA">MA</option>
                 <option value="MS">MS</option>
                 <option value="MT">MT</option>
                 <option value="MG">MG</option>
                 <option value="PA">PA</option>
                 <option value="PB">PB</option>
                 <option value="PR">PR</option>
                 <option value="PE">PE</option>
                 <option value="PI">PI</option>
                 <option value="RJ">RJ</option>
                 <option value="RN">RN</option>
                 <option value="RS">RS</option>
                 <option value="RO">RO</option>
                 <option value="RR">RR</option>
                 <option value="SC">SC</option>
                 <option value="SP">SP</option>
                 <option value="SE">SE</option>
                 <option value="TO">TO</option>
               </select>
             </div>
             <div class="col-md-3">
               <label for="CEP" class="form-label">CEP</label>
               <input name="CEP" type="text" class="form-control cep" id="CEP" required>
             </div>
             <div class="col-md-6">
               <label for="PROPRIETARIO" class="form-label">Proprietário</label>
               <input name="PROPRIETARIO" type="text" class="form-control" id="PROPRIETARIO" required>
             </div>
             <div class="col-md-3">
               <label for="CELULAR" class="form-label">Celular</label>
               <input name="CELULAR" type="text" class="form-control celular" id="CELULAR" required>
             </div>
             <div class="col-md-3">
               <label for="FONE_EMPRESA" class="form-label">Telefone Empresa</label>
               <input name="FONE_EMPRESA" type="text" class="form-control telefone" id="FONE_EMPRESA" required>
             </div>
             <div class="col-12">
               <label for="OBSERVACAO">Observação</label>
               <textarea name="OBSERVACAO" class="form-control mb-2" rows="5" cols="30" style="resize: none;" id="OBSERVACAO"></textarea>
             </div>
             <span id="msgAlertaErroCad"></span>

             <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
               <input type="submit" class="btn btn-success" value="Gravar" id="cadClienteBtn">
             </div>
           </form>
         </div>
       </div>
     </div>
   </div>


   <div class="modal fade" id="editClienteModal" tabindex="-1" aria-labelledby="editClienteModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="editClienteModalLabel">Editar Cliente</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <form id="editClienteForm" class="row g-3 mt-3">

             <input name="id" type="hidden" class="form-control" id="editId" required>

             <div class="col-md-4">
               <label for="RAZAO_SOCIAL" class="form-label">Razão Social</label>
               <input name="RAZAO_SOCIAL" type="text" class="form-control" id="editRAZAO_SOCIAL" required>
             </div>
             <div class="col-md-4">
               <label for="NOME_FANTASIA" class="form-label">Fantasia</label>
               <input name="NOME_FANTASIA" type="text" class="form-control" id="editNOME_FANTASIA" required>
             </div>
             <div class="col-md-4">
               <label for="CNPJ" class="form-label">CNPJ</label>
               <input name="CNPJ" type="text" class="form-control cnpj" id="editCNPJ" required>
             </div>
             <div class="col-md-4">
               <label for="ENDERECO" class="form-label">Endereço</label>
               <input name="ENDERECO" type="text" class="form-control" id="editENDERECO" required>
             </div>
             <div class="col-md-6">
               <label for="BAIRRO" class="form-label">Bairro</label>
               <input name="BAIRRO" type="text" class="form-control" id="editBAIRRO" required>
             </div>
             <div class="col-md-2">
               <label for="NUMERO" class="form-label">Nº</label>
               <input name="NUMERO" type="text" class="form-control" id="editNUMERO" required>
             </div>
             <div class="col-md-6">
               <label for="CIDADE" class="form-label">Cidade</label>
               <input name="CIDADE" type="text" class="form-control cidade" id="editCIDADE" required>
             </div>
             <div class="col-md-3">
               <label for="UF" class="form-label">UF</label>
               <select id="editUF" name="UF" class="form-select" required>
                 <option value="">Selecione</option>
                 <option value="AC">AC</option>
                 <option value="AL">AL</option>
                 <option value="AP">AP</option>
                 <option value="AM">AM</option>
                 <option value="BA">BA</option>
                 <option value="CE">CE</option>
                 <option value="DF">DF</option>
                 <option value="ES">ES</option>
                 <option value="GO">GO</option>
                 <option value="MA">MA</option>
                 <option value="MS">MS</option>
                 <option value="MT">MT</option>
                 <option value="MG">MG</option>
                 <option value="PA">PA</option>
                 <option value="PB">PB</option>
                 <option value="PR">PR</option>
                 <option value="PE">PE</option>
                 <option value="PI">PI</option>
                 <option value="RJ">RJ</option>
                 <option value="RN">RN</option>
                 <option value="RS">RS</option>
                 <option value="RO">RO</option>
                 <option value="RR">RR</option>
                 <option value="SC">SC</option>
                 <option value="SP">SP</option>
                 <option value="SE">SE</option>
                 <option value="TO">TO</option>
               </select>
             </div>
             <div class="col-md-3">
               <label for="CEP" class="form-label">CEP</label>
               <input name="CEP" type="text" class="form-control cep" id="editCEP" required>
             </div>
             <div class="col-md-6">
               <label for="PROPRIETARIO" class="form-label">Proprietário</label>
               <input name="PROPRIETARIO" type="text" class="form-control" id="editPROPRIETARIO" required>
             </div>
             <div class="col-md-3">
               <label for="CELULAR" class="form-label">Celular</label>
               <input name="CELULAR" type="text" class="form-control celular" id="editCELULAR" required>
             </div>
             <div class="col-md-3">
               <label for="FONE_EMPRESA" class="form-label">Telefone Empresa</label>
               <input name="FONE_EMPRESA" type="text" class="form-control telefone" id="editFONE_EMPRESA" required>
             </div>
             <div class="col-12">
               <label for="OBSERVACAO">Observação</label>
               <textarea name="OBSERVACAO" class="form-control mb-2" rows="5" cols="30" style="resize: none;" id="editOBSERVACAO"></textarea>
             </div>
             <span id="msgAlertaErroEdit"></span>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
           <input type="submit" class="btn btn-success" value="Salvar" id="editClienteBtn">
         </div>
         </form>
       </div>
     </div>
   </div>
   </div>


   <div class="modal fade" id="infoCliente" tabindex="-1" aria-labelledby="infoClienteLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="infoClienteLabel">Detalhes Cliente</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
           <span id="msgAlertaErroInfo"></span>
           <div class="container">
             <div class="row">
               <div class="col mb-2">
                 Razão Social: <span id="razaoSocial"></span>
               </div>
             </div>
             <hr>
             <div class="row">
               <div class="col mb-2">
                 Nome Fantasia : <span id="nomeFantasia"></span>
               </div>
               <div class="row">
                 <div class="col mb-2">
                   CNPJ: <span id="cnpj"></span>
                 </div>
               </div>

               <hr>
               <div class="row">
                 <div class="col mb-2">
                   Endereço: <span id="endereco"></span>, Nº <span id="numero"></span>
                 </div>
                 <div class="col mb-2">
                   Bairro: <span id="bairro"></span>
                 </div>
                 <div class="col mb-2">
                   CEP: <span id="cep"></span>
                 </div>
                 <div class="col mb-2">
                   Cidade: <span id="cidade"></span> - <span id="uf"></span>
                 </div>
               </div>
               <hr>
               <div class="row">
                 <div class="col mb-2">
                   Proprietário: <span id="proprietario"></span>
                 </div>
               </div>
               <hr>
               <div class="row">
                 <div class="col mb-2">
                   Celular: <span id="celular"></span>
                 </div>
                 <div class="col mb-2">
                   Telefone Empresa: <span id="foneEmpresa"></span>
                 </div>
               </div>
               <hr>
               <div class="row">
                 <div class="col mb-2">
                   Observação: <span id="observacao"></span>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>


 </body>

 </html>
 <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
 <script src="../js/jquery.mask.js"></script>
 <script src="../js/cliente.js"></script>



 <script src="https://cdnjs.com/libraries/jquery.mask"></script>