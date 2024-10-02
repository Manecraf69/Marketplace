<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vender veículos</title>

    <style>
        form {
            max-width: 700px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        .linha {
            display: flex;
            justify-content: space-between;
            gap: 10px; /* Espaçamento entre os campos */
        }

        .linha .coluna {
            flex: 1; /* Cada coluna ocupa o mesmo espaço */
        }

        textarea {
            width: 100%;
            overflow: hidden; /* Evita barras de rolagem */
            resize: none; /* Evita redimensionamento manual */
        }

        /* Estilo do botão de confirmar cadastro */
        .confirmar-btn {
            margin-top: 20px;
            padding: 10px;
            background-color: #11c020;
            color: #ffffff;
            border: none;
            cursor: pointer;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            display: block;
            margin-bottom: 50px;
        }

        .confirmar-btn:hover {
            background-color: #457945; /* Cor ao passar o mouse por cima */
        }

        /* Estilo para as linhas de texto informativas */
        #informacao {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            margin: 0px auto 0px;
            text-decoration: underline;
            width: fit-content;
        }

        /* Estilo para as caixas de fundo dos campos de informação */
        .caixasDeSeparacao {
            margin: 20px;
            padding: 15px;
            background-color: #333;
            border-radius: 8px;
        }

        /* Estilo para desativar a seleção ao clicar na label ou nas caixas de texto com apenas leitura */
        .coluna input[readonly], .coluna label {
            cursor: default;
            pointer-events: none;
        }

        /* Estilo para os popups de caso de exceção */
        #popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9); /* Fundo semi-transparente */
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        #popupContent {
            background-color: #3b3b3b; /* Fundo do pop-up */
            border: 2px solid #1d1d1d; /* Borda */
            padding: 20px;
            text-align: center;
            width: 300px;
            font-family: 'Courier New', Courier, monospace;
        }
        #popupMessage {
            margin-bottom: 20px;
        }
        #closePopup {
            background-color: #303030;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        /* Responsividade: Estilos específicos para celulares */
        @media (max-width: 700px) {
            .linha {
                flex-direction: column; /* Empilha os itens na vertical */
            }

            .confirmar-btn {
                width: 100%; /* Botão ocupa toda a largura */
            }

            form {
                padding: 10px; /* Adiciona um espaçamento interno */
            }

            input, textarea, select {
                font-size: 16px; /* Aumenta o tamanho da fonte para telas menores */
            }

            #informacao {
                font-size: 16px;
            }

            .caixasDeSeparacao {
                margin: 0px;
                margin-top: 20px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <title>Vender</title>
    <?php include 'header.php'; ?>

    <div id="popup" style="display: none;">
        <div id="popupContent">
            <div id="popupMessage">Mensagem de erro aqui</div>
            <button id="closePopup">Fechar</button>
        </div>
    </div>    

    <form action="processa_cadastro.php" method="post" enctype="multipart/form-data">

        <div class="caixasDeSeparacao">
            <!-- Título para as informações gerais -->
            <div class="linha" id="informacao">Dados gerais:</div>
            
            <!-- Linha 1: Tipo de veículo, Marca, Modelo -->
            <div class="linha">
                <!-- Tipo de Veículo -->
                <div class="coluna">
                    <label for="tipo_veiculo">Tipo de veículo: <span style="color: red;">*</span></label>
                    <select name="tipo_veiculo" id="tipo_veiculo" required onchange="onVehicleTypeChange()">
                        <option value="" disabled selected>Carro / Moto</option>
                        <option value="carro">Carro</option>
                        <option value="moto">Moto</option>
                    </select>
                </div>

                <!-- Marca (Inicialmente Invisível) -->
                <div class="coluna" id="marca_div" style="display: none;">
                    <label for="marca">Marca: <span style="color: red;">*</span></label>
                    <select name="marca" id="marca" required onchange="onMarcaChange()"></select>
                    <input type="text" name="marca_outro" id="marca_outro" placeholder="Digite a marca" style="display:none;">
                </div>

                <!-- Modelo (Inicialmente Invisível) -->
                <div class="coluna" id="modelo_div" style="display: none;">
                    <label for="modelo">Modelo: <span style="color: red;">*</span></label>
                    <select name="modelo" id="modelo" required></select>
                    <input type="text" name="modelo_outro" id="modelo_outro" placeholder="Digite o modelo" style="display:none;">
                </div>
            </div>

            <!-- Linha 2: Ano, Hodometro, Valor -->
            <div class="linha">
                <!-- Ano -->
                <div class="coluna">
                    <label for="ano">Ano: <span style="color: red;">*</span></label>
                    <select name="ano" id="ano" required>
                        <option value="" disabled selected>Selecione o ano</option>
                        <!-- Gera as opções de 2025 até 1901 -->
                        <script>
                            const anoAtual = new Date().getFullYear() + 1; // próximo ano
                            for (let ano = anoAtual; ano >= 1901; ano--) {
                                document.write(`<option value="${ano}">${ano}</option>`);
                            }
                        </script>
                    </select>
                </div>

                <!-- Hodômetro -->
                <div class="coluna">
                    <label for="hodometro">KMs rodados: <span style="color: red;">*</span></label>
                    <input type="text" name="hodometro" id="hodometro" placeholder="Ex: 150.000km" required>
                </div>  

                <!-- Valor à vista -->
                <div class="coluna">
                    <label for="valor">Valor à vista: <span style="color: red;">*</span></label>
                    <input type="text" name="valor" id="valor" placeholder="Ex: R$25.000,00" oninput="formatarValor(this)" required>
                </div>
            </div>

            <!-- Linha 3: Telefone, Imagens -->
            <div class="linha">
                <!-- Telefone -->
                <div class="coluna">
                    <label for="telefone">Telefone: <span style="color: red;">*</span></label>
                    <input type="text" name="telefone" id="telefone" placeholder="(00) 90000-0000" required>
                </div>

                <!-- Imagens do veículo -->
                <div class="coluna">
                    <label for="imagem">Fotos do veículo: <span style="color: red;">*</span></label>
                    <input type="file" name="imagem[]" id="imagem" accept="image/*" multiple required>
                </div>
            </div>

            <!-- Linha 4: Descrição -->
            <label for="descricao">Descrição: <span style="color: red;">*</span></label>
            <textarea name="descricao" id="descricao" placeholder="Adicione uma descrição detalhada do veículo" required></textarea>
        </div>

        <div class="caixasDeSeparacao">
            <!-- Título para a localização do veículo -->
            <div class="linha">
                <span id="textoOculto" style="display: none; color: red;">CEP inválido</span>
                <span id="informacao">Informações do local da venda:</span>
            </div>
            
            <!-- Linha 5: Local do veículo -->
            <div class="linha">
                <!-- Campo de CEP -->
                <div class="coluna">
                    <label for="cep">CEP: <span style="color: red;">*</span></label>
                    <input type="text" name="cep" id="cep" placeholder="00000-000" maxlength="9" required>
                </div>

                <!-- Estado (preenchido automaticamente) -->
                <div class="coluna">
                    <label for="estado">Estado:</label>
                    <input type="text" name="estado" id="estado" placeholder="* autopreenchimento" readonly>
                </div>

                <!-- Cidade (preenchido automaticamente) -->
                <div class="coluna">
                    <label for="cidade">Cidade:</label>
                    <input type="text" name="cidade" id="cidade" placeholder="* autopreenchimento" readonly>
                </div>

                <!-- Bairro (preenchido automaticamente) -->
                <div class="coluna">
                    <label for="bairro">Bairro:</label>
                    <input type="text" name="bairro" id="bairro" placeholder="* autopreenchimento" readonly>
                </div>
            </div>
        </div>

        <div class="caixasDeSeparacao">
            <!-- Título para os campos opcionais -->
            <div class="linha" id="informacao">Opcional:</div>

            <!-- Linha 7: Troca, Retirada de peças, Venda das rodas -->
            <div class="linha">
                <!-- Troca -->
                <div class="coluna">
                    <label for="troca">Aceita troca?</label>
                    <select name="troca" id="troca">
                        <option value="" disabled selected>Sim / Não</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>

                <!-- Retirada de peças -->
                <div class="coluna">
                    <label for="pecas">Retirada de peças?</label>
                    <select name="pecas" id="pecas">
                        <option value="" disabled selected>Definir</option>
                        <option value="Apenas veículo completo">Apenas veículo completo</option>
                        <option value="Apenas peças">Apenas peças</option>
                        <option value="Completo ou peças">Completo ou peças</option>
                    </select>
                </div>

                <!-- Venda de rodas -->
                <div class="coluna">
                    <label for="rodas">Venda das rodas?</label>
                    <select name="rodas" id="rodas">
                        <option value="" disabled selected>Sim / Não</option>
                        <option value="Sim">Sim</option>
                        <option value="Não">Não</option>
                    </select>
                </div>
            </div>

            <!-- Linha 8: Pintura, Mecânica, Quantidade de donos -->
            <div class="linha">
                <!-- Pintura e lataria -->
                <div class="coluna">
                    <label for="estetica">Pintura e lataria:</label>
                    <select name="estetica" id="estetica">
                        <option value="" disabled selected>Definir</option>
                        <option value="Impecável">Impecável</option>
                        <option value="Quase perfeita">Quase perfeita</option>
                        <option value="Com detalhes a fazer">Com detalhes a fazer</option>
                        <option value="Acabada">Acabada</option>
                    </select>
                </div>

                <!-- Mecânica -->
                <div class="coluna">
                    <label for="mecanica">Mecânica:</label>
                    <select name="mecanica" id="mecanica">
                        <option value="" disabled selected>Definir</option>
                        <option value="Impecável">Impecável</option>
                        <option value="Quase perfeita">Quase perfeita</option>
                        <option value="Com detalhes a fazer">Com detalhes a fazer</option>
                        <option value="Acabada">Acabada</option>
                    </select>
                </div>

                <!-- Donos -->
                <div class="coluna">
                    <label for="quantidade_donos">Donos:</label>
                    <select name="quantidade_donos" id="quantidade_donos">
                        <option value="" disabled selected>Definir</option>
                        <option value="Desconhecido">Desconhecido</option>
                        <option value="Apenas 1 dono">Apenas 1 dono</option>
                        <option value="Teve 2 donos">Teve 2 donos</option>
                        <option value="3 ou mais">3 ou mais</option>
                    </select>
                </div>
            </div>

            <!-- Linha 9: Vida útil dos pneus, Tipo de pneus, Tamanho dos pneus -->
            <div class="linha">
                <!-- Pneus-->
                <div class="coluna">
                    <label for="condicao_rodas">Pneus:</label>
                    <select name="condicao_rodas" id="condicao_rodas">
                        <option value="" disabled selected>Definir</option>
                        <option value="Novos">Novos</option>
                        <option value="Semi-Novos">Semi-Novos</option>
                        <option value="Meia vida">Meia vida</option>
                        <option value="Carecas">Carecas</option>
                    </select>
                </div>

                <!-- Tipo -->
                <div class="coluna">
                    <label for="tipo_rodas">Tipo de rodas:</label>
                    <select name="tipo_rodas" id="tipo_rodas">
                        <option value="" disabled selected>Definir</option>
                        <option value="Ferro / Raiada">Ferro / Raiada</option>
                        <option value="Liga leve">Liga leve</option>
                    </select>
                </div>

                <!-- Tamanho -->
                <div class="coluna">
                    <label for="tamanho_rodas">Tamanho do aro:</label>
                    <input type="text" name="tamanho_rodas" id="tamanho_rodas" placeholder="Ex: 17''">
                </div>
            </div>
        </div>

        <!-- Linha 10: Botão de cadastro -->
        <button class="confirmar-btn" id="confirmarBtn" type="submit">Cadastrar veículo para venda</button>
    </form>

    <script>
        // Formatar itens com preço
        function formatarValor(campo) {
            let valor = campo.value.replace(/\D/g, ''); // Remove tudo que não for dígito
            
            // Limita o valor a 11 dígitos
            if (valor.length > 9) {
                valor = valor.slice(0, 9);
            }

            if (valor) {
                // Formata o número com separadores de milhares e fixa os centavos em 00
                valor = new Intl.NumberFormat('pt-BR', { 
                    style: 'currency', 
                    currency: 'BRL', 
                    minimumFractionDigits: 2 
                }).format(valor / 100);
                campo.value = valor;
            } else {
                campo.value = ''; // Limpa o campo se não houver valor
            }
        }

        // Formatar o número de telefone
        document.getElementById('telefone').addEventListener('input', function (e) {
            let tel = e.target.value;
            
            // Remove tudo que não for número
            tel = tel.replace(/\D/g, '');
            
            // Limita a 11 dígitos
            if (tel.length > 11) {
                tel = tel.substring(0, 11);
            }
            
            // Aplica a formatação de telefone (00) 90000-0000
            tel = tel.replace(/^(\d{2})(\d)/g, '($1) $2'); // Coloca os parênteses e espaço após o DDD
            tel = tel.replace(/(\d)(\d{4})$/, '$1-$2');   // Coloca o hífen no meio do número
            
            e.target.value = tel;  // Atualiza o campo com a formatação
        });

        // Formatar o valor do hodômetro
        document.getElementById('hodometro').addEventListener('input', function (e) {
            let kms = e.target.value.replace(/\D/g, ''); // Remove tudo que não for dígito, exceto "km"

            // Limita a 7 dígitos
            if (kms.length > 7) {
                kms = kms.substring(0, 7);
            }

            // Formata o número usando o Intl.NumberFormat para o estilo brasileiro
            if (kms) {
                kms = new Intl.NumberFormat('pt-BR', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(kms);
            }

            // Adiciona " km" ao final
            e.target.value = kms + ' km';

            // Posiciona o cursor antes de " km"
            e.target.setSelectionRange(kms.length, kms.length);
        });

        // Formatar o valor do tamanho da roda
        document.getElementById('tamanho_rodas').addEventListener('input', function (e) {
            let aro = e.target.value.replace(/\D/g, ''); // Remove tudo que não for dígito

            // Limita a 2 dígitos
            if (aro.length > 2) {
                aro = aro.substring(0, 2);
            }

            // Adiciona "''" ao final
            e.target.value = aro + "''";

            // Posiciona o cursor antes de "''"
            e.target.setSelectionRange(aro.length, aro.length);
        });

        // Configura o input de texto da descrição
        document.getElementById('descricao').addEventListener('input', function () {
            const descricao = this;

            // Limita a 3000 caracteres
            if (descricao.value.length > 3000) {
                descricao.value = descricao.value.substring(0, 3000);
            }

            // Ajusta a altura dinamicamente
            descricao.style.height = 'auto'; // Reseta a altura para calcular corretamente
            descricao.style.height = descricao.scrollHeight + 'px'; // Define a nova altura conforme o conteúdo
        });

        // Usa o CEP informado para retornar Estado, Cidade e Bairro
        document.getElementById('cep').addEventListener('input', function () {
            let cep = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos

            // Limita a quantidade de dígitos a 8
            if (cep.length > 8) {
                cep = cep.slice(0, 8);
            }

            // Formatar com hífen se tiver mais de 5 dígitos
            if (cep.length > 5) {
                this.value = cep.slice(0, 5) + '-' + cep.slice(5);
            } else {
                this.value = cep;
            }

            // Verifica se o CEP tem 8 dígitos para iniciar a busca
            if (cep.length < 8) {
                document.getElementById('estado').value = "";
                document.getElementById('cidade').value = "";
                document.getElementById('bairro').value = "";
            }

            else if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!("erro" in data)) {
                            // Preenche os campos com os dados da consulta
                            document.getElementById('estado').value = data.uf;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('bairro').value = data.bairro;

                            // Esconde o aviso de CEP inválido
                            document.getElementById('textoOculto').style.display = 'none';
                        } 
                        
                        else {
                            // Mostra o aviso de CEP inválido
                            document.getElementById('textoOculto').style.display = 'flex';
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao consultar o CEP:', error);
                    });
            }
        });

        // Impede que o usuário entregue o formulário de cadastro se o CEP estiver incorreto
        document.querySelector('form').addEventListener('submit', function(event) {
            const estado = document.getElementById('estado').value.trim();
            
            // Verifica se o campo "estado" está vazio
            if (!estado) {
                event.preventDefault(); // Cancela o envio do formulário
                showPopup('Por favor, informe um CEP válido.'); // Mensagem de erro
            }
        });

        // Função para mostrar o pop-up de caso de exceção
        function showPopup(message) {
            const popup = document.getElementById('popup');
            const popupMessage = document.getElementById('popupMessage');
            popupMessage.textContent = message;
            popup.style.display = 'flex';
        }

        // Função para fechar o pop-up de caso de exceção
        document.getElementById('closePopup').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'none';
        });

        // Função genérica para alternar a exibição de inputs baseados em seleção "Outro"
        function toggleInput(selectElementId, inputElementId) {
            const select = document.getElementById(selectElementId);
            const input = document.getElementById(inputElementId);
            input.style.display = (select.value === 'Outro') ? 'block' : 'none';
        }

        // Carregar dados externos (marcas e modelos) de um arquivo externo
        let vehicleData = {};

        // Função para carregar os dados de marcas e modelos
        async function loadVehicleData() {
            try {
                const response = await fetch('veiculos.json');  // Arquivo JSON com as marcas e modelos
                vehicleData = await response.json();
            } catch (error) {
                console.error('Erro ao carregar dados de veículos:', error);
                alert('Falha ao carregar dados de veículos. Por favor, tente novamente mais tarde.');
            }
        }

        // Função para limpar as opções de um select
        function clearSelect(select) {
            while (select.firstChild) {
                select.removeChild(select.firstChild);
            }
        }

        // Função para popular um select com opções
        function populateSelect(select, options, defaultOptionText = 'Selecione uma opção') {
            clearSelect(select);
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.text = defaultOptionText;
            defaultOption.disabled = true;
            defaultOption.selected = true;
            select.appendChild(defaultOption);

            options.forEach(optionValue => {
                const option = document.createElement('option');
                option.value = optionValue;
                option.text = optionValue;
                select.appendChild(option);
            });

            const outroOption = document.createElement('option');
            outroOption.value = 'Outro';
            outroOption.text = 'Outro';
            select.appendChild(outroOption);
        }

        // Função chamada quando o tipo de veículo é alterado
        function onVehicleTypeChange() {
            const tipoVeiculo = document.getElementById('tipo_veiculo').value;
            const marcaDiv = document.getElementById('marca_div');
            const marcaSelect = document.getElementById('marca');
            
            // Limpar seleção anterior de marca e modelo
            populateSelect(marcaSelect, []);
            document.getElementById('modelo_div').style.display = 'none';
            populateSelect(document.getElementById('modelo'), []);
            document.getElementById('modelo_outro').style.display = 'none';

            // Exibe o campo de marca e carrega as opções conforme o tipo de veículo selecionado
            if (tipoVeiculo) {
                marcaDiv.style.display = 'block';
                const marcas = vehicleData[tipoVeiculo].marcas.map(m => m.nome);
                populateSelect(marcaSelect, marcas, 'Selecione uma marca');
            } else {
                marcaDiv.style.display = 'none';
            }
        }

        // Função chamada quando a marca é alterada
        function onMarcaChange() {
            const marca = document.getElementById('marca').value;
            const modeloDiv = document.getElementById('modelo_div');
            const modeloSelect = document.getElementById('modelo');
            const tipoVeiculo = document.getElementById('tipo_veiculo').value;

            // Limpar seleção anterior de modelo
            populateSelect(modeloSelect, []);
            modeloDiv.style.display = 'none';

            if (marca === 'Outro') {
                // Marca "Outro" selecionada
                document.getElementById('marca_outro').style.display = 'block';
                document.getElementById('marca').removeAttribute('required');
                document.getElementById('marca_outro').setAttribute('required', 'required');

                modeloDiv.style.display = 'block';
                document.getElementById('modelo').removeAttribute('required');
                document.getElementById('modelo_outro').setAttribute('required', 'required');
                document.getElementById('modelo').style.display = 'none';
                document.getElementById('modelo_outro').style.display = 'block';
            } else {
                // Marca selecionada é de uma opção existente
                document.getElementById('marca_outro').style.display = 'none';
                document.getElementById('marca').setAttribute('required', 'required');
                document.getElementById('marca_outro').removeAttribute('required');

                document.getElementById('modelo').setAttribute('required', 'required');
                document.getElementById('modelo_outro').removeAttribute('required');

                document.getElementById('modelo').style.display = 'block';
                document.getElementById('modelo_outro').style.display = 'none';

                if (marca) {
                    const modelos = vehicleData[tipoVeiculo].marcas.find(m => m.nome === marca).modelos;
                    populateSelect(modeloSelect, modelos, 'Selecione um modelo');
                    modeloDiv.style.display = 'block';
                }
            }
        }

        // Função chamada quando o modelo é alterado
        function onModeloChange() {
            const modelo = document.getElementById('modelo').value;

            if (modelo === 'Outro') {
                // Modelo "Outro" selecionado
                document.getElementById('modelo_outro').style.display = 'block';
                document.getElementById('modelo').removeAttribute('required');
                document.getElementById('modelo_outro').setAttribute('required', 'required');
            } else {
                // Modelo selecionado é de uma opção existente
                document.getElementById('modelo_outro').style.display = 'none';
                document.getElementById('modelo').setAttribute('required', 'required');
                document.getElementById('modelo_outro').removeAttribute('required');
            }
        }

        // Adicionar eventos para alternar o comportamento dos campos de marca e modelo
        document.getElementById('marca').addEventListener('change', onMarcaChange);
        document.getElementById('modelo').addEventListener('change', onModeloChange);

        // Carregar dados de marcas e modelos assim que a página carregar
        window.onload = loadVehicleData;
    </script>
</body>
</html>