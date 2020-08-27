<?php
session_start();
if(!isset($_SESSION['user']))
{
    $_SESSION['user'] = null;
}

/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.08.2020
 * Time: 10:09
 */
require dirname(__FILE__) . '/vendor/autoload.php';
require_once "routes.php";
require_once "config.php";

use Tasker\App;


$app = new App($_REQUEST, $_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'], $routes);
try
{
    $view = $app->run();
}
catch (\Exception $exception)
{
    if($exception->getCode() === 404)
    {
        $view = new \Tasker\Views\View('404');
    }
    else
    {
        $view = new \Tasker\Views\View('error', [
            'error'=>$exception->getTraceAsString()
        ]);
    }
}
$user = $_SESSION['user'];
$params = $view->getParams();
$content = $_SERVER['DOCUMENT_ROOT'] . $view->render();
include $_SERVER['DOCUMENT_ROOT'] . "/templates/container.template.php";
exit();