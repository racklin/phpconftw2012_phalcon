<?php
// demo inits , maybe from filesystem or databases or registry
$inits = array('RcS', 'Nfs', 'Apache');

// creates the autoloader
$loader = new \Phalcon\Loader();
$loader->registerDirs(array(__DIR__.DIRECTORY_SEPARATOR))->register();

$di = new \Phalcon\DI\FactoryDefault();

// effective java 's factory pattern
$di->set('Apache', function() {
    return new Nginx();
});

$eventsManager = $di->get('eventsManager');

foreach ($inits as $init) {
    try {
        $handle = $di->get($init);
        $eventsManager->attach('upstart', $handle);
    }catch (Exception $e) {
        // class not found
    }
}

// startup
$eventsManager->fire('upstart:filesystem', $eventsManager);
$eventsManager->fire('upstart:networking', $eventsManager);
$eventsManager->fire('upstart:networkFilesystem', $eventsManager);
$eventsManager->fire('upstart:startup', $eventsManager);
