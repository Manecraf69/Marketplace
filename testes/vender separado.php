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
            flex-direction: column;
        }

        textarea {
            width: 100%;
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
        .informacao {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            text-align: center;
            margin-top: 20px;
            margin: 15px auto -5px;
            width: fit-content;
            display: flex;
            justify-content: space-between;
            gap: 10px; /* Espaçamento entre os campos */
        }
    </style>
</head>
<body>
    <title>Vender</title>
    <?php include 'header.php'; ?>

    <form action="processa_cadastro.php" method="post" enctype="multipart/form-data">

        <!-- Linha 1 -->
        <div class="linha">
            <div class="coluna">
                <label for="tipo_venda">O que deseja vender? <span style="color: red;">*</span></label>
                <select name="tipo_venda" id="tipo_venda" required>
                    <option value="" disabled selected>Definir</option>
                    <option value="carro">Carro</option>
                    <option value="moto">Moto</option>
                    <option value="pecas">Peças</option>
                    <option value="rodas">Rodas</option>
                </select>
            </div>

            <!-- Telefone -->
            <div class="coluna">
                <label for="Telefone">Telefone: <span style="color: red;">*</span></label>
                <input type="text" name="Telefone" id="Telefone" placeholder="Ex: (00) 90000-0000" required>
            </div>
        </div>

        <!-- Linha 1: Tipo de veículo, Marca, Modelo -->
        <div class="informacao venda_veiculo" style="display: none;"> --- Dados gerais: ---</div>

        <div class="linha venda_veiculo" style="display: none;">
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

        <!-- Linha 2: Ano, Valor, Aceita troca -->
        <div class="linha venda_veiculo" style="display: none;">
            <!-- Ano -->
            <div class="coluna">
                <label for="ano">Ano: <span style="color: red;">*</span></label>
                <input type="text" name="ano" id="ano" placeholder="Ex: 2020" required>
            </div>

            <!-- Valor -->
            <div class="coluna">
                <label for="valor">Valor: <span style="color: red;">*</span></label>
                <input type="text" name="valor" id="valor" placeholder="Ex: R$25.000,00" oninput="formatarValor(this)" required>
            </div>

            <!-- Troca -->
            <div class="coluna">
                <label for="troca">Aceita troca? <span style="color: red;">*</span></label>
                <select name="troca" id="troca" required>
                    <option value="" disabled selected>Definir</option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
            </div>

            <!-- Hodômetro -->
            <div class="coluna">
                <label for="hodometro">KMs rodados: <span style="color: red;">*</span></label>
                <input type="text" name="hodometro" id="hodometro" placeholder="Ex: 150.000" required>
            </div>
        </div>

        <!-- Hodômetro -->
        <div class="linha">
            <div class="coluna venda_veiculo" style="display: none;">
                <label for="descricao">Descrição: <span style="color: red;">*</span></label>
                <textarea name="descricao" id="descricao" placeholder="Adicione uma descrição detalhada do veículo" required></textarea>
            </div>
        </div>
        <!-- Linha 5: Descrição -->
        

        <!-- Linha 6: Imagens do veículo -->
        <label for="imagem">Fotos: <span style="color: red;">*</span></label>
        <input type="file" name="imagem[]" id="imagem" accept="image/*" multiple required>

        <!-- Linha 7: Local do veículo -->
        <div class="informacao"> --- Informações de onde acontecerá a venda: ---</div>

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

        <!-- Linha 8: Condições e histórico -->
        <div class="informacao venda_veiculo" style="display: none;"> --- Opcional: ---</div>

        <div class="linha venda_veiculo" style="display: none;">
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
                <label for="quantidade_donos">Quantidade de donos:</label>
                <select name="quantidade_donos" id="quantidade_donos">
                    <option value="" disabled selected>Definir</option>
                    <option value="Desconhecido">Desconhecido</option>
                    <option value="Apenas 1 dono">Apenas 1 dono</option>
                    <option value="Teve 2 donos">Teve 2 donos</option>
                    <option value="Teve mais de 2 donos">Teve mais de 2 donos</option>
                </select>
            </div>
        </div>

        <!-- Linha 9: Rodas -->
        <div class="linha venda_veiculo" style="display: none;">
            <!-- Condição -->
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
                    <option value="ferro">Ferro / Raiada</option>
                    <option value="liga_leve">Liga leve</option>
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

        document.getElementById('Telefone').addEventListener('input', function (e) {
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

        document.addEventListener('input', function () {
            const tipoVeiculo = document.getElementById('tipo_veiculo').value;
            const marca = document.getElementById('marca').value.trim();
            const modelo = document.getElementById('modelo').value.trim();
            const ano = document.getElementById('ano').value.trim();
            const valor = document.getElementById('valor').value.trim();
            const descricao = document.getElementById('descricao').value.trim();
            const troca = document.getElementById('troca').value;
            const imagens = document.getElementById('imagem').files.length;

            // Verifica se todos os campos obrigatórios estão preenchidos
            const isFormValid = tipoVeiculo && marca && modelo && ano && valor && descricao && troca && imagens > 0;

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

        document.getElementById('tipo_venda').addEventListener('change', function() {
            const tipoVenda = this.value;
            const vendaVeiculo = document.getElementsByClassName('venda_veiculo');
            const vendaPecas = document.getElementsByClassName('venda_pecas');
            const vendaRodas = document.getElementsByClassName('venda_rodas');

            // Função auxiliar para mostrar/ocultar elementos por classe
            function alterarVisibilidade(elementos, display) {
                for (let i = 0; i < elementos.length; i++) {
                    elementos[i].style.display = display;
                }
            }

            // Verifica a seleção e exibe os campos correspondentes
            if (tipoVenda === 'carro' || tipoVenda === 'moto') {
                alterarVisibilidade(vendaVeiculo, 'flex');
                alterarVisibilidade(vendaPecas, 'none');
                alterarVisibilidade(vendaRodas, 'none');
            } else if (tipoVenda === 'pecas') {
                alterarVisibilidade(vendaVeiculo, 'none');
                alterarVisibilidade(vendaPecas, 'flex');
                alterarVisibilidade(vendaRodas, 'none');
            } else if (tipoVenda === 'rodas') {
                alterarVisibilidade(vendaVeiculo, 'none');
                alterarVisibilidade(vendaPecas, 'none');
                alterarVisibilidade(vendaRodas, 'flex');
            }
        });
    </script>
</body>
</html>