$(document).ready(function () {
  $(".cep").mask("00000-000");
  $(".telefone").mask("(00) 0000-0000");
  $(".celular").mask("(00) 00000-0000");
  $(".cnpj").mask("00.000.000/0000-00", { reverse: true });
});

const inputCidade = document.querySelector("#CIDADE");
inputCidade.addEventListener("keypress", function (e) {
  const keyCode = e.keyCode ? e.keyCode : e.wich;

  if (keyCode > 47 && keyCode < 58) {
    e.preventDefault();
  }
});

const inputCidadeEdit = document.querySelector("#editCIDADE");
inputCidadeEdit.addEventListener("keypress", function (e) {
  const keyCode = e.keyCode ? e.keyCode : e.wich;

  if (keyCode > 47 && keyCode < 58) {
    e.preventDefault();
  }
});

const tbody = document.querySelector("tbody");

const cadForm = document.getElementById("cadRevendaForm");

const editForm = document.getElementById("editRevendaForm");

const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");

const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");

const msgAlerta = document.getElementById("msgAlerta");

const cadModal = new bootstrap.Modal(
  document.getElementById("cadRevendaModal")
);

const list_revendas = async () => {
  const dados = await fetch("revenda_list.php");
  const resposta = await dados.text();
  tbody.innerHTML = resposta;
};

list_revendas();
cadForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const dadosForm = new FormData(cadForm);

  dadosForm.append("add", 1);

  document.getElementById("cadRevendaBtn").value = "Gravando...";

  const dados = await fetch("revenda_cad.php", {
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
    list_revendas();
  }

  document.getElementById("cadRevendaBtn").value = "Gravar";
});

async function visRevenda(id) {
  const dados = await fetch("revenda_info.php?id=" + id);

  const resposta = await dados.json();

  if (resposta["erro"]) {
    msgAlerta.innerHTML = resposta["msg"];
  } else {
    const infoModal = new bootstrap.Modal(
      document.getElementById("infoRevenda")
    );
    infoModal.show();

    document.getElementById("razaoSocial").innerHTML =
      resposta["dados"].RAZAO_SOCIAL;
    document.getElementById("nomeFantasia").innerHTML =
      resposta["dados"].NOME_FANTASIA;
    document.getElementById("cnpj").innerHTML = resposta["dados"].CNPJ;
    document.getElementById("endereco").innerHTML = resposta["dados"].ENDERECO;
    document.getElementById("numero").innerHTML = resposta["dados"].NUMERO;
    document.getElementById("bairro").innerHTML = resposta["dados"].BAIRRO;
    document.getElementById("cep").innerHTML = resposta["dados"].CEP;
    document.getElementById("cidade").innerHTML = resposta["dados"].CIDADE;
    document.getElementById("uf").innerHTML = resposta["dados"].UF;
    document.getElementById("proprietario").innerHTML =
      resposta["dados"].PROPRIETARIO;
    document.getElementById("celular").innerHTML = resposta["dados"].CELULAR;
    document.getElementById("foneLoja").innerHTML =
      resposta["dados"].FONE_EMPRESA;
    document.getElementById("tipo").innerHTML = resposta["dados"].TIPO;
    document.getElementById("observacao").innerHTML =
      resposta["dados"].OBSERVACAO;
  }
}

async function editRevenda(id) {
  msgAlertaErroEdit.innerHTML = "";
  const dados = await fetch("revenda_info.php?id=" + id);
  const resposta = await dados.json();

  if (resposta["erro"]) {
    msgAlerta.innerHTML = resposta["msg"];
  } else {
    const editModal = new bootstrap.Modal(
      document.getElementById("editRevendaModal")
    );
    editModal.show();
    document.getElementById("editId").value = resposta["dados"].id;
    document.getElementById("editRAZAO_SOCIAL").value =
      resposta["dados"].RAZAO_SOCIAL;
    document.getElementById("editNOME_FANTASIA").value =
      resposta["dados"].NOME_FANTASIA;
    document.getElementById("editCNPJ").value = resposta["dados"].CNPJ;
    document.getElementById("editENDERECO").value = resposta["dados"].ENDERECO;
    document.getElementById("editBAIRRO").value = resposta["dados"].BAIRRO;
    document.getElementById("editNUMERO").value = resposta["dados"].NUMERO;
    document.getElementById("editCEP").value = resposta["dados"].CEP;
    document.getElementById("editCIDADE").value = resposta["dados"].CIDADE;
    document.getElementById("editUF").value = resposta["dados"].UF;
    document.getElementById("editPROPRIETARIO").value =
      resposta["dados"].PROPRIETARIO;
    document.getElementById("editCELULAR").value = resposta["dados"].CELULAR;
    document.getElementById("editFONE_EMPRESA").value =
      resposta["dados"].FONE_EMPRESA;
    document.getElementById("editTIPO").value = resposta["dados"].TIPO;
    document.getElementById("editOBSERVACAO").value =
      resposta["dados"].OBSERVACAO;
  }
}

editForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  document.getElementById("editRevendaBtn").value = "Salvando...";

  const dadosForm = new FormData(editForm);

  const dados = await fetch("revenda_edit.php", {
    method: "POST",
    body: dadosForm,
  });

  const resposta = await dados.json();

  if (resposta["erro"]) {
    msgAlertaErroEdit.innerHTML = resposta["msg"];
  } else {
    msgAlertaErroEdit.innerHTML = resposta["msg"];
    list_revendas();
  }

  document.getElementById("editRevendaBtn").value = "Salvar";
});

async function deleteRevenda(id) {
  let confirmar = confirm("Tem certeza que deseja apagar esse revenda?");

  if (confirmar === true) {
    const dados = await fetch("revenda_delete.php?id=" + id);

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
      list_revendas();
    }
  }
}
