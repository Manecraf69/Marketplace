<?php
// Recebe os dados do formulário
$tipo_veiculo = $_POST['tipo_veiculo'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$ano = $_POST['ano'];
$valor = $_POST['valor'];
$descricao = $_POST['descricao'];
$troca = $_POST['troca'];

// Define o diretório base para armazenar os veículos
$diretorio_base = 'veiculos/';

// Verifica se o diretório base existe, se não, cria
if (!file_exists($diretorio_base)) {
    mkdir($diretorio_base, 0777, true);
}

// Gera um identificador único para o veículo (data e hora do cadastro ou ID único)
$id_unico = time(); // Alternativamente, pode usar uniqid() para gerar um ID único
$pasta_veiculo = $diretorio_base . strtolower(str_replace(' ', '_', $marca . '_' . $modelo . '_' . $id_unico));

// Cria a pasta específica para o veículo
if (!file_exists($pasta_veiculo)) {
    mkdir($pasta_veiculo, 0777, true);
}

// Verifica se o campo de imagens existe e é um array
if (isset($_FILES['imagem']) && is_array($_FILES['imagem']['tmp_name'])) {
    // Move as imagens enviadas para a pasta do veículo
    foreach ($_FILES['imagem']['tmp_name'] as $index => $tmpName) {
        $destino = $pasta_veiculo . '/foto_' . $index . '.png';
        if (move_uploaded_file($tmpName, $destino)) {
            echo 'Imagem ' . ($index + 1) . ' salva com sucesso em ' . $destino . '<br>';
        } else {
            echo 'Erro ao salvar imagem ' . ($index + 1) . '<br>';
        }
    }
} else {
    echo 'Nenhuma imagem recebida.<br>';
}

// Cria um arquivo com as informações do veículo
$info_veiculo = [
    'tipo_veiculo' => $tipo_veiculo,
    'marca' => $marca,
    'modelo' => $modelo,
    'ano' => $ano,
    'valor' => $valor,
    'descricao' => $descricao,
    'troca' => $troca,
];
file_put_contents($pasta_veiculo . '/info.json', json_encode($info_veiculo, JSON_UNESCAPED_UNICODE));

// Cria o index.php para o veículo, que incluirá o arquivo de formatação
$index_php_content = <<<PHP
<?php
\$info = json_decode(file_get_contents('info.json'), true);
\$marca = \$info['marca'];
\$modelo = \$info['modelo'];
\$ano = \$info['ano'];
\$valor = \$info['valor'];
\$descricao = \$info['descricao'];
\$troca = \$info['troca'];
\$fotos = glob('foto_*.png');
include '../../formatacaoCadastroVeiculo.php';
?>
PHP;

file_put_contents($pasta_veiculo . '/index.php', $index_php_content);

// Redireciona para a página "comprar.php" após o cadastro
header('Location: comprar.php');
?>