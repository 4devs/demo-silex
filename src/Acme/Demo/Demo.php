<?php
namespace Acme\Demo;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;

class Demo
{
    public static function init(Application $app)
    {
        $demo = $app['controllers_factory'];

        $demo->get('/{name}/', 'Acme\Demo\Controller\DemoController::indexAction')->bind('homepage');

        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__ . '/Resources/views',
        ));
        return $demo;
    }
}
