<?php

namespace App\Controllers;

use App\Services\App;
use App\Services\Router;

class Auth
{
    public static function exReg()
    {
        header('Location: /backend/library-v2/register');
        exit();
    }
    public static function exLog()
    {
        header('Location: /backend/library-v2/login');
        exit();
    }

    public function register($data)
    {
        $full_name = $data["full_name"];
        $email = $data["email"];
        $password = $data["password"];
        $password_repeat = $data["password_repeat"];


        if (strlen($full_name) <= 5){
            $_SESSION['message-d'] = 'Please enter a valid full name';
            self::exReg();
        } elseif(strlen($email) <= 5){
            $_SESSION['message-d'] = 'Please enter a valid email';
            self::exReg();
        } elseif ($password != $password_repeat || strlen($password) <= 7){
            $_SESSION['message-d'] = 'Please enter a valid password (min. simv. 8)';
            self::exReg();
        }
        else{
            $password = md5($password);

            $add_user = "INSERT INTO `users` (`id`, `full_name`, `email`, `password`)
            VALUES (NULL, '$full_name', '$email', '$password')";
            mysqli_query(App::$connect, $add_user);

            $_SESSION['message-g'] = 'Вы успешно Зарегестрированны. Можете войти в свой аккаунт';
            header('Location: /backend/library-v2/');
            exit();
        }

    }


    public function login($data)
    {
        $email = $data["email"];
        $password = md5($data["password"]);
        $check_user = mysqli_query(App::$connect,
            "SELECT * FROM `users` WHERE `email` = '$email' AND  `password` = '$password'");
        if (mysqli_num_rows($check_user) > 0){
            $user = mysqli_fetch_assoc($check_user);

            $_SESSION['user'] = [
                "id" => $user['id'],
                "full_name" => $user['full_name'],
                "email" => $user['email'],
                "avatar" => "",
                "user_gr" => $user['group_user'] /* Значение от 1 до 3, Пользователь, Автор, Админ */
            ];


            $_SESSION['message-g'] = 'Вы успешно Вошли';
            header('Location: /backend/library-v2/');
            exit();
        } else{
            $_SESSION['message-d'] = 'Invalid email or password';
            self::exLog();
        }

    }


    public function logout()
    {
        if ($_SESSION['user']){
            unset($_SESSION['user']);
            header('Location: /backend/library-v2/');
            exit();
        } else{
            header('Location: /backend/library-v2/');
        }
    }

    public function imgprofile($data, $files)
    {
        $id = $_SESSION['user']['id'];

        echo 'This page then add profile photo';
        $avatar = $files["avatar"];

        $fileName = time() . '_' . $avatar["name"];
        $path = "uploads/avatars/" . $fileName;
        $sql_path_avatar = $path;

        if (move_uploaded_file($avatar["tmp_name"], $path)){
            mysqli_query(App::$connect, "UPDATE `users` SET `avatar` =
                '$sql_path_avatar' WHERE `users`.`id` = '$id'");
        } else{
            Router::error(500);
        }
        $check_avatar = mysqli_query(App::$connect, "SELECT * FROM `users` WHERE `avatar` = '$sql_path_avatar'");
        $avatars_path_forIMG = mysqli_query(App::$connect, "SELECT `avatar` FROM `users`");
        $avatars_path_forIMG = mysqli_fetch_all($avatars_path_forIMG);

        if (mysqli_num_rows($check_avatar) > 0){
            foreach ($avatars_path_forIMG as $avatar_path_forIMG){
                $_SESSION['user']['avatar'] = $avatar_path_forIMG;
            }
            header('Location: /backend/library-v2/profile');
            exit();
        } else{
            echo "ERROR: avatar not found";
        }

    }

    public static function is_avatar()
    {
        $id = $_SESSION['user']['id'];


        $check_avatar = mysqli_query(App::$connect, "SELECT `avatar` FROM `users` WHERE `id` = '$id'");

        $check_avatar = mysqli_fetch_row($check_avatar);

//        print_r($_SESSION['user']['avatar']);
//        echo $_SESSION['user']['avatar']['0'];
//        print_r($check_avatar);
        echo $check_avatar['0'];

    }

    public static function who_user()
    {
        $id = $_SESSION['user']['id'];
        $check_group = mysqli_query(App::$connect, "SELECT `group_user` FROM `users` WHERE `id` = '$id'");
        $check_group = mysqli_fetch_row($check_group);
//        print_r($check_group);

        echo $check_group['0'];
    }

    public static function is_user()
    {
        $id = $_SESSION['user']['id'];
        $check_group = mysqli_query(App::$connect, "SELECT `group_user` FROM `users` WHERE `id` = '$id'");
        $check_group = mysqli_fetch_row($check_group);
        $_SESSION['user']['user_gr'] = $check_group;
    }

}