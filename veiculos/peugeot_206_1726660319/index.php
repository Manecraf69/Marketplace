<?php
$info = json_decode(file_get_contents('info.json'), true);
$marca = $info['marca'];
$modelo = $info['modelo'];
$ano = $info['ano'];
$valor = $info['valor'];
$fotos = glob('foto_*.png');
include '../../formatacaoCadastroVeiculo.php';
?>