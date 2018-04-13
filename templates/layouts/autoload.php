<?php

function __autoload($classname)
{

    $rev  = str_replace("\\", "/", $classname);
    $file = dirname(dirname(__DIR__)) . '/' . $rev . '.php';

    if (is_readable($file)) {
        require_once $file;
    }
}
