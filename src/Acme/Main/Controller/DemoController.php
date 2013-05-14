<?php
/**
 * @author Andrey Samusev <Andrey.Samusev@exigenservices.com>
 * @copyright andrey 5/10/13
 * @version 1.0.0
 */

namespace Acme\Main\Controller;


use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class DemoController
{
    public function indexAction(Request $request, Application $app)
    {
        return $app['twig']->render('Demo/index.html.twig', array('name' => $request->get('name','')));
    }
}