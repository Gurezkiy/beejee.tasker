<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.08.2020
 * Time: 10:08
 */

namespace Tasker\Controllers;


use phpDocumentor\Reflection\Location;
use Tasker\Models\DB;
use Tasker\Models\Task;
use Tasker\Views\View;

class TaskController extends Controller
{
    public function store()
    {
        if(!isset($this->params['email']))
        {
            throw new \Exception('Email required');
        }
        if(!filter_var($this->params['email'], FILTER_VALIDATE_EMAIL))
        {
            throw new \Exception('Incorect email');
        }
        if(!isset($this->params['name']))
        {
            throw new \Exception('Name required');
        }
        $nameCount = strlen($this->params['name']);
        if($nameCount < 2 || $nameCount > 255)
        {
            throw new \Exception('Name length must be between 2 and 255 characters');
        }
        if(!isset($this->params['task']))
        {
            throw new \Exception('Task required');
        }
        $taskCount = strlen($this->params['task']);
        if($taskCount < 2 || $taskCount > 255)
        {
            throw new \Exception('Task length must be between 2 and 255 characters');
        }
        $task = new Task();
        $task->email = $this->params['email'];
        $task->name = $this->params['name'];
        $task->text = $this->params['task'];
        $task->save();
        header('Location: /');
    }
    public function update($id)
    {
        $id = DB::myhsc((int)$id);
        $itemList = DB::select("SELECT * FROM `tasks` WHERE `id`='$id'");
        $obj = new \stdClass();
        $obj->status = true;
        $obj->id = $id;
        $obj->data = null;
        if(count($itemList) == 0)
        {
            $obj->status = false;
            echo json_encode($obj);
            exit();
        }
        $item = $itemList[0];
        if(isset($this->params['state']))
        {
            $state = filter_var($this->params['state'], FILTER_VALIDATE_BOOLEAN);
            $item->completed = $state ? 1 : 0;
        }
        if(isset($this->params['task']))
        {
            $item->text = DB::myhsc($this->params['task']);
        }
        $sqlUpdate = "UPDATE `tasks` SET `completed`='$item->completed', `text`='$item->text' WHERE  `id`='$id'";
        DB::update($sqlUpdate);
        $obj->data = $item;
        echo json_encode($obj);
        exit();
    }
}