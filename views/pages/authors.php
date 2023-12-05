<?php
use App\Services\Page;
use App\Services\App;
use App\Controllers\Authors;
?>

<?php
Authors::delinitials();
Authors::books_count();
?>

<?php Page::part("head"); ?>
<?php Page::part("navbar"); ?>

<!--============== THIS BODY ==============-->

    <div class="container">
        <h1>Authors</h1>
        <div id="line" class="mt-4"></div>

<!--        <table class="table table-hover mt-5">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th scope="col">Name</th>-->
<!--                <th scope="col">Books count</th>-->
<!--                <td  align="right" scope="col"><a href="#" class="btn btn-success">Add new</a></td>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--                <td>Mark</td>-->
<!--                <td>7</td>-->
<!--                <td  align="right"><button class="btn btn-outline-success" type="button">Edit</button></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>Mark</td>-->
<!--                <td>4</td>-->
<!--                <td align="right"><button class="btn btn-outline-success" type="button">Edit</button></td>-->
<!--            </tr>-->
<!--            </tbody>-->
<!--        </table>-->

        <table class="table table-hover mt-5">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Books count</th>
            </tr>
            </thead>
            <tbody>
                <?php

                $authors = "SELECT * FROM `authors`";
                $authors = mysqli_query(App::$connect, $authors);
                $authors = mysqli_fetch_all($authors);
                foreach ($authors as $author) {
                ?>
                <tr>
                    <td><?= $author[2] ?></td>
                    <td><?= $author[3] ?></td>
                    <?php
                    if ($_SESSION['user']['user_gr'] >= 3){
                        echo '<td align="right"><button class="btn btn-outline-success" type="button">Edit</button></td>';
                    }
                    ?>
                </tr>
            <?php
                }
                ?>
            </tbody>
        </table>
    </div>

<!--============== END BODY ==============-->

<?php Page::part("footer"); ?>

