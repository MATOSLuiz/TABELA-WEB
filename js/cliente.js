$(document).ready(function () {
  $(".cep").mask("00000-000");
  $(".telefone").mask("0000-0000");
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

const cadForm = document.getElementById("cadClienteForm");

const editForm = document.getElementById("editClienteForm");

const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");

const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");

const msgAlerta = document.getElementById("msgAlerta");

const cadModal = new bootstrap.Modal(
  document.getElementById("cadClienteModal")
);

const listClientes = async () => {
  const dados = await fetch("cliente_list.php");
  const resposta = await dados.text();
  tbody.innerHTML = resposta;
};

listClientes();
cadForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  const dadosForm = new FormData(cadForm);

  dadosForm.append("add", 1);

  document.getElementById("cadClienteBtn").value = "Gravando...";

  const dados = await fetch("cliente_cad.php", {
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
    listClientes();
  }

  document.getElementById("cadClienteBtn").value = "Gravar";
});

async function visCliente(id) {
  const dados = await fetch("cliente_info.php?id=" + id);

  const resposta = await dados.json();

  if (resposta["erro"]) {
    msgAlerta.innerHTML = resposta["msg"];
  } else {
    const infoModal = new bootstrap.Modal(
      document.getElementById("infoCliente")
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
    document.getElementById("foneEmpresa").innerHTML =
      resposta["dados"].FONE_EMPRESA;
    document.getElementById("observacao").innerHTML =
      resposta["dados"].OBSERVACAO;
  }
}

async function editCliente(id) {
  msgAlertaErroEdit.innerHTML = "";
  const dados = await fetch("cliente_info.php?id=" + id);
  const resposta = await dados.json();

  if (resposta["erro"]) {
    msgAlerta.innerHTML = resposta["msg"];
  } else {
    const editModal = new bootstrap.Modal(
      document.getElementById("editClienteModal")
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
    document.getElementById("editOBSERVACAO").value =
      resposta["dados"].OBSERVACAO;
  }
}

editForm.addEventListener("submit", async (e) => {
  e.preventDefault();

  document.getElementById("editClienteBtn").value = "Salvando...";

  const dadosForm = new FormData(editForm);

  const dados = await fetch("cliente_edit.php", {
    method: "POST",
    body: dadosForm,
  });

  const resposta = await dados.json();

  if (resposta["erro"]) {
    msgAlertaErroEdit.innerHTML = resposta["msg"];
  } else {
    msgAlertaErroEdit.innerHTML = resposta["msg"];
    listClientes();
  }

  document.getElementById("editClienteBtn").value = "Salvar";
});

async function deleteCliente(id) {
  let confirmar = confirm("Tem certeza que deseja apagar esse Cliente?");

  if (confirmar === true) {
    const dados = await fetch("cliente_delete.php?id=" + id);

    const resposta = await dados.json();

    if (resposta["erro"]) {
      msgAlerta.innerHTML = resposta["msg"];
    } else {
      msgAlerta.innerHTML = resposta["msg"];
      listClientes();
    }
  }
}
