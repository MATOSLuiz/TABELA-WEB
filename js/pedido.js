function adicionarLoja() {
  controleCampo++;
  const novoCampo = document.createElement("tr");
  novoCampo.id = "campo" + controleCampo;
  novoCampo.dataset.objeto = "objeto" + controleCampo;
  novoCampo.innerHTML = `
      <td class="col-2">
        <input class="form-control cnpj" type="text" name="CNPJ[]" id="cnpj">
      </td>
      <td class="col-1">
        <input class="form-control" type="text" name="QTD_PDV[]" id="qtdPdv${controleCampo}">
      </td>
      <td class="col-3">
        <select class="form-select" id="produto${controleCampo}" aria-label="Selecione uma opção">
          <option selected>Selecione o Produto</option>
        </select>
      </td>
      <td class=" col-1.5">
        <input class="form-control" type="text" name="TOTAL[]" id="total${controleCampo}" disabled>
      </td>
      <td class="col-1.5">
        <input class="form-control" type="text" name="DESCONTO[]" id="desconto${controleCampo}">
      </td>
      <td>
        <input class="form-control" type="text" id="totalComDesconto${controleCampo}" name="TOTAL_DESCONTO[]" disabled>
      </td>
      <td>
        <input class="form-control money" type="text" name="VALOR_DESEJADO[]" id="valorDesejado${controleCampo}">
      </td>
      <td>
        <button type="button" onclick="removerLoja(${controleCampo});" class="btn btn-sm btn-danger">-</button>
      </td>
    `;

  document.getElementById("formulario").appendChild(novoCampo);

  $(".money").mask("000.000.00", { reverse: true });
  $(".cnpj").mask("00.000.000/0000-00", { reverse: true });

  document.getElementById("card").style.display = "block";

  $("#modalPedido").modal("hide");
}

function removerLoja(idCampo) {
  document.getElementById("campo" + idCampo).remove();
}

function visModulo() {
  document.getElementById("modulosvisu").style.display = "block";
}
