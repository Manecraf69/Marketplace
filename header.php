<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #474747;
        }

        /* Estilo do cabeçalho */
        header {
            background-color: #333;
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
    </style>
</head>
<body>
    <header>
        <!-- Nome do site -->
        <div class="nomeDoSite">Marketplace</div>

        <!-- Navegação -->
        <nav>
            <ul>
                <li><a href="/Marketplace%20Automotivo/vender.php">Vender</a></li>
                <li><a href="/Marketplace%20Automotivo/comprar.php">Comprar</a></li>
            </ul>
        </nav>
    </header>