<?php

spl_autoload_register(function (string $class) {
    include_once "$class.php";
});

PathfinderTester::run();