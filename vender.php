<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <style>
        body {
            background-color:#474747;
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

        .confirmar-btn {
            margin-top: 20px;
            padding: 10px;
            background-color: #11c020;
            color: #ffffff;
            border: none;
            cursor: pointer;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
            display: block;
            margin-bottom: 50px;
        }

        .confirmar-btn:hover {
            background-color: #457945;
        }
    </style>
</head>
<body>
    <title>Vender</title>
    <?php include 'header.php'; ?>

    <form action="processa_cadastro.php" method="post" enctype="multipart/form-data">

        <!-- Tipo -->
        <label for="tipo_veiculo">Tipo de veículo: <span style="color: red;">*</span></label>
        <select name="tipo_veiculo" id="tipo_veiculo" required>
            <option value="" disabled selected>Definir</option>
            <option value="carro">Carro</option>
            <option value="moto">Moto</option>
        </select>

        <!-- Marca -->
        <label for="marca">Marca: <span style="color: red;">*</span></label>
        <input type="text" name="marca" id="marca" placeholder="Ex: Ford, Honda" required>

        <!-- Modelo -->
        <label for="modelo">Modelo: <span style="color: red;">*</span></label>
        <input type="text" name="modelo" id="modelo" placeholder="Ex: Fiesta, Civic" required>

        <!-- Ano -->
        <label for="ano">Ano: <span style="color: red;">*</span></label>
        <input type="text" name="ano" id="ano" placeholder="Ex: 2020" required>

        <!-- Valor -->
        <label for="valor">Valor: <span style="color: red;">*</span></label>
        <input type="text" name="valor" id="valor" placeholder="Ex: 50000" required>

        <!-- Descrição -->
        <label for="descricao">Descrição: <span style="color: red;">*</span></label>
        <textarea name="descricao" id="descricao" placeholder="Adicione uma descrição detalhada do veículo" required></textarea>

        <!-- Aceita troca -->
        <label for="troca">Aceita troca? <span style="color: red;">*</span></label>
        <select name="troca" id="troca" required>
            <option value="" disabled selected>Definir</option>
            <option value="sim">Sim</option>
            <option value="não">Não</option>
        </select>

        <!-- Imagens -->
        <label for="imagem">Fotos do veículo: <span style="color: red;">*</span></label>
        <input type="file" name="imagem[]" id="imagem" accept="image/*" multiple required>

        <!-- Botão de cadastro -->
        <button class="confirmar-btn" type="submit">Cadastrar veículo para venda</button>
    </form>
</body>
</html>