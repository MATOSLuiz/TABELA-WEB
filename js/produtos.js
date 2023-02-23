function mascaraMoeda(event) {
  const onlyDigits = event.target.value
    .split("")
    .filter((s) => /\d/.test(s))
    .join("")
    .padStart(3, "0");
  const digitsFloat = onlyDigits.slice(0, -2) + "." + onlyDigits.slice(-2);
  event.target.value = maskCurrency(digitsFloat);
}

function maskCurrency(valor, locale = "pt-BR", currency = "BRL") {
  return new Intl.NumberFormat(locale, {
    style: "currency",
    currency,
  }).format(valor);
}

function removeCurrencyMask(event) {
  const formattedValue = event.target.value;
  const onlyDigits = formattedValue.replace(/[^\d]+/g, "");
  event.target.value = onlyDigits;
}

var controleCampo = 1;

function adicionarModulo() {
  controleCampo++;
  document
    .getElementById("formulario")
    .insertAdjacentHTML(
      "beforeend",
      '<div class="row mt-2" id="campo' +
        controleCampo +
        '"><div class="col-md-5"><input class="form-control" type="text" name="MODULO[]"></div><div class="col-md-5"><input class="form-control" type="text" oninput="mascaraMoeda(event)" name="VALOR[]"></div><div class="col-md-1"><button type="button" id="' +
        controleCampo +
        '" onclick="removerModulo(' +
        controleCampo +
        ')" class="btn btn-sm btn-danger">-</button></div>'
    );
}

function removerModulo(idCampo) {
  document.getElementById("campo" + idCampo).remove();
}

function desabilitaCampo() {
  const tipoValor = document.querySelector("#TIPO_VALOR");
  const valorMinimo = document.querySelector("#VALOR_MINIMO");
  const valorTabela = document.querySelector("#VALOR_TABELA");

  if (tipoValor.value === "Composto") {
    valorMinimo.disabled = true;
    valorTabela.disabled = true;
  } else {
    valorMinimo.disabled = false;
    valorTabela.disabled = false;
  }
}

function desabilitaCampoEdit() {
  const tipoValor2 = document.querySelector("#editTIPO_VALOR");
  const valorMinimo2 = document.querySelector("#editVALOR_MINIMO");
  const valorTabela2 = document.querySelector("#editVALOR_TABELA");

  if (tipoValor2.value === "Composto") {
    valorMinimo2.disabled = true;
    valorTabela2.disabled = true;
  } else {
    valorMinimo2.disabled = false;
    valorTabela2.disabled = false;
  }
}

$("#editProdutoModal").on("shown.bs.modal", function () {
  const tipoValor = document.querySelector("#editTIPO_VALOR");
  const valorMinimo = document.querySelector("#editVALOR_MINIMO");
  const valorTabela = document.querySelector("#editVALOR_TABELA");

  if (tipoValor.value === "Composto") {
    valorMinimo.disabled = true;
    valorTabela.disabled = true;
    valorTabela.value = "";
    valorMinimo.value = "";
  } else {
    valorMinimo.disabled = false;
    valorTabela.disabled = false;
  }
});

const tbody = document.querySelector("tbody");

const cadForm = document.getElementById("cadProdutoForm");

const modulosModal = document.getElementById("modulos");

const editForm = document.getElementById("editProdutoForm");

const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");

const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");

const msgAlerta = document.getElementById("msgAlerta");

const cadModal = new bootstrap.Modal(
  document.getElementById("cadProdutoModal")
);

const list_produtos = async () => {
  const dados = await fetch("produto_list.php");
  const resposta = await dados.text();
  tbody.innerHTML = resposta;
};

list_produtos();
cadForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const dadosForm = new FormData(cadForm);

  dadosForm.append("add", 1);

  document.getElementById("cadProdutoBtn").value = "Gravando...";

  const dados = await fetch("produto_cad.php", {
    method: "POST",
    body: dadosForm,
  });

  const resposta = await dados.json();
  if (resposta["erro"]) {
    msgAlertaErroCad.innerHTML = resposta["msg"];
    setTimeout(() => {
      msgAlertaErroCad.innerHTML = " ";
    }, 3500);
  } else {
    msgAlerta.innerHTML = resposta["msg"];
    setTimeout(() => {
      msgAlerta.innerHTML = " ";
    }, 3500);
    cadForm.reset();
    cadModal.hide();
    list_produtos();
  }

  document.getElementById("cadProdutoBtn").value = "Gravar";
});

async function visProduto(id) {
  const dados = await fetch("produto_info.php?id=" + id);

  const resposta = await dados.json();

  if (resposta["erro"]) {
    msgAlerta.innerHTML = resposta["msg"];
  } else {
    const infoModal = new bootstrap.Modal(
      document.getElementById("infoProduto")
    );
    infoModal.show();

    document.getElementById("nome").innerHTML = resposta.produto.NOME;
    document.getElementById("fornecedor").innerHTML =
      resposta.produto.fornecedor;
    document.getElementById("tipoValor").innerHTML =
      resposta.produto.TIPO_VALOR;
    document.getElementById("exibePedido").innerHTML =
      resposta.produto.EXIBE_PEDIDO;
    document.getElementById("valorTabela").innerHTML =
      "R$ " + resposta.produto.VALOR_TABELA;
    document.getElementById("valorMinimo").innerHTML =
      "R$ " + resposta.produto.VALOR_MINIMO;
    document.getElementById("valorImplantacao").innerHTML =
      "R$ " + resposta.produto.VALOR_IMPLANTACAO;
    document.getElementById("observacao").innerHTML =
      resposta.produto.OBSERVACAO;

    resposta.modulos.forEach(function (modulo) {
      const modulosList = `${modulo.MODULO} - R$  ${modulo.VALOR}`;
      const listItem = document.createElement("li");
      listItem.textContent = modulosList;
      document.querySelector("#modulos").appendChild(listItem);

      $("#infoProduto").on("hidden.bs.modal", function () {
        $(this).find("li, span").text("").end();
      });
    });
  }
}

async function editProduto(id) {
  const dados = await fetch("produto_info.php?id=" + id);
  const resposta = await dados.json();

  if (resposta["erro"]) {
    msgAlerta.innerHTML = resposta["msg"];
  } else {
    const editModal = new bootstrap.Modal(
      document.getElementById("editProdutoModal")
    );
    editModal.show();
    document.getElementById("editId").value = resposta.produto.id;
    document.getElementById("editNOME").value = resposta.produto.NOME;
    document.getElementById("editFORNECEDOR").value =
      resposta.produto.FORNECEDOR_ID;
    document.getElementById("editTIPO_VALOR").value =
      resposta.produto.TIPO_VALOR;
    document.getElementById("editEXIBE_PEDIDO").value =
      resposta.produto.EXIBE_PEDIDO;
    document.getElementById("editVALOR_TABELA").value =
      resposta.produto.VALOR_TABELA;
    document.getElementById("editVALOR_MINIMO").value =
      resposta.produto.VALOR_MINIMO;
    document.getElementById("editVALOR_IMPLANTACAO").value =
      resposta.produto.VALOR_IMPLANTACAO;
    document.getElementById("editOBSERVACAO").value =
      resposta.produto.OBSERVACAO;

    resposta.modulos.forEach((modulo) => {
      const divValores = document.querySelector("#editValores");
      const divModulos = document.querySelector("#editModulos");
      const input = document.createElement("input");
      const inputValor = document.createElement("input");
      const inputId = document.createElement("input");

      inputId.type = "hidden";
      inputId.name = "modulo_id[]";
      inputId.value = modulo.id;

      input.type = "text";
      input.name = "MODULO[]";
      input.className = "form-control mb-2";
      input.value = modulo.MODULO;

      inputValor.type = "text";
      inputValor.name = "VALOR[]";
      inputValor.className = "form-control mb-2";
      inputValor.value = modulo.VALOR;
      inputValor.setAttribute("oninput", "mascaraMoeda(event);");

      divModulos.appendChild(input);
      divValores.appendChild(inputValor);
      divValores.appendChild(inputId);

      $("#editProdutoModal").on("hidden.bs.modal", function () {
        let contentModulos = document.querySelector("#editModulos");
        let contentValores = document.querySelector("#editValores");
        contentModulos.innerText = "";
        contentValores.innerText = "";
      });
    });
  }
}
editForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  document.getElementById("editProdutoBtn").value = "Salvando...";

  const dadosForm = new FormData(editForm);

  const dados = await fetch("produto_edit.php", {
    method: "POST",
    body: dadosForm,
  });

  const resposta = await dados.json();

  if (resposta["erro"]) {
    msgAlertaErroEdit.innerHTML = resposta["msg"];
  } else {
    msgAlertaErroEdit.innerHTML = resposta["msg"];
    list_produtos();
  }

  document.getElementById("editProdutoBtn").value = "Salvar";
});

async function deleteProduto(id) {
  let confirmar = confirm("Tem certeza que deseja apagar esse Produto?");

  if (confirmar === true) {
    const dados = await fetch("Produto_delete.php?id=" + id);

    const resposta = await dados.json();

    if (resposta["erro"]) {
      msgAlerta.innerHTML = resposta["msg"];
      setTimeout(() => {
        msgAlerta.innerHTML = " ";
      }, 3500);
    } else {
      msgAlerta.innerHTML = resposta["msg"];
      setTimeout(() => {
        msgAlerta.innerHTML = " ";
      }, 3500);
      list_produtos();
    }
  }
}
