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
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="veiculos-container">
        <?php
        // Define o diretório principal dos veículos
        $diretorio_base = 'veiculos/';

        // Busca todos os veículos dentro do diretório base
        $veiculos = array_filter(glob($diretorio_base . '*'), 'is_dir');

        // Itera por cada veículo
        foreach ($veiculos as $veiculo) {
            // Lê as informações do veículo a partir do arquivo info.json
            $info = json_decode(file_get_contents($veiculo . '/info.json'), true);
            $modelo = $info['modelo'];
            $valor = $info['valor'];
            $ano = $info['ano'];
            $marca = $info['marca'];
            $hodometro = $info['hodometro'];
            
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
            echo '<div class="linha2"><span>' . $hodometro . '</span></div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>