<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.08.2020
 * Time: 10:46
 */

namespace Tasker\Controllers;


class Controller
{
    public $params;

    /**
     * Controller constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

}