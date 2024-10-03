<?php
$info = json_decode(file_get_contents('info.json'), true);
$marca = $info['marca'];
$modelo = $info['modelo'];
$ano = $info['ano'];
$valor = $info['valor'];
$descricao = $info['descricao'];
$troca = $info['troca'];
$pecas = $info['pecas'];
$rodas = $info['rodas'];
$telefone = $info['telefone'];
$hodometro = $info['hodometro'];
$estado = $info['estado'];
$cidade = $info['cidade'];
$bairro = $info['bairro'];
$estetica = $info['estetica'];
$mecanica = $info['mecanica'];
$quantidade_donos = $info['quantidade_donos'];
$condicao_rodas = $info['condicao_rodas'];
$tipo_rodas = $info['tipo_rodas'];
$tamanho_rodas = $info['tamanho_rodas'];
$fotos = glob('foto_*.png');
include '../../formatacaoCadastroVeiculo.php';
?>