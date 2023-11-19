<?php
    session_start();
?>

<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand  active" href="/backend/library-v2/">Library</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBasic" aria-controls="navbarBasic" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarBasic">
            <ul class="navbar-nav me-auto mb-2 mb-xl-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/backend/library-v2/books">Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/backend/library-v2/authors">Authors</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/backend/library-v2/clients">Clients</a>
                </li>
                <li class="nav-item">
<!--                    <a class="nav-link" href="/backend/library/issuance">Issuance</a>-->
                </li>
            </ul>

            <?php


                if ($_SESSION['user']){
                    echo '<a class="btn btn-outline-secondary mx-2" href="/backend/library-v2/profile">profile</a>';
                } else{
                    echo '<a class="btn btn-outline-secondary mx-2" href="/backend/library-v2/login">Login</a>';
                    echo '<a class="btn btn-outline-secondary mx-2" href="/backend/library-v2/register">Register</a>';
                }

            ?>
<!--            <a class="btn btn-outline-secondary mx-2" href="/backend/library-v2/login">Login</a>-->
<!--            <a class="btn btn-outline-secondary mx-2" href="/backend/library-v2/register">Register</a>-->
        </div>

    </div>
</nav>