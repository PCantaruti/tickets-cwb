async function pesquisarUsuario(registro) {
    //console.log(registro);
    //Receber os dados do formulario
    var cpf = document.querySelector("#cpf" + registro);

    //Recuperar o valor do atributo value
    var valorCpf = cpf.value;
    //console.log(valorCpf);

    //Verificar se o usuario digitou 11 numeros
    if (valorCpf.length == 11) {
        //Fazer a requisicao para o arquivo "visualizar_usuario.php"
        const dados = await fetch('visualizar_usuario.php?cpf=' + valorCpf);
        //Ler os dados
        const resposta = await dados.json();
        //console.log(resposta);
        //Se retornou erro, acessa o IF, senao acessa o ELSE e carrega os dados no formulario
        if (resposta['erro']) {
            document.getElementById("msgAlerta" + registro).innerHTML = resposta['msg'];
        } else {
            document.getElementById("msgAlerta" + registro).innerHTML = "";
            document.getElementById("nome" + registro).value = resposta['dados'].nome;
            document.getElementById("email" + registro).value = resposta['dados'].email;
            document.getElementById("id" + registro).value = resposta['dados'].id;
        }
    }
}

var controleCampo = 1;

function adicionarCampo() {
    controleCampo++;
    var novoCampo = `
        <div class="mb-3" id="campo${controleCampo}">
            <span id="msgAlerta${controleCampo}"></span>
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        <label for="tipo_ingresso${controleCampo}" class="form-label">*Tipo do ingresso:</label>
                        <input type="text" class="form-control" placeholder="Pista/Premium/Arquibancada" name="ingresso${controleCampo}" id="tipo_ingresso${controleCampo}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="valor${controleCampo}" class="form-label">*Valor (Inteira):</label>
                        <input type="text" class="form-control" placeholder="00,00" id="valor${controleCampo}" oninput="atualizarMeiaEntrada(${controleCampo})">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="quant${controleCampo}" class="form-label">*Quantidade:</label>
                        <input type="text" class="form-control" id="quant${controleCampo}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="valor_meia${controleCampo}" class="form-label">Valor (Meia-Entrada):</label>
                        <input type="text" class="form-control" placeholder="00,00" id="valor_meia${controleCampo}" readonly>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label for="quant_meia${controleCampo}" class="form-label">Quantidade (Meia-Entrada)</label>
                        <input type="text" class="form-control" id="quant_meia${controleCampo}">
                        <div class="form-text">Mínimo 40% do total</div>
                    </div>
                </div>
            </div>
            <button class="btn btn-outline-dark" type="button" id="excluir${controleCampo}" onclick="removerCampo(${controleCampo})">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="auto" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                </svg> Excluir
            </button>
        </div>`;
    document.getElementById('formulario').insertAdjacentHTML('beforeend', novoCampo);
    document.getElementById("qnt_campo").value = controleCampo;
}

function removerCampo(idCampo) {
    var campo = document.getElementById('campo' + idCampo);
    if (campo) {
        campo.remove();
    }
}

function atualizarMeiaEntrada(registro) {
    var valorInteiraInput = document.getElementById("valor" + registro);
    var valorInteira = valorInteiraInput.value.replace(/[R$\s]/g, '').replace(',', '.');
    var valorNumerico = parseFloat(valorInteira);

    if (!isNaN(valorNumerico)) {
        var valorMeia = (valorNumerico / 2).toFixed(2).replace('.', ',');
        document.getElementById("valor_meia" + registro).value = valorMeia;
    } else {
        document.getElementById("valor_meia" + registro).value = "00,00";
    }
}

const alertPlaceholder = document.getElementById('liveAlertPlaceholder');
const appendAlert = (message, type) => {
    const wrapper = document.createElement('div');
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('');
    alertPlaceholder.append(wrapper);
};

const alertTrigger = document.getElementById('liveAlertBtn');
if (alertTrigger) {
    alertTrigger.addEventListener('click', () => {
        appendAlert('Nice, you triggered this alert message!', 'success');
    });
}
