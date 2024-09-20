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
            max-width: 600px;
            margin: auto;
            overflow: hidden;
            border-radius: 8px;
            background-color: #333;
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
        }

        .carrossel .nav button {
            background-color: rgba(0, 0, 0, 0.5);
            border: none;
            color: white;
            padding: 10px;
            cursor: pointer;
            user-select: none; /* Previne a seleção de texto */
        }

        .info-veiculo {
            max-width: 600px;
            margin: 20px auto;
            padding: 15px;
            background-color: #333;
            border-radius: 8px;
        }

        .info-veiculo .linha {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .info-veiculo .coluna {
            flex: 1; /* Cada coluna ocupa o mesmo espaço */
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
            width: 80%;
            max-width: 700px;
        }

        .modal-content img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="carrossel">
        <div class="slides">
            <?php foreach ($fotos as $foto): ?>
                <div class="slide">
                    <img src="<?php echo htmlspecialchars($foto); ?>" alt="Imagem do veículo" onclick="openModal('<?php echo htmlspecialchars($foto); ?>')">
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

    <div class="info-veiculo">
        <div class="linha">
            <div class="coluna">
                <span><strong>Marca:</strong></span>
                <span><?php echo htmlspecialchars($marca); ?></span>
            </div>
            <div class="coluna">
                <span><strong>Modelo:</strong></span>
                <span><?php echo htmlspecialchars($modelo); ?></span>
            </div>
            <div class="coluna">
                <span><strong>Ano:</strong></span>
                <span><?php echo htmlspecialchars($ano); ?></span>
            </div>
        </div>

        <div class="linha">
            <div class="coluna">
                <span><strong>Valor</strong></span>
                <span><?php echo htmlspecialchars($valor); ?></span>
            </div>

            <div class="coluna">
                <span><strong>Aceita troca?</strong></span>
                <span><?php echo htmlspecialchars($troca); ?></span>
            </div>

            <div class="coluna">
                <span><strong>Retirada de peças?</strong></span>
                <span><?php echo htmlspecialchars($pecas); ?></span>
            </div>
        </div>

        <div class="linha">
            <span><strong>Descrição:</strong></span>
            <span><?php echo htmlspecialchars($descricao); ?></span>
        </div>
    </div>

    <script>
        let slideIndex = 0;

        function mostrarSlides() {
            const slides = document.querySelectorAll('.slide');
            const nav = document.getElementById('carouselNav');
            if (slides.length > 0) {
                for (let i = 0; i < slides.length; i++) {
                    slides[i].style.display = 'none';
                }
                slides[slideIndex].style.display = 'block';

                // Ocultar navegação se houver apenas uma imagem
                if (slides.length === 1) {
                    nav.style.display = 'none';
                } else {
                    nav.style.display = 'flex';
                }
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
    </script>
</body>
</html>
