<?php
session_start();

use App\Services\Page;
use App\Services\App;
use App\Controllers\Auth;
use App\Controllers\Authors;

App::ifsign_not();
//Auth::is_avatar();

Authors::if_author();
//Authors::isinitial();


?>

<?php Page::part("head"); ?>
<?php Page::part("navbar"); ?>

<style>
    *{
        /*border: 1px solid black;*/
    }


</style>

<!--============== THIS BODY ==============-->

<div class="container">

    <?php
    if($_SESSION['message-g']){
        echo '<div class="alert alert-success m-2" role="alert"> ' . $_SESSION['message-g'] . ' </div>';
    }
    unset($_SESSION['message-g']);

    if ($_SESSION['message-d']){
        echo '<div class="alert alert-danger m-2" role="alert"> ' . $_SESSION['message-d'] . ' </div>';
    }
    unset($_SESSION['message-d']);
    ?>

    <div class="image_block d-flex">
        <div class="img me-5 ms-5"><img src="<?php Auth::is_avatar() ?>" alt=""> </div>
        <button type="button" class="btn btn-outline-secondary h-25 mt-5 ms-5 p-2" data-bs-toggle="modal" data-bs-target="#add_img">Change photo profile</button>
    </div>

    <div class="info">
        <div class="info_user w-50">
<!--            <p>My id: --><?php //= $_SESSION['user']['id'] ?><!--</p>-->
            <p class="blockquote border-bottom border-2">My name: <?= $_SESSION['user']['full_name'] ?></p>
            <p class="blockquote border-bottom border-2">My email: <?= $_SESSION['user']['email'] ?></p>
            <p class="blockquote border-bottom border-2">My password: secret</p>
            <p class="blockquote border-bottom border-2">My avatar: <?php Auth::is_avatar() ?> </p>
            <p class="blockquote border-bottom border-2">Group = <?php Auth::who_user(); ?></p>
        </div>

<!--        <div class="card w-75">-->
<!--            <div class="card-body">-->
<!--                <h5 class="card-title">My name: </h5>-->
<!--                <p class="card-text">--><?php //= $_SESSION['user']['full_name'] ?><!--</p>-->
<!--            </div>-->
<!--        </div>-->

        <?php Authors::initial(); ?>

    </div>

    <div id="line" class="my-5"></div>

    <div class="list-books row">
        <?php
            $id_users = $_SESSION['user']['id'];
            $is_initial = mysqli_query(App::$connect, "SELECT `initial` FROM `users` WHERE `id` = '$id_users'");
            $is_initial = mysqli_fetch_row($is_initial);
            $is_initial = $is_initial['0'];

            $books = "SELECT * FROM `books` WHERE `author_initial` = '$is_initial' ";
            if ($books = mysqli_query(App::$connect, $books)){
                $books = mysqli_fetch_all($books);

                foreach ($books as $book) {
                    ?>
                    <div class="books-block col-sm-3 px-4 py-3 mx-auto my-3 rounded border border-4">
                        <p class="name-books blockquote"><?= $book[3] ?></p>
                        <p class="is-available-books blockquote">
                            Available:
                            <?php
                            if ($book[4] == 1) {
                                echo '<span class="badge bg-success">Yes</span>';
                            } else {
                                echo '<span class="badge bg-danger">No</span>';
                            }
                            ?>
                        </p>
                        <form action="authors/books-delete" method="post">
                            <input type="hidden" name="id_book" value="<?= $book[0]?>">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>

                    <?php
                }
            } else{
                echo "Errors";
            }
//        $books = mysqli_query(App::$connect, $books);
        ?>

    </div>

    <a href="auth/logout" class="btn btn-outline-danger ms-5 my-3 px-4">Exit</a>
</div>

<?php //Authors::addinitial(); ?>




<!-- Modal AVATAR-->
<div class="modal fade" id="add_img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add images</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="auth/imgprofile" class="m-auto" enctype="multipart/form-data" method="post">
                    <p>Change photo: <input type="file" name="avatar" ></p>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal  INITIAL-->
<div class="modal fade mt-5" id="initial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Initial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="authors/addinitial" class="m-auto" method="post">
                    <p>New initial: <input type="text" name="initial" placeholder="А. Пушкин" ></p>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!--============== END BODY ==============-->

<?php Page::part("footer"); ?>

