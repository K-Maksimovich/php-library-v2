<?php

namespace App\Services;

class App
{
    public static $connect;
    public static function start()
    {
        self::db();
    }

    public static function db()
    {

        $config = require_once "config/db.php";

        if ($config["enable"]){
            App::$connect = mysqli_connect(
                $config["hostname"],
                $config["username"],
                $config["password"],
                $config["database"]
            );

            if (! App::$connect){
                die("Error connection" . mysqli_connect_error());
            }
        }
    }

    public static function ifsign()
    {
        if ($_SESSION['user']){
            header('Location: /backend/library-v2/');
            exit();
        }
    }

    public static function ifsign_not()
    {
        if (!$_SESSION['user']){
            header('Location: /backend/library-v2/');
            exit();
        }
    }
}