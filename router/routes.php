<?php

use App\Services\Router;
use App\Controllers\Auth;
use App\Controllers\Authors;

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

Router::post('/authors/isinitial', Authors::class, 'isinitial', true, false);
Router::post('/authors/addinitial', Authors::class, 'addinitial', true, false);
Router::post('/authors/addinitial', Authors::class, 'addinitial', true, false);
Router::post('/authors/add-books', Authors::class, 'add_books', true, true);
Router::post('/authors/books-read', Authors::class, 'books_read', true, true);
Router::post('/authors/books-delete', Authors::class, 'books_delete', true, true);


Router::enable();

