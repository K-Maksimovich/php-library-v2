<?php
use App\Services\Page;
use App\Services\App;
?>


<?php Page::part("head"); ?>
<?php Page::part("navbar"); ?>

<!--============== THIS BODY ==============-->

<?php
    if($_SESSION['message-g']){
        echo '<div class="alert alert-success m-2" role="alert"> ' . $_SESSION['message-g'] . ' </div>';
    }
    unset($_SESSION['message-g']);
?>


<?php
$res_books = mysqli_query( App::$connect, "SELECT COUNT(*) FROM `books`");
$res_books = mysqli_fetch_row($res_books);
$res_books = $res_books[0]; // всего записей

$res_authors = mysqli_query( App::$connect, "SELECT COUNT(*) FROM `authors`");
$res_authors = mysqli_fetch_row($res_authors);
$res_authors = $res_authors[0]; // всего записей

$res_clients = mysqli_query( App::$connect, "SELECT COUNT(*) FROM `users`");
$res_clients = mysqli_fetch_row($res_clients);
$res_clients = $res_clients[0]; // всего записей
?>


<main class="main">

    <div class="block-view">
        <div class="welcome">
            <p class="w">Welcome!</p>
            <p id="text">This is a simple site for library.</p>
        </div>
        <div id="line"></div>
        <div class="title">
            <p id="title">Read the most and become a better reader!</p>
        </div>
    </div>


    <div class="row container" id="card-list">
        <div class="col-sm" id="c1">
            <p class="one"><?= $res_authors ?> authors</p>
            <p class="two">The best authors of the world</p>
            <a href="/backend/library-v2/authors" class="btn btn-outline-secondary but" id="input-group-button-left">View all</a>
        </div>
        <div class="col-sm" id="c2">
            <p class="one"><?= $res_books ?> books</p>
            <p class="two">Classic, science and fantastic</p>
            <a href="/backend/library-v2/books" class="btn btn-outline-secondary but" id="input-group-button-left">View all</a>
        </div>
        <div class="col-sm" id="c3">
            <p class="one"><?= $res_clients ?> clients</p>
            <p class="two">People are interested in reading</p>
            <a href="/backend/library-v2/clients" class="btn btn-outline-secondary but" id="input-group-button-left">View all</a>
        </div>
    </div>

</main>

<!--============== END BODY ==============-->

<?php Page::part("footer"); ?>


