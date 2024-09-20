<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <title>Comprar</title>
    <style>
        body {
            background-color: #474747;
            color: white;
            font-family: Arial, sans-serif;
        }

        .veiculos-container {
            text-align: center; /* Centraliza os itens inline-block */
            margin: 0 auto; /* Garante que o contêiner ocupe o espaço disponível */
        }

        .veiculo {
            display: inline-block; /* Mantém os veículos lado a lado */
            vertical-align: top; /* Garante alinhamento correto caso as alturas variem */
            margin: 5px; /* Ajusta o espaçamento entre os veículos */
            text-align: left;
            background-color: #333;
            padding: 5px;
            border-radius: 8px;
            width: 200px; /* Define a largura fixa */
        }

        .veiculo img {
            width: 200px;
            height: 200px;
            object-fit: cover; /* Garante que a imagem mantenha o formato quadrado sem distorcer */
            border-radius: 5px;
        }

        .veiculo-info {
            margin-top: 10px;
        }

        .veiculo-info .linha1 {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }

        .veiculo-info .linha2 {
            display: flex;
            justify-content: space-between;
        }

        /* Estilos para o botão de filtro */
        .filter-button {
            margin: 20px;
            padding: 10px 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Estilos para o modal (pop-up) */
        .modal {
            display: none; /* Esconde o modal por padrão */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            color: white;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #fff;
            text-decoration: none;
            cursor: pointer;
        }

        .modal form {
            display: flex;
            flex-direction: column;
        }

        .modal form input, .modal form select {
            margin-bottom: 10px;
            padding: 8px;
            border-radius: 5px;
            border: none;
            background-color: #555;
            color: white;
        }

        .modal form button {
            padding: 10px;
            background-color: #2196F3;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <!-- Botão para abrir o filtro -->
    <button class="filter-button" id="filterButton">Filtrar</button>

    <!-- Modal (pop-up) para os filtros -->
    <div id="filterModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <form action="comprar.php" method="GET">
                <label for="tipo_veiculo">Tipo de Veículo</label>
                <select name="tipo_veiculo" id="tipo_veiculo">
                    <option value="">Todos</option>
                    <option value="carro">Carro</option>
                    <option value="moto">Moto</option>
                </select>

                <label for="marca">Marca</label>
                <input type="text" name="marca" id="marca" placeholder="Ex: Chevrolet">

                <label for="modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" placeholder="Ex: Vectra">

                <label for="ano">Ano</label>
                <input type="text" name="ano" id="ano" placeholder="Ex: 1998">

                <label for="valor_min">Valor Mínimo</label>
                <input type="text" name="valor_min" id="valor_min" placeholder="Ex: 10000">

                <label for="valor_max">Valor Máximo</label>
                <input type="text" name="valor_max" id="valor_max" placeholder="Ex: 50000">

                <button type="submit">Aplicar Filtros</button>
            </form>
        </div>
    </div>

    <div class="veiculos-container">
        <?php
        // Defina os filtros desejados (exemplo: via GET ou POST)
        $filtros = [
            'tipo_veiculo' => isset($_GET['tipo_veiculo']) ? $_GET['tipo_veiculo'] : '',
            'marca' => isset($_GET['marca']) ? $_GET['marca'] : '',
            'modelo' => isset($_GET['modelo']) ? $_GET['modelo'] : '',
            'ano' => isset($_GET['ano']) ? $_GET['ano'] : '',
            'valor_min' => isset($_GET['valor_min']) ? $_GET['valor_min'] : '',
            'valor_max' => isset($_GET['valor_max']) ? $_GET['valor_max'] : ''
        ];

        // Define o diretório principal dos veículos
        $diretorio_base = 'veiculos/';

        // Busca todos os veículos dentro do diretório base
        $veiculos = array_filter(glob($diretorio_base . '*'), 'is_dir');

        // Função para verificar se o veículo corresponde aos filtros
        function correspondeAFiltros($info, $filtros) {
            if (!empty($filtros['tipo_veiculo']) && $info['tipo_veiculo'] !== $filtros['tipo_veiculo']) {
                return false;
            }
            if (!empty($filtros['marca']) && $info['marca'] !== $filtros['marca']) {
                return false;
            }
            if (!empty($filtros['modelo']) && $info['modelo'] !== $filtros['modelo']) {
                return false;
            }
            if (!empty($filtros['ano']) && $info['ano'] != $filtros['ano']) {
                return false;
            }
            if (!empty($filtros['valor_min']) && $info['valor'] < $filtros['valor_min']) {
                return false;
            }
            if (!empty($filtros['valor_max']) && $info['valor'] > $filtros['valor_max']) {
                return false;
            }
            return true;
        }

        // Itera por cada veículo
        foreach ($veiculos as $veiculo) {
            // Lê as informações do veículo a partir do arquivo info.json
            $info = json_decode(file_get_contents($veiculo . '/info.json'), true);

            // Aplica os filtros
            if (!correspondeAFiltros($info, $filtros)) {
                continue; // Ignora este veículo se não corresponder aos filtros
            }

            $modelo = $info['modelo'];
            $valor = $info['valor'];
            $ano = $info['ano'];
            $marca = $info['marca'];
            
            // Busca as fotos do veículo
            $fotos = glob($veiculo . '/foto_*.png');
            $primeira_foto = !empty($fotos) ? $fotos[0] : 'path/to/default/image.png'; // Pega a primeira imagem da lista, ou imagem padrão se não houver

            // Exibe as informações do veículo
            echo '<div class="veiculo">';
            echo '<a href="' . $veiculo . '/index.php">';
            echo '<img src="' . $primeira_foto . '" alt="' . $modelo . '">';
            echo '</a>';
            echo '<div class="veiculo-info">';
            echo '<div class="linha1"><span>R$ ' . number_format($valor, 2, ',', '.') . '</span><span>' . $modelo . '</span></div>';
            echo '<div class="linha2"><span>' . $ano . '</span><span>' . $marca . '</span></div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <script>
        // Abre o modal
        document.getElementById('filterButton').onclick = function() {
            document.getElementById('filterModal').style.display = 'flex';
        }

        // Fecha o modal
        document.getElementById('closeModal').onclick = function() {
            document.getElementById('filterModal').style.display = 'none';
        }

        // Fecha o modal clicando fora do conteúdo
        window.onclick = function(event) {
            if (event.target == document.getElementById('filterModal')) {
                document.getElementById('filterModal').style.display = 'none';
            }
        }
    </script>
</body>
</html>