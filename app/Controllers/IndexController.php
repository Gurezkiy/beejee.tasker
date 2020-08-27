<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.08.2020
 * Time: 11:27
 */

namespace Tasker\Controllers;

use Tasker\Models\DB;
use Tasker\Models\Task;
use Tasker\Views\View;

class IndexController extends Controller
{
    public function index($page = 1)
    {
        $page = (int)$page;
        if($page < 1)
        {
            $page = 1;
        }
        $limit = TABLE_ROW_LIMIT;
        $offset = ($page - 1) * $limit;
        $order = '-id';
        $sql = "SELECT * FROM `tasks`";
        if(isset($this->params['order']))
        {
            $order = $this->params['order'];
        }
        switch ($order)
        {
            case "id":
            {
                $sql .= " ORDER BY id";
                break;
            }
            case "status":
            {
                $sql .= " ORDER BY completed";
                break;
            }
            case "-status":
            {
                $sql .= " ORDER BY completed DESC";
                break;
            }
            case "name":
            {
                $sql .= " ORDER BY name";
                break;
            }
            case "-name":
            {
                $sql .= " ORDER BY name DESC";
                break;
            }
            case "email":
            {
                $sql .= " ORDER BY email";
                break;
            }
            case "-email":
            {
                $sql .= " ORDER BY email DESC";
                break;
            }
            default:{
                $sql .= " ORDER BY id DESC";
                break;
            }
        }
        $countQuery = "SELECT count(`id`) as count FROM `tasks`";
        $count = (int)DB::select($countQuery)[0]->count;
        $sql .= " LIMIT $limit OFFSET $offset";
        $list = DB::select($sql);
        return new View("index", [
            'tasks' => $list,
            'all'=> ceil($count / $limit),
            'current' => $page,
            'order' => $order
        ]);
    }
    public function login()
    {
        if(isset($_SESSION['user']))
        {
            header('Location: /');
        }
        return new View('login');
    }
    public function auth()
    {
        if(!isset($this->params['login']))
        {
            throw new \Exception('Login required');
        }
        if(!isset($this->params['password']))
        {
            throw new \Exception('Password required');
        }
        $login = DB::myhsc($this->params['login']);
        $password = md5(DB::myhsc($this->params['password']));
        $sql = "SELECT * FROM `users` WHERE `login`='$login' AND `password`='$password'";
        $userList = DB::select($sql);
        $result = [];
        if(count($userList) == 0)
        {
            $result['error'] = "User Not Found";
        }
        else
        {
            $_SESSION['user'] = $userList[0];
            header('Location: /');
        }
        return new View('login', $result);
    }
    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }
}