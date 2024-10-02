<?php
// Definir o caminho da pasta principal
$pasta_principal = 'veiculos/';
$veiculos = [];

// Função para ler o arquivo info.json
function ler_info_json($caminho_arquivo) {
    $conteudo = file_get_contents($caminho_arquivo);
    return json_decode($conteudo, true);
}

// Percorrer a pasta principal e subpastas
foreach (new DirectoryIterator($pasta_principal) as $subpasta) {
    if ($subpasta->isDir() && !$subpasta->isDot()) {
        $caminho_info_json = $subpasta->getPathname() . '/info.json';
        if (file_exists($caminho_info_json)) {
            $dados = ler_info_json($caminho_info_json);
            if ($dados) {
                $veiculos[] = $dados; // Adicionar os dados ao array
            }
        }
    }
}

// Retornar os dados em formato JSON
header('Content-Type: application/json');
echo json_encode($veiculos);
?>