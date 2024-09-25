<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        body {
            background-color: #474747;
            color: #fff;
        }

        form {
            max-width: 600px;
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
            text-align: center;
            margin-top: 20px;
            margin: 15px auto -5px;
            width: fit-content;
        }
    </style>
</head>
<body>
    <title>Vender</title>
    <?php include 'header.php'; ?>

    <form action="processa_cadastro.php" method="post" enctype="multipart/form-data">

        <!-- Linha 1: Tipo de veículo, Marca, Modelo -->
        <div class="linha" id="informacao"> --- Dados gerais: ---</div>

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
                <input type="text" name="telefone" id="telefone" placeholder="Ex: (00) 90000-0000" required>
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

        <!-- Linha 5: Local do veículo -->
        <div class="linha" id="informacao"> --- Informações do local da venda: ---</div>

        <div class="linha">
            <!-- Estado -->
            <div class="coluna">
                <label for="estado">Estado: <span style="color: red;">*</span></label>
                <input type="text" name="estado" id="estado" placeholder="Ex: Santa Catarina" required>
            </div>

            <!-- Cidade -->
            <div class="coluna">
                <label for="cidade">Cidade: <span style="color: red;">*</span></label>
                <input type="text" name="cidade" id="cidade" placeholder="Ex: Joinville" required>
            </div>

            <!-- Bairro -->
            <div class="coluna">
                <label for="bairro">Bairro: <span style="color: red;">*</span></label>
                <input type="text" name="bairro" id="bairro" placeholder="Ex: Boa vista" required>
            </div>
        </div>

        <!-- Título para os campos opcionais -->
        <div class="linha" id="informacao"> --- Opcional: ---</div>

        <!-- Linha 6: Valor de entrada, Valor de parcelas, Opções de pagamento -->
        <div class="linha">
            <!-- Valor de entrada -->
            <div class="coluna">
                <label for="valor_entrada">Valor sugerido de entrada:</label>
                <input type="text" name="valor_entrada" id="valor_entrada" placeholder="Ex: R$5.000,00" oninput="formatarValor(this)">
            </div>

            <!-- Valor das parcelas -->
            <div class="coluna">
                <label for="valor_parcela">Valor das parcelas:</label>
                <input type="text" name="valor_parcela" id="valor_parcela" placeholder="Ex: R$500,00" oninput="formatarValor(this)">
            </div>

            <!-- Opções de pagamento -->
            <div class="coluna">
                <label for="opcoes_pagamento">Opções de pagamento:</label>
                <select name="opcoes_pagamento" id="opcoes_pagamento">
                    <option value="" disabled selected>Definir</option>
                    <option value="Somente à vista">Somente à vista</option>
                    <option value="Maquininha">Maquininha</option>
                    <option value="Financeamento">Financeamento</option>
                </select>
            </div>
        </div>

        <!-- Linha 7: xxxxxx -->
        <div class="linha">
            <!-- xxxxxx -->
            <div class="coluna">
                <label for="valor_entrada">teste:</label>
                <input type="text" name="valor_entrada" id="valor_entrada" placeholder="Ex: R$5.000,00" oninput="formatarValor(this)">
            </div>

            <!-- xxxxxx -->
            <div class="coluna">
                <label for="valor_parcela">teste:</label>
                <input type="text" name="valor_parcela" id="valor_parcela" placeholder="Ex: R$500,00" oninput="formatarValor(this)">
            </div>

            <!-- xxxxxx -->
            <div class="coluna">
                <label for="opcoes_pagamento">teste:</label>
                <select name="opcoes_pagamento" id="opcoes_pagamento">
                    <option value="" disabled selected>Definir</option>
                    <option value="Somente à vista">Somente à vista</option>
                    <option value="Maquininha">Maquininha</option>
                    <option value="Financeamento">Financeamento</option>
                </select>
            </div>
        </div>

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
                    <option value="Apenas completo">Apenas completo</option>
                    <option value="Apenas peças">Apenas peças</option>
                    <option value="Completo ou peças">Completo ou peças</option>
                </select>
            </div>

            <!-- Venda de rodas -->
            <div class="coluna">
                <label for="rodas">Venda das rodas?</label>
                <select name="rodas" id="rodas">
                    <option value="" disabled selected>Definir</option>
                    <option value="sim">Sim</option>
                    <option value="nao">Não</option>
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
                    <option value="Teve mais de 2 donos">Teve mais de 2 donos</option>
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
                    <option value="Ferro / Raiada">Ferro / Calota</option>
                    <option value="Liga leve">Liga leve</option>
                </select>
            </div>

            <!-- Tamanho -->
            <div class="coluna">
                <label for="tamanho_rodas">Tamanho do aro:</label>
                <input type="text" name="tamanho_rodas" id="tamanho_rodas" placeholder="Ex: 17''">
            </div>
        </div>

        <!-- Linha 10: Botão de cadastro -->
        <button class="confirmar-btn" id="confirmarBtn" type="submit">Cadastrar veículo para venda</button>
    </form>

    <script>
        function formatarValor(campo) {
            let valor = campo.value.replace(/\D/g, ''); // Remove tudo que não for dígito
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

        document.getElementById('ano').addEventListener('input', function (e) {
            let ano = e.target.value.replace(/\D/g, ''); // Remove tudo que não for dígito
            
            // Limita a 4 dígitos
            if (ano.length > 4) {
                ano = ano.substring(0, 4);
            }

            e.target.value = ano; // Atualiza o campo com o valor limitado a 4 dígitos
        });

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

        document.addEventListener('input', function () {
            const tipoVeiculo = document.getElementById('tipo_veiculo').value;
            const marca = document.getElementById('marca').value.trim();
            const modelo = document.getElementById('modelo').value.trim();
            const ano = document.getElementById('ano').value.trim();
            const hodometro = document.getElementById('hodometro').value.trim();
            const valor = document.getElementById('valor').value.trim();
            const telefone = document.getElementById('telefone').value; // Corrigido o ID aqui
            const imagens = document.getElementById('imagem').files.length > 0; // Corrigido para verificar se há imagens
            const descricao = document.getElementById('descricao').value.trim();

            // Verifica se todos os campos obrigatórios estão preenchidos
            const isFormValid = tipoVeiculo && marca && modelo && ano && hodometro && valor && telefone && imagens && descricao.length > 0;

            const confirmarBtn = document.getElementById('confirmarBtn');
            
            // Ativa ou desativa o botão baseado na validação
            if (isFormValid) {
                confirmarBtn.disabled = false;
                confirmarBtn.classList.add('enabled');
            } else {
                confirmarBtn.disabled = true;
                confirmarBtn.classList.remove('enabled');
            }
        });

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
    </script>
</body>
</html>