<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Comprar veículos</title>

    <style>
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

        .veiculo-info .linha1 {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
        }

        .veiculo-info .linha2 {
            display: flex;
            justify-content: space-between;
        }

        .veiculo-info .linha3 {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .veiculo {
                width: 40%;
            }

            .veiculo img {
                width: 40vw;
                height: 40vw;
            }

            .veiculo-info .linha1 {
                font-size: 12px;
            }

            .veiculo-info .linha2 {
                font-size: 11px;
            }

            .veiculo-info .linha3 {
                font-size: 9px;
            }
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
            $estado = $info['estado'];
            $cidade = $info['cidade'];

            // echo '<div class="linha1"><span>' . substr($marca, 0, 11) . " " . $modelo . '</span></div>';

            // Calculando o espaço restante para o $modelo
            $limiteTotal = 22;
            $espacoRestante = $limiteTotal - strlen($marca);

            // Limitando o $modelo para que o total não ultrapasse 22 caracteres
            $modelo = substr($modelo, 0, $espacoRestante);
            
            // Busca as fotos do veículo
            $fotos = glob($veiculo . '/foto_*.png');
            $primeira_foto = !empty($fotos) ? $fotos[0] : 'path/to/default/image.png'; // Pega a primeira imagem da lista, ou imagem padrão se não houver

            // Exibe as informações do veículo
            echo '<div class="veiculo">';
            echo '<a href="' . $veiculo . '/index.php">';
            echo '<img src="' . $primeira_foto . '" alt="' . $modelo . '">';
            echo '</a>';
            echo '<div class="veiculo-info">';
            echo '<div class="linha1"><span>' . substr($marca, 0, 11) . '</span><span>' . $modelo . '</span></div>';
            echo '<div class="linha2"><span>' . $ano . '</span><span> ' . $valor . '</span></div>';
            echo '<div class="linha3"><span>' . $hodometro . ' </span><span> ' . $estado . " " . substr($cidade, 0, 11) . '</span></div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>