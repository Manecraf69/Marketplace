<?php
// Recebe os dados do formulário
$tipo_veiculo = $_POST['tipo_veiculo'];
$marca = $_POST['marca'];
$marca_outro = $_POST['marca_outro'];
$modelo = $_POST['modelo'];
$modelo_outro = $_POST['modelo_outro'];
$ano = $_POST['ano'];
$valor = $_POST['valor'];
$descricao = $_POST['descricao'];
$troca = $_POST['troca'];
$pecas = $_POST['pecas'];
$rodas = $_POST['rodas'];
$telefone = $_POST['telefone'];
$hodometro = $_POST['hodometro'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$estetica = $_POST['estetica'];
$mecanica = $_POST['mecanica'];
$quantidade_donos = $_POST['quantidade_donos'];
$condicao_rodas = $_POST['condicao_rodas'];
$tipo_rodas = $_POST['tipo_rodas'];
$tamanho_rodas = $_POST['tamanho_rodas'];

// Verifica se a marca é "Outro", se sim, usa o valor de "marca_outro"
if ($marca === 'Outro') {
    $marca = $marca_outro;
}

// Verifica se o modelo é "null" ou "Outro", se sim, usa o valor de "modelo_outro"
if ($modelo === null || $modelo === 'Outro') {
    $modelo = $modelo_outro;
}

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
    'pecas' => $pecas,
    'rodas' => $rodas,
    'telefone' => $telefone,
    'hodometro' => $hodometro,
    'estado' => $estado,
    'cidade' => $cidade,
    'bairro' => $bairro,
    'estetica' => $estetica,
    'mecanica' => $mecanica,
    'quantidade_donos' => $quantidade_donos,
    'condicao_rodas' => $condicao_rodas,
    'tipo_rodas' => $tipo_rodas,
    'tamanho_rodas' => $tamanho_rodas,
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
\$pecas = \$info['pecas'];
\$rodas = \$info['rodas'];
\$telefone = \$info['telefone'];
\$hodometro = \$info['hodometro'];
\$estado = \$info['estado'];
\$cidade = \$info['cidade'];
\$bairro = \$info['bairro'];
\$estetica = \$info['estetica'];
\$mecanica = \$info['mecanica'];
\$quantidade_donos = \$info['quantidade_donos'];
\$condicao_rodas = \$info['condicao_rodas'];
\$tipo_rodas = \$info['tipo_rodas'];
\$tamanho_rodas = \$info['tamanho_rodas'];
\$fotos = glob('foto_*.png');
include '../../formatacaoCadastroVeiculo.php';
?>
PHP;

file_put_contents($pasta_veiculo . '/index.php', $index_php_content);

// Redireciona para a página "comprar.php" após o cadastro
header('Location: comprar.php');
?>