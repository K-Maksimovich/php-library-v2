<?php
//session_start();
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
            <option selected="">All authors</option>
            <option value="1">Authors One</option>
            <option value="2">Authors Two</option>
            <option value="3">Authors Three</option>
        </select>
        <form class="d-flex me-2">
            <input class="form-control me-2 w-75" type="search" placeholder="Search by name..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <div id="line" class="m-3 mt-4"></div>

    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Author</th>
                <th scope="col">Available</th>
                <?php
                    if ($_SESSION['user']['user_gr'] > 1){
                        echo '<th scope="col"><a href="#" class="btn btn-success">Add new</a></th>';
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
                        <td><?= $book[2] ?></td>
                        <td><?= $book[1] ?></td>
                        <td><?= $book[3] ?></td>
                        <?php
                            if ($_SESSION['user']['user_gr'] > 1){
                                echo '<td>
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
                        </td>';
                            }
                        ?>
                    </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit book</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <p>Author</p>
                    <select class="form-select me-5 mb-4" aria-label="Default select">
                        <option selected="">All authors</option>
                        <option value="1">Authors One</option>
                        <option value="2">Authors Two</option>
                        <option value="3">Authors Three</option>
                    </select>
                    <p class="mt-2">Name</p>
                    <input class="form-control me-2" type="search" placeholder="Name books" aria-label="Search">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">delete</button>
                <button type="button" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>

<!--============== END BODY ==============-->

<?php Page::part("footer"); ?>


