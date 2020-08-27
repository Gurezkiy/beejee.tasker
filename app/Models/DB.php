<?php
namespace Tasker\Models;
use Exception;
use mysqli;

class DB
{
    private static $bdHost = "";
    private static $bdLogin = "";
    private static $bdPassword = "";
    private static $bdTable = "";
    private static $bdPort = 3306;
    private static $_instance = null;

    private function __construct()
    {
        self::$bdHost = DB_HOST;
        self::$bdLogin = DB_USER;
        self::$bdPassword = DB_PASSWORD;
        self::$bdTable = DB_TABLE;
        self::$bdPort = DB_PORT;
    }
    protected function __clone()
    {

    }
    static public function getInstance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public static function resultToArray($res)
    {
        $result = [];
        while($row = $res->fetch_assoc())
        {
            $row = (object)$row;
            $result[] = $row;
        }
        $res->free();
        return $result;
    }
    public static function connect(){
        @$mysqli = new mysqli(self::$bdHost,self::$bdLogin,self::$bdPassword,self::$bdTable,self::$bdPort);
        if ($mysqli->connect_errno) {
            throw new Exception($mysqli->error, 500);
        }
        $mysqli->query("SET NAMES 'utf8'");
        return $mysqli;
    }
    public static function select($sql)
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        $conn = self::connect();
        $result = $conn->query($sql);
        $result = self::resultToArray($result);
        $conn->close();
        return $result;
    }
    public static function insert($sql)
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        $conn = self::connect();
        $conn->query($sql);
        $my_last_id = (int)$conn->insert_id;
        return $my_last_id;
    }
    public static function del($sql)
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        $conn = self::connect();
        $conn->query($sql);
        $conn->close();
        return true;
    }
    public static function update($sql)
    {
        return self::del($sql);
    }
    public static function myhsc($str)
    {
        $str = addslashes($str);
        return htmlspecialchars($str, null, "utf-8");
    }
}
