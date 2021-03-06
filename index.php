<?php

use Silex\Application;

$loader = require_once __DIR__ . '/vendor/autoload.php';

$app = new Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// REGISRTA DoctrineServiceProvider
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'host'      => '127.0.0.1',
        'dbname'    => 'palestra',
        'user'      => 'root',
        'password'  => 'mdba2007',
        'charset'   => 'utf8mb4',
    ),
));

$carros = [
	"marcas"  => ["Fiat", "Chevrolet", "Hyundai"],
	"modelos" => ["Uno", "Agile", "I30"]
];

$app->get('/marcasv2', function() use ($carros, $app) {
	return $app['twig']->render('marcas.twig', array(
	     'marcas' => $carros['marcas'],
	));
});

//Exemplo de registro de log e utilização
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/palestra.log',
));

//Executa a consulta e manda o resultado para o template posts.twig
$app->get('/posts/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM posts WHERE id = ?";
    $post = $app['db']->fetchAssoc($sql, array((int) $id));

    $app['monolog']->addInfo(sprintf("O título do post é '%s'.", $post["title"]));//Uitlizando o log do tipo informativo
    $app['monolog']->addWarning(sprintf("O título do post é '%s'.", $post["title"]));//Utilizando log Do tipo aviso
    $app['monolog']->addError(sprintf("O título do post é '%s'.", $post["title"]));//Utilizando o log do tipo erro
    
    return $app['twig']->render('posts.twig', array(
	     'posts' => $post,
	));
});

$app->run();