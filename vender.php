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

        /* Estilo do botão antes de todos os campos estarem preenchidos (desabilitado) */
        .confirmar-btn {
            margin-top: 20px;
            padding: 10px;
            background-color: #888888; /* Cor cinza desabilitado */
            color: #ffffff;
            border: none;
            cursor: not-allowed; /* Cursor indica que o botão está desabilitado */
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            display: block;
            margin-bottom: 50px;
            opacity: 0.6; /* Transparência para indicar inatividade */
        }

        /* Estilo do botão após todos os campos estarem preenchidos (habilitado) */
        .confirmar-btn.enabled {
            background-color: #11c020; /* Cor verde habilitado */
            cursor: pointer; /* Cursor padrão de clique */
            opacity: 1; /* Remove a transparência */
        }

        .confirmar-btn.enabled:hover {
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
            <!-- Linha 1: Tipo de veículo, Marca, Modelo -->
            <div class="linha" id="informacao">Dados gerais:</div>

            <div class="linha">
                <!-- Tipo de veículo -->
                <div class="coluna">
                    <label for="tipo_veiculo">Tipo de veículo: <span style="color: red;">*</span></label>
                    <select name="tipo_veiculo" id="tipo_veiculo" required>
                        <option value="" disabled selected>Definir</option>
                        <option value="carro">Carro</option>
                        <option value="moto">Moto</option>
                    </select>
                </div>

                <!-- Marca -->
                <div class="coluna">
                    <label for="marca">Marca: <span style="color: red;">*</span></label>
                    <input type="text" name="marca" id="marca" placeholder="Ex: Ford, Honda" required>
                </div>

                <!-- Modelo -->
                <div class="coluna">
                    <label for="modelo">Modelo: <span style="color: red;">*</span></label>
                    <input type="text" name="modelo" id="modelo" placeholder="Ex: Fiesta, Civic" required>
                </div>
            </div>

            <!-- Linha 2: Ano, Hodometro, Valor -->
            <div class="linha">
                <!-- Ano -->
                <div class="coluna">
                    <label for="ano">Ano: <span style="color: red;">*</span></label>
                    <input type="text" name="ano" id="ano" placeholder="Ex: 2020" required>
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
            <!-- Linha 5: Local do veículo -->
            <div class="linha">
                <span id="textoOculto" style="display: none; color: red;">CEP inválido</span>
                <span id="informacao">Informações do local da venda:</span>
            </div>

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
                        <option value="" disabled selected>Definir</option>
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
                        <option value="" disabled selected>Definir</option>
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

        // Formatar o valor do ano
        document.getElementById('ano').addEventListener('input', function (e) {
            let ano = e.target.value.replace(/\D/g, ''); // Remove tudo que não for dígito
            
            // Limita a 4 dígitos
            if (ano.length > 4) {
                ano = ano.substring(0, 4);
            }

            e.target.value = ano; // Atualiza o campo com o valor limitado a 4 dígitos
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

        // Função de validação
        function validarFormulario() {
            const tipoVeiculo = document.getElementById('tipo_veiculo').value;
            const marca = document.getElementById('marca').value.trim();
            const modelo = document.getElementById('modelo').value.trim();
            const ano = document.getElementById('ano').value.trim();
            const hodometro = document.getElementById('hodometro').value.trim();
            const valor = document.getElementById('valor').value.trim();
            const telefone = document.getElementById('telefone').value;
            const imagens = document.getElementById('imagem').files.length > 0;
            const descricao = document.getElementById('descricao').value.trim();
            const estado = document.getElementById('estado').value.trim();

            // Verifica se todos os campos obrigatórios estão preenchidos
            const isFormValid = tipoVeiculo && marca && modelo && ano && hodometro && valor && telefone && imagens && estado && descricao.length > 0;

            const confirmarBtn = document.getElementById('confirmarBtn');
            
            // Ativa ou desativa o botão baseado na validação
            if (isFormValid) {
                confirmarBtn.classList.add('enabled');
            } else {
                confirmarBtn.classList.remove('enabled');
            }
        }

        // Chama automaticamente a função ao detectar uma entrada de dados nos inputs
        document.querySelectorAll('input, textarea').forEach(element => {
            element.addEventListener('input', validarFormulario);
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
                
                // Chama a função para desativar a aparência do botão
                validarFormulario();
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
                            
                            // Chama a função para ativar a aparência do botão
                            validarFormulario();

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
    </script>
</body>
</html>