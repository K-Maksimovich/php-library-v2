<?php
use App\Services\Page;
use App\Services\App;
?>


<?php Page::part("head"); ?>
<?php Page::part("navbar"); ?>

<!--============== THIS BODY ==============-->

    <div class="container">
        <h1>Clients</h1>
        <div id="line" class="mt-3"></div>

        <form class="d-flex me-2 mt-4 mb-5">
            <input class="form-control me-2 w-75" type="search" placeholder="Search by name..." aria-label="Search">
            <button class="btn btn-primary" type="submit">Show</button>
        </form>
        <div id="line" class="mt-4"></div>

<!--        <table class="table table-hover mt-5">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th scope="col">Name</th>-->
<!--                <th scope="col">Date born</th>-->
<!--                <th scope="col">Readed books</th>-->
<!--                <th scope="col"></th>-->
<!--                <td align="left"><a href="#" class="btn btn-success">Add new</a></td>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!--            <tr>-->
<!--                <th>Karpov Konstantin</th>-->
<!--                <td>07.11.2023</td>-->
<!--                <td>1</td>-->
<!--                <td align="right"><button class="btn btn-outline-success" type="button">Edit</button></td>-->
<!--                <td ><button class="btn btn-outline-primary" type="button">Card</button></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <th>Karpov Konstantin</th>-->
<!--                <td>07.11.2023</td>-->
<!--                <td>1</td>-->
<!--                <td align="right"><button class="btn btn-outline-success" type="button">Edit</button></td>-->
<!--                <td ><button class="btn btn-outline-primary" type="button">Card</button></td>-->
<!--            </tr>-->
<!--            </tbody>-->

            <table class="table table-hover mt-4 mx-auto">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <td align="center" class="fw-bold">Readed books</td>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $clients = "SELECT * FROM `users`";
                        $clients = mysqli_query(App::$connect, $clients);
                        $clients = mysqli_fetch_all($clients);
                        foreach ($clients as $client) {
                            ?>
                            <tr>
                                <td><?= $client[1] ?></td>
                                <td align="center"><?= $client[5] ?></td>
                                <td></td>
                            <?php
                            if ($_SESSION['user']['user_gr'] >= 3){
                                echo '<td align="right"><button class="btn btn-outline-success" type="button">Edit</button></td>';
                                echo '<td ><button class="btn btn-outline-primary" type="button">Card</button></td>';
                            }
                            ?>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </table>



    </div>

<!--============== END BODY ==============-->

<?php Page::part("footer"); ?>

