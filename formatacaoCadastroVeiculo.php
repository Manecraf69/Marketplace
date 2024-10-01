<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($modelo); ?></title>
    <style>
        body {
            background-color: #474747;
            color: white;
            font-family: Arial, sans-serif;
        }

        .carrossel {
            position: relative;
            max-width: 700px;
            margin: auto;
            overflow: hidden;
            border-radius: 8px;
            background-color: #333;
            margin-top: 10px;
        }

        .carrossel img {
            width: 100%;
            height: 300px; /* Tamanho fixo e retangular */
            object-fit: cover; /* Mantém o aspecto sem distorcer */
            cursor: pointer; /* Indica que a imagem é clicável */
        }

        .carrossel .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .carrossel .slide {
            min-width: 100%;
            box-sizing: border-box;
        }

        .carrossel .nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
            pointer-events: none; /* Permite que os cliques passem por esta camada */
        }

        .carrossel .nav button {
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            color: white;
            padding: 10px;
            cursor: pointer;
            user-select: none; /* Previne a seleção de texto */
            pointer-events: auto; /* Mantém os botões clicáveis */
        }

        .info-veiculo {
            max-width: 700px;
            margin: 10px auto;  /* Cima - Direita - Baixo - Esquerda */
            padding: 15px;
            background-color: #333;
            border-radius: 8px;
        }

        .info-veiculo .linha {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        /* Estilo para o pop-up da imagem */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }
        .modal-content {
            margin: 5% auto;
            display: block;
            width: 50%;
            max-width: 100%;
        }
        .modal-content img {
            width: 100%;
            height: auto;
        }

        /* Estilo para as informações adcionais */
        .linha_opcional {
            display: grid;
            justify-content: space-between;
            grid-template-columns: repeat(3, 1fr); /* 3 colunas de tamanhos iguais */
            gap: 10px; /* Espaçamento entre os campos */
            font-size: 15px;
        }
        .linha_opcional .coluna_opcional {
            flex: 1; /* Cada coluna ocupa o mesmo espaço */
        }

        /* Estilo para as informações que ficam em cima das imagens do carrossel*/
        .info-sobre-imagem {
            margin: 5px 0px 10px 10px; /* Cima - Direita - Baixo - Esquerda */
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center; /* Para alinhar os itens verticalmente */
        }
        .marca, .ano, .hodometro {
            font-size: 18px;
        }
        .modelo {
            text-decoration: underline;
            font-weight: bold;
            font-size: 25px;
        }
        .hodometro {
            margin-right: 5px;
        }
        .valor {
            font-weight: bold;
            font-size: 20px;
        }

        /* Estilo para a descrição do veículo */
        .descricao {
            text-align: justify; /* Justifica o texto */
        }

        .slide { display: none; }
        .slide.active { display: block; }

        @media (max-width: 700px) {
            .linha_opcional .coluna_opcional, .linha, .descricao{
                font-size: 12px;
            }

            .marca, .ano, .hodometro{
                font-size: 12px;
            }
            .valor {
                font-size: 14px;
            }
            .modelo {
                font-size: 18px;
            }

            .carrossel {
                max-width: 90%;
            }

            .info-veiculo {
                margin-right: 5px;
                margin-left: 5px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="carrossel">
        <div class="info-sobre-imagem">
            <div>
                <span class="marca"><?php echo htmlspecialchars($marca); ?></span>
                <span class="modelo"><?php echo htmlspecialchars($modelo); ?></span>
                <span class="ano"><?php echo htmlspecialchars($ano); ?></span>
            </div>
            <div>
                <span class="valor"><?php echo htmlspecialchars($valor); ?></span>
                <span class="hodometro"><?php echo htmlspecialchars($hodometro); ?></span>
            </div>
        </div>
        <div class="slides">
            <?php foreach ($fotos as $foto): ?>
                <div class="slide">
                    <img src="<?php echo htmlspecialchars($foto); ?>" alt="Imagem do veículo <?php echo htmlspecialchars($modelo); ?>" loading="lazy" onclick="openModal('<?php echo htmlspecialchars($foto); ?>')">
                </div>
            <?php endforeach; ?>
        </div>
        <div class="nav" id="carouselNav">
            <button onclick="moverSlide(-1)">&#10094;</button>
            <button onclick="moverSlide(1)">&#10095;</button>
        </div>
    </div>    

    <div id="myModal" class="modal">
        <img class="modal-content" id="modalImage">
    </div>

    <?php
    // Dados do veículo
    $info_veiculo = [
        'Marca' => htmlspecialchars($marca),
        'Modelo' => htmlspecialchars($modelo),
        'Ano' => htmlspecialchars($ano),
        'Valor à vista' => htmlspecialchars($valor),
        'KMs rodados' => htmlspecialchars($hodometro),
        'Telefone' => htmlspecialchars($telefone),
        'Estado' => htmlspecialchars($estado),
        'Cidade' => htmlspecialchars($cidade),
        'Bairro' => htmlspecialchars($bairro)
    ];

    // Função para exibir as colunas
    function exibirColunas($dados) {
        foreach ($dados as $titulo => $valor) {
            echo "<div class='coluna'><strong>{$titulo}:</strong><br>{$valor}</div>";
        }
    }
    ?>

    <div class="info-veiculo">
        <div class="linha">
            <?php 
            // Exibe a primeira linha de informações
            exibirColunas(array_slice($info_veiculo, 0, 5)); 
            ?>
        </div>
        <div class="linha">
            <?php 
            // Exibe a segunda linha de informações
            exibirColunas(array_slice($info_veiculo, 5)); 
            ?>
        </div>
    </div>

    <div class="info-veiculo">
        <div class="linha_opcional">
            <?php
            // Array de dados organizados em 3 colunas com até 3 itens em cada
            $itens = [
                'Aceita troca? ' => $troca,
                'Retirada de peças? ' => $pecas,
                'Venda das rodas? ' => $rodas,
                'Pintura e lataria: ' => $estetica,
                'Mecânica: ' => $mecanica,
                'Donos: ' => $quantidade_donos,
                'Pneus: ' => $condicao_rodas,
                'Tipo de rodas: ' => $tipo_rodas,
                'Tamanho das rodas: ' => $tamanho_rodas
            ];

            // Função para renderizar os itens em uma estrutura de grid
            foreach ($itens as $label => $valor) {
                if (!empty($valor)) {
                    echo '<div class="coluna_opcional">';
                    echo "<strong>" . htmlspecialchars($label) . "</strong>";
                    echo htmlspecialchars($valor) . "<br>";
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>

    <div class="info-veiculo">
        <div class="coluna descricao">
            <strong>Descrição:</strong>
            <?php echo nl2br($descricao); ?>
        </div>
    </div>

    <script>
        let slideIndex = 0;

        function mostrarSlides() {
            const slides = document.querySelectorAll('.slide');
            const nav = document.getElementById('carouselNav');
            if (slides.length > 0) {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[slideIndex].classList.add('active');
                
                // Ocultar navegação se houver apenas uma imagem
                nav.style.display = slides.length === 1 ? 'none' : 'flex';
            }
        }

        function moverSlide(n) {
            const slides = document.querySelectorAll('.slide');
            slideIndex += n;
            if (slideIndex >= slides.length) { slideIndex = 0 }
            if (slideIndex < 0) { slideIndex = slides.length - 1 }
            mostrarSlides();
        }

        function openModal(src) {
            const modal = document.getElementById('myModal');
            const modalImg = document.getElementById('modalImage');
            modal.style.display = 'block';
            modalImg.src = src;

            // Fechar o modal ao clicar na imagem
            modalImg.onclick = function() {
                modal.style.display = 'none';
            };

            // Fechar o modal ao clicar fora da imagem
            modal.onclick = function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            };
        }

        document.addEventListener('DOMContentLoaded', function() {
            mostrarSlides();
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.getElementById('myModal').style.display = 'none';
            }
        });
    </script>
</body>
</html>