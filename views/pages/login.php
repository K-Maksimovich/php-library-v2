<?php
session_start();

use App\Services\Page;
use App\Services\App;

App::ifsign();

?>

<?php Page::part("head"); ?>
<?php Page::part("navbar"); ?>

<!--============== THIS BODY ==============-->

<div class="container mt-5">
    <h2 class="h2">Sign in</h2>
    <form method="post" action="auth/login">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" class="form-control w-75" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control w-75" name="password" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

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
    </form>
</div>



<!--============== END BODY ==============-->

<?php Page::part("footer"); ?>

