<?php

use App\Services\Router;
use App\Controllers\Auth;

Router::page('/', 'home');
Router::page('/books', 'books');
Router::page('/authors', 'authors');
Router::page('/clients', 'clients');
Router::page('/issuance', 'issuance');
Router::page('/login', 'login');
Router::page('/register', 'register');
Router::page('/profile', 'profile');

Router::post('/auth/register', Auth::class, 'register', true, false);
Router::post('/auth/login', Auth::class, 'login', true, false);
Router::post('/auth/logout', Auth::class, 'logout', true, false);
Router::post('/auth/imgprofile', Auth::class, 'imgprofile', true, true);


Router::enable();

