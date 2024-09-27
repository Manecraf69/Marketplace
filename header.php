<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #474747;
            color: #fff;
        }

        /* Estilo do cabeçalho */
        header {
            background-color: #1d1d1d;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            position: relative;
        }

        /* Estilo do nome do site */
        .nomeDoSite {
            font-size: 24px;
            font-weight: bold;
            flex: 1;
        }

        /* Estilo da navegação */
        nav {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        /* Estilos para telas menores que 600px */
        @media (max-width: 600px) {
            /* Texto menor para o nome do site */
            .nomeDoSite {
                font-size: 18px;
            }
            
            nav ul li {
                margin-left: 10px; /* Menor espaço entre os itens */
            }

            nav ul li a {
                font-size: 14px; /* Fonte menor para os links */
            }
        }
    </style>
</head>
<body>
    <header>
        <!-- Nome do site -->
        <div class="nomeDoSite">Marketplace</div>

        <!-- Navegação -->
        <nav>
            <ul>
                <li><a href="/marketplace/vender.php">Vender</a></li>
                <li><a href="/marketplace/comprar.php">Comprar</a></li>
            </ul>
        </nav>
    </header>