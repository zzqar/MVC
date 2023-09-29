<?php

/**
 * Включает вывод ошибок
 */
ini_set('display_errors', '1');
error_reporting(E_ALL);

function dump(...$values): void
{
    foreach ($values as $value) {
        echo '<pre>' . print_r($value, true) . '</pre>';
    }
}
