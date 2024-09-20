<?php
$info = json_decode(file_get_contents('info.json'), true);
$marca = $info['marca'];
$modelo = $info['modelo'];
$ano = $info['ano'];
$valor = $info['valor'];
$descricao = $info['descricao'];
$troca = $info['troca'];
$pecas = $info['pecas'];
$fotos = glob('foto_*.png');
include '../../formatacaoCadastroVeiculo.php';
?>