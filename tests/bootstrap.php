<?php

function includeIfExists($file)
{
    if (file_exists($file)) {
        return include($file);
    }

    return null;
}

if (!includeIfExists(__DIR__ . '/../vendor/autoload.php')) {
    die('Please run `composer install` before running unit-tests.');
}
