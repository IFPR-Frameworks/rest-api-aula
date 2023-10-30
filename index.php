<?php
require 'vendor/autoload.php';

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\App;

$app = new App(['settings' => ['displayErrorDetails' => true]]);

$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write("API");
    return $response;
});

$app->get('/hello[/{name}]', function (Request $request, Response $response, array $args) {
    
    if(isset($args['name'])){
        $name = $args['name'];
    } else {
        $name = "visitante";
    }

    $response->getBody()->write("Hello, $name");

    return $response->withStatus(404);
});

$app->get('/estudantes', function(Request $req, Response $resp, $params){

    $estudantes = [
        [
            'nome' => 'Abdul',
            'nascimento' => '13-05-2006',
            'e-mail'=> 'abdul@gmail.com'
        ],
        [
            'nome' => 'Fernanda',
            'nascimento' => '03-02-2006',
            'e-mail'=> 'fer@gmail.com'
        ],
        [
            'nome' => 'Luiz',
            'nascimento' => '02-11-2002',
            'e-mail'=> 'luiz@gmail.com'
        ]
    ];

    return $resp->withJson($estudantes);

});

$app->post('/estudantes', function(Request $req, Response $resp, $params){

    $estudanteCadastrado = $req->getParsedBody();

    //print_r($estudanteCadastrado);

    //inserir no banco de dados

    $resp->withStatus('201');

    return $resp->withJson($estudanteCadastrado);
});

$app->run();