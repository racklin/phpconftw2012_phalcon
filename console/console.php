<?php
// creates the autoloader
$loader = new \Phalcon\Loader();
$loader->registerDirs(array(__DIR__.DIRECTORY_SEPARATOR))->register();

$console = new \Phalcon\CLI\Console();

// cli default di
$di = new \Phalcon\DI\FactoryDefault\CLI();
$console->setDI($di);

$console->handle($_SERVER['argv']);

