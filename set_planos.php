<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$nome = filter_input(INPUT_POST, 'nome');
$preco = filter_input(INPUT_POST, 'preco');
$descricao = filter_input(INPUT_POST, 'descricao');

if($nome && $preco && $descricao){
    $planos = [];
    $anteriores = file_get_contents('planos.json');
    if($anteriores !== ''){
        $planos = json_decode($anteriores);
    }

    $plano = [
        "nome" => $nome,
        "preco" => $preco,
        "descricao" => $descricao,
    ];

    $planos[] = $plano;

    if (file_put_contents('planos.json', json_encode($planos))) {
        echo json_encode(['status' => 'ok'])
    }else{
        echo json_encode(['status' => 'Erro ao gravar o usuário'])
    }
}else{
    echo json_encode(['status' => 'Dados ausentes'])
}

?>