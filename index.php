<?php

session_start();

use App\Services\App;

require_once "vendor/autoload.php";
App::start();
require_once "router/routes.php";

