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
    <h2 class="h2">Sign Up</h2>
    <form method="post" action="auth/register">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Full name</label>
            <input type="text" name="full_name" class="form-control w-75" id="exampleInputEmail1">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control w-75" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control w-75" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password repeat</label>
            <input type="password" name="password_repeat" class="form-control w-75" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

        <?php
            if ($_SESSION['message-d']){
                echo '<div class="alert alert-danger m-2" role="alert"> ' . $_SESSION['message-d'] . ' </div>';
            }

            unset($_SESSION['message-d']);

        ?>
    </form>
</div>


<!--============== END BODY ==============-->

<?php Page::part("footer"); ?>
