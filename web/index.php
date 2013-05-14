<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/9/13
 * @version 1.0.0
 */

defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

if (APPLICATION_ENV === 'development') {
    $app['debug'] = true;
}
$app['elastica.host'] = "localhost";
$app['elastica.port'] = 9200;

$app['elastica'] = function ($app) {
    return new \Elastica\Client(array(
        'host' => $app['elastica.host'],
        'port' => $app['elastica.port']
    ));
};
$app->mount('/demo', Acme\Demo\Demo::init($app));
$app->mount('/main', Acme\Main\Main::init($app));
//$app->mount('/demo', include 'blog.php');
//$app->get('/', 'Acme\Demo\Controller\DemoController::indexAction')->bind('homepage');

$app->run();