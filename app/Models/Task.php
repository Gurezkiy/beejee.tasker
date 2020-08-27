<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.08.2020
 * Time: 13:07
 */

namespace Tasker\Models;


class Task
{
    public $id;
    public  $email;
    public  $name;
    public  $text;
    public  $completed;

    public function save()
    {
        if(!is_null($this->id))return;
        $email = DB::myhsc($this->email);
        $name = DB::myhsc($this->name);
        $text = DB::myhsc($this->text);
        $sql = "INSERT INTO `tasks`(`email`, `name`, `text`) VALUES ('$email', '$name', '$text')";
        $this->id = DB::insert($sql,"tasks");
        return $this;
    }

}