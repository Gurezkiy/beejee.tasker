<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.08.2020
 * Time: 10:29
 */

use Tasker\Classes\Route;

$routes = [
    new Route('/', 'GET', 'IndexController@index'),
    new Route('/index', 'GET', 'IndexController@index'),
    new Route('/index/{page}', 'GET', 'IndexController@index'),
    new Route('/login', 'GET', 'IndexController@login'),
    new Route('/login', 'POST', 'IndexController@auth'),
    new Route('/logout', 'GET', 'IndexController@logout'),
    new Route('/tasks', 'POST', 'TaskController@store'),
    new Route('/tasks/{id}', 'POST', 'TaskController@update', true),
];