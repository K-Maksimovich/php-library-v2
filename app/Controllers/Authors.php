<?php

namespace App\Controllers;

use App\Services\App;
use App\Services\Router;

class Authors
{




    public static function if_author()
    {
        $id = $_SESSION['user']['id'];
        $check_group = mysqli_query(App::$connect, "SELECT `group_user` FROM `users` WHERE `id` = '$id'");
        $check_group = mysqli_fetch_row($check_group);
        if ($check_group['0'] >= 2){

            $_SESSION['author'] = [
                "author_id" => "",
                "initial" => "",
                "books" => "",
                "name_books" => "",
                "available" => "",
                "file_books" => ""
            ];

        }
    }

//    ----- AUTHOR INITIALS -----

    public static function isinitial()
    {
        $id = $_SESSION['user']['id'];
        $is_initial = mysqli_query(App::$connect, "SELECT `initial` FROM `users` WHERE `id` = '$id'");
        $is_initial = mysqli_fetch_row($is_initial);
        print_r($is_initial['0']);
//        $_SESSION['author']['initial'] = $is_initial['0'];
//        echo $_SESSION['author']['initial'];
//        print_r($_SESSION['author']['initial']);
    }

    public static function initial()
    {

        $id = $_SESSION['user']['id'];
        $check_group = mysqli_query(App::$connect, "SELECT `group_user` FROM `users` WHERE `id` = '$id'");
        $check_group = mysqli_fetch_row($check_group);
        if ($check_group['0'] >= 2){
            echo
            ' 
            <div class="initials mw-25 me-5 p-5">
                <p id="my_initial" class="px-4 py-3 blockquote">My initials: <span class="border-bottom border-2 py-0 px-3">';

            self::isinitial();

            echo ' </span> </p>
                <button type="button" class="btn btn-outline-secondary m-4 ms-5" data-bs-toggle="modal" data-bs-target="#initial">Change initial</button>
            </div>
            ';
        }
    }

    public static function addinitial($data)
    {
        echo 'This page for add initial';

        $id = $_SESSION['user']['id'];

        if ($data['initial'] == "") {
            $_SESSION['message-d'] = 'The field must be filled in.';
            header('Location: /backend/library-v2/profile');
            exit();
        } else {
            $add_initial = $data['initial'];
            mysqli_query(App::$connect, "UPDATE `users` SET `initial` = '$add_initial' WHERE `users`.`id` = '$id'");
            $_SESSION['author']['initial'] = $add_initial;


            $author_initial = mysqli_query(
                App::$connect,
                "SELECT `author_initial` FROM `authors` WHERE `authors`.`id` = '$id'"
            );
            $author_initial = mysqli_fetch_row($author_initial);

            if ($author_initial['0'] == "") {
                $new_initials = mysqli_query(
                    App::$connect,
                    "INSERT INTO `authors`(`id`, `user_id`, `author_initial`) VALUES ('NULL', '$id', '$add_initial')"
                );
            } else {
                $update_initial = mysqli_query(
                    App::$connect,
                    "UPDATE `authors` SET `author_initial` = '$add_initial' WHERE `authors`.`user_id` = '$id'"
                );
            }

            $_SESSION['message-g'] = 'Initials updated !';
            header('Location: /backend/library-v2/profile');
            exit();
        }
    }

    public static function delinitials()
    {
//        DELETE FROM `authors` WHERE `authors`.`id` = 3

        $id = $_SESSION['user']['id'];
        $author_initial = mysqli_query(
            App::$connect,
            "SELECT `initial` FROM `users` WHERE `users`.`id` = '$id'"
        );
        $author_initial = mysqli_fetch_row($author_initial);
//        $delete_initial = mysqli_query(
//            App::$connect,
//            "DELETE FROM `authors` WHERE `authors`.`id` = '$id'"
//        );

        if ($author_initial['0'] == "") {
            $delete_initial = mysqli_query(
            App::$connect,
            "DELETE FROM `authors` WHERE `authors`.`user_id` = '$id'"
        );
        }


    }



//     ----- AUTHOR BOOKS -----

    public static function add_books($data, $files){
        echo 'This page for add books <br>';

        $id = $_SESSION['user']['id'];
        $initials = mysqli_query(App::$connect,
            "SELECT `initial` FROM `users` WHERE `id` = '$id'");
        $initials = mysqli_fetch_row($initials);
        $inls = $initials['0'];
//        $books = $data['books'];
        $name_books = $data['name_books'];
        $available = $data['available'];
        $file_books = $files["file_books"];

        $fileBooksName =  $file_books["name"];
        $path = "uploads/books/" . $fileBooksName;
        $sql_path_books = $path;

        if (move_uploaded_file($file_books["tmp_name"], $path)) {
            mysqli_query(App::$connect,
                "INSERT INTO `books`(`id`, `author_id`, `author_initial`, `name_books`, `available`, `file`) 
                        VALUES (NULL, '$id', '$inls', '$name_books', '$available', '$sql_path_books')"
            );
            header('Location: /backend/library-v2/books');
            exit();
        } else{
            Router::error(500);
        }
//
//        echo '<pre>';
//        print_r($id); echo '<br>';
//        print_r($initials['0']); echo '<br>';
////        print_r($books);
//        print_r($name_books); echo '<br>';
//        print_r($available); echo '<br>';
//        print_r($file_books);
//        print_r($path);
//        echo '</pre>';
    }


    public static function books_count(){
        $sql = "SELECT `user_id` FROM `authors`";
        $result = mysqli_query(App::$connect, $sql);

        if ($result->num_rows > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                // Получение количества книг автора
                $authorId = $row["user_id"];
                $sql = "SELECT count(*) as bookCount FROM `books` WHERE `author_id` = '$authorId'";
                $bookResult = mysqli_query(App::$connect, $sql);
                $bookCount = mysqli_fetch_assoc($bookResult)["bookCount"];

                // Обновление столбца book_count в таблице authors
                $sql = "UPDATE `authors` SET `b_count` = '$bookCount' WHERE `user_id` = '$authorId'";
                mysqli_query(App::$connect, $sql);
            }
        }
    }

    public static function books_read(){
        // Проверяем, существует ли файл
        $fileName = "uploads/books/file.html";
//        $is_file = file_exists($filename);
//        echo $is_file;

        if ($_SESSION['user']) {
            if (file_exists($fileName)) {
                // Открываем файл в режиме чтения
                $file = fopen($fileName, "r");

                // Читаем содержимое файла и выводим его
                echo fread($file, filesize($fileName));

                // Закрываем файл

            } else {
                echo "Файл не найден";
            }
        } else{
            header('Location: /backend/library-v2/login');
        }

    }

    public static function books_delete($data)
    {
        $id_book = $data['id_book'];
        $delete_book = "DELETE FROM `books` WHERE `books`.`id` = '$id_book'";
        $delete_book = mysqli_query(App::$connect, $delete_book);
        header('Location: /backend/library-v2/profile');
        exit();
    }


}
