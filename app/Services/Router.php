<?php

namespace App\Services;

use App\Controllers\Authors;

class Router
{
    private static array $URL_ALL = [];
    public static function page($uri, $page_name)
    {
        self::$URL_ALL[] = [
            "uri" => $uri,
            "page" => $page_name
        ];
    }

    public static function post($uri, $class, $method, $formdata = false, $files = false)
    {
        self::$URL_ALL[] = [
            "uri" => $uri,
            "class" => $class,
            "method" => $method,
            "post" => true,
            "formdata" => $formdata,
            "files" => $files
        ];
    }

    public static function enable()
    {
        $query = $_GET['q'];

        foreach (self::$URL_ALL as $route) {
            if ($route["uri"] === '/' . $query){
                if ($route["post"] === true && $_SERVER["REQUEST_METHOD"] === "POST"){
                    $action = new $route["class"];
                    $method = $route["method"];
                    if ($route["formdata"] && $route["files"]){
                        $action->$method($_POST, $_FILES);
                    }
                    elseif ($route["formdata"] && !$route["files"]){
                        $action->$method($_POST);
                    }
                    else{
                        $action->$method();
                    }
                    die();
                } elseif ($route["uri"] === '/' . 'auth/logout'){
                    $action = new $route["class"];
                    $method = $route["method"];
                    $action->$method();
                    die();
                } elseif ($route["page"]){
                    require_once "views/pages/" . $route['page'] . ".php";
                    die();
                } else{
                    Authors::books_read();
                    die();
                }
            }

        }
        self::error('404');
    }


    public static function error($error)
    {
        require_once "views/errors/" . $error . ".php";
    }


    public static function open_books()
    {

    }
}