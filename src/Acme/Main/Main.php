<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/10/13
 * @version 1.0.0
 */
namespace Acme\Main;

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Yaml;
use Acme\Main\Controller\DemoController;

class Main
{
    private static $configDirectories;

    private static $config;

    public static function init(Application $app)
    {
        self::$configDirectories = array(__DIR__.'/Resources/config');

        $demo = $app['controllers_factory'];
        self::loadConfig($app);

        $demo->get('/{name}/', 'DemoController::indexAction')->bind('main_homepage');

        self::registerService($app);
        return $demo;
    }

    private static function registerService(Application $app)
    {
        $app->register(new TwigServiceProvider(), array(
            'twig.path' => __DIR__ . self::$config['twig']['path'],
        ));
    }

    private static function loadConfig(Application $app)
    {
        $locator = new FileLocator(self::$configDirectories);
        self::$config = Yaml::parse($locator->locate('config.yml', null));
    }

}