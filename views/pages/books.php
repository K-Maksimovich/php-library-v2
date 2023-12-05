<?php
//session_start();
use App\Controllers\Authors;
use App\Services\Page;
use App\Services\App;
?>

<?php Page::part("head"); ?>
<?php Page::part("navbar"); ?>

<!--============== THIS BODY ==============-->

<div class="container">

    <h1 class="h1">Books</h1>
<!--    --><?php //echo $_SESSION['user']['user_gr']?>
    <div id="line" class="m-3"></div>

    <div class="block1 d-flex">
        <select class="form-select w-50 me-5 ms-3" aria-label="Default select">
            <option selected="" value="all">All authors</option>
<!--            <option value="1">Authors One</option>-->
<!--            <option value="2">Authors Two</option>-->
<!--            <option value="3">Authors Three</option>-->
            <?php

            $authors = "SELECT * FROM `authors`";
            $authors = mysqli_query(App::$connect, $authors);
            $authors = mysqli_fetch_all($authors);
            foreach ($authors as $author) {
              ?>
                <option value="<?= $author[1]?>"><?= $author[2]?></option>
                <?php
            }

            ?>
        </select>
        <form class="d-flex me-2">
            <input class="form-control me-2 w-75" type="search" placeholder="Search by name..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <div id="line" class="m-3 mt-4"></div>

<!--    --><?php //Authors::books_edit();?>

    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Author</th>
                <th scope="col">Available</th>
                <?php
                $id = $_SESSION['user']['id'];

                    if ($_SESSION['user']['user_gr'] >= 2) {
//                        echo '<th scope="col"><a href="#" class="btn btn-success">Add new</a></th>';
                        echo '<td align="right"><button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_books">Add new</button></td>';
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $books = "SELECT * FROM `books`";
                $books = mysqli_query(App::$connect, $books);
                $books = mysqli_fetch_all($books);
                foreach ($books as $book) {
                    ?>
                    <tr>
                        <td><?= $book[3] ?></td>
                        <td><?= $book[2] ?></td>
                        <td>
                            <?php
                                if ($book[4] == 1) {
                                    echo '<span class="badge bg-success">Yes</span>';
                                } else {
                                    echo '<span class="badge bg-danger">No</span>';
                                }
                          ?>
                        </td>
                        <?php

                        ?>
                        <td align="right">
                            <form action="authors/books-read" method="get">
                                <button type="submit" class="btn btn-outline-secondary">read</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>

    <?php

    ?>

</div>

<!-- Modal  ADD_NEW_BOOKS-->
<div class="modal fade mt-5" id="add_books" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new books</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="authors/add-books" class="m-auto" enctype="multipart/form-data" method="post">
                    <p class="blockquote">Your initials:  <?php Authors::isinitial(); ?></p>
                    <p class="blockquote">Name your books: <input type="text" name="name_books"></p>
                    <p class="blockquote">Html file your books: <input type="file" name="file_books"></p>
                    <p class="blockquote">Is available? <input type="checkbox" name="available" value="1"> </p>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--============== END BODY ==============-->

<?php Page::part("footer"); ?>


