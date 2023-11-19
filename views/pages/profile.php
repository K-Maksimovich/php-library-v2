<?php
session_start();

use App\Services\Page;
use App\Services\App;
use App\Controllers\Auth;

App::ifsign_not();
//Auth::is_avatar();


?>

<?php Page::part("head"); ?>
<?php Page::part("navbar"); ?>

<style>
    *{
        border: 1px solid black;
    }

    .img{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: rgb(203, 203, 203);
        margin: 20px;
    }
    img{
        width: 100%;
        height: 100%;
        border-radius: 50%;
    }
</style>

<!--============== THIS BODY ==============-->

<div class="container">
    <div class="image_block d-flex">
        <div class="img"><img src="<?php Auth::is_avatar() ?>" alt=""> </div>
        <button type="button" class="btn btn-outline-secondary h-25 m-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">Change photo profile</button>
    </div>

    <div class="info_user">
<!--        <p>My id: --><?php //= $_SESSION['user']['id'] ?><!--</p>-->
        <p>My name: <?= $_SESSION['user']['full_name'] ?></p>
        <p>My email: <?= $_SESSION['user']['email'] ?></p>
        <p>My password: secret</p>
        <p>My avatar: <?php Auth::is_avatar() ?> </p>
        <p>Group = <?php Auth::who_user(); ?></p>
    </div>

    <a href="auth/logout" class="btn btn-outline-danger">Exit</a>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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



<!--============== END BODY ==============-->

<?php Page::part("footer"); ?>

