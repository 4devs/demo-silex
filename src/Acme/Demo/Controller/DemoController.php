<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/9/13
 * @version 1.0.0
 */
namespace Acme\Demo\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class DemoController
{
    public function indexAction(Request $request, Application $app)
    {
        $name = $request->get('name', false);
        $other = $request->get('dw', false);
        return $app['twig']->render('Demo/index.html.twig', array('name' => $name, 'others' => $other));
    }
}