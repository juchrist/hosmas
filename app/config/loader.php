<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */

$loader->registerNamespaces(
    [
        'Hms\Modules\Administrator\Controllers' => APP_PATH . '/modules/administrator/controllers/',
        'Hms\Modules\Account\Controllers' => APP_PATH . '/modules/account/controllers/',
        'Hms\Models' => APP_PATH . '/models/',
        'Hms\Modules\Receptionist\Controllers' => APP_PATH . '/modules/receptionist/controllers/',
        'Hms\Modules\Laboratory\Controllers' => APP_PATH . '/modules/laboratory/controllers/',
        'Hms\Modules\Accountant\Controllers' => APP_PATH . '/modules/accountant/controllers/',
        'Hms\Modules\Doctor\Controllers' => APP_PATH . '/modules/doctor/controllers/',
    ]
);

$loader->registerClasses(
        [
        'Hms\Modules\Administrator\Module' => APP_PATH . '/modules/administrator/Module.php',
        'Hms\Modules\Account\Module' => APP_PATH . '/modules/account/Module.php',
        'Hms\Modules\Receptionist\Module' => APP_PATH . '/modules/receptionist/Module.php',
        'Hms\Modules\Laboratory\Module' => APP_PATH . '/modules/laboratory/Module.php',
        'Hms\Modules\Accountant\Module' => APP_PATH . '/modules/accountant/Module.php',
        'Hms\Modules\Doctor\Module' => APP_PATH . '/modules/doctor/Module.php',
        ]

);
$loader->registerDirs(
    [
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->modulesDir
    ]
);
$loader->register();
