<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.08.2020
 * Time: 10:21
 */

namespace Tasker\Views;


class View
{
    protected $params;
    protected $view;

    /**
     * View constructor.
     * @param $params
     */
    public function __construct($view, $params = [])
    {
        $this->params = $params;
        $this->view = $view;
    }

    public function render()
    {
        $view = $this->view;
        $content = "/templates/$view.template.php";
        return $content;
    }
    public function getParams()
    {
        return $this->params;
    }
}