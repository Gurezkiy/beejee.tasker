<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.08.2020
 * Time: 13:51
 */

namespace Tasker\Classes;


class Route
{
    public $url;
    public $method;
    public $action;
    public $auth;

    /**
     * Route constructor.
     * @param $url
     * @param $method
     * @param $action
     * @param $auth
     */
    public function __construct($url, $method, $action, $auth = false)
    {
        $this->url = $url;
        $this->method = $method;
        $this->action = $action;
        $this->auth = $auth;
    }
}