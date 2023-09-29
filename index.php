<?php

use Core\Router;

const __mvRoot__ = __DIR__;

require_once __DIR__ . '/dev.php';
require_once __DIR__ . '/vendor/autoload.php';

session_start();


(new Router())->start();




