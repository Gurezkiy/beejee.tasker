<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.08.2020
 * Time: 9:52
 */

namespace Tasker;


use Exception;
use Tasker\Classes\Route;
use Tasker\Views\View;

class App
{
    private $params;
    private $uri;
    /**
     * @var Route[] $routes
     */
    private $routes;
    private $method;
    private $auth = false;

    /**
     * App constructor.
     * @param $params
     */
    public function __construct($params, $uri, $method, $routes)
    {
        $this->params = $params;
        $this->uri = $uri;
        $this->method = $method;
        $this->routes = $routes;
        $this->auth = !is_null($_SESSION['user']);
    }

    /**
     * Run method
     */
    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($uri, '/'));
        $controllerName = null;
        $action = null;
        $methodParams = [];
        $segmentsCount = count($segments);
        if ($segments == 0)
        {
            $view = new View('index');
            return $view;
        }
        $regex = '/(\{[\w|\d]+\})/';
        foreach ($this->routes as $route)
        {
            if($route->auth && !$this->auth)
            {
                continue;
            }
            if($route->method != $this->method)
            {
                continue;
            }
            $routeSegments = explode('/', trim($route->url, '/'));
            $routeSegmentsCount = count($routeSegments);
            if ($routeSegmentsCount != $segmentsCount)
            {
                continue;
            }
            $valid = true;
            $params = [];
            for ($i = 0; $i < $segmentsCount; $i++)
            {
                if (preg_match($regex, $routeSegments[$i]))
                {
                    $params[] = $segments[$i];
                    continue;
                }
                else {
                    if ($segments[$i] != $routeSegments[$i])
                    {
                        $valid = false;
                    }
                }
            }
            if ($valid)
            {
                $listAction = explode('@', $route->action);
                $controllerName = "Tasker\\Controllers\\" . $listAction[0];
                $action = $listAction[1];
                $methodParams = $params;
                break;
            }
        }
        if (is_null($action)
            || is_null($controllerName)
            || !class_exists($controllerName)
        )
        {
            throw new Exception('Not Found', 404);
        }
        $controller = new $controllerName($this->params);
        if(!method_exists($controller, $action))
        {
            throw new Exception('Not Found', 500);
        }
        return call_user_func_array([$controller, $action], $methodParams) ;
    }
}