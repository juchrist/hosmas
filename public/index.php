<?php
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new Application($di);

    $application->registerModules([
        'account' => ['className' => 'Hms\Modules\Account\Module'],
        'administrator' => ['className' => 'Hms\Modules\Administrator\Module'],
        'doctor' => ['className' => 'Hms\Modules\Doctor\Module'],
        'accountant' => ['className' => 'Hms\Modules\Accountant\Module'],
        'receptionist' => ['className' => 'Hms\Modules\Receptionist\Module'],
        'laboratory' => ['className' => 'Hms\Modules\Laboratory\Module']
    ]);


    echo str_replace(["\n","\r","\t"], '', $application->handle()->getContent());

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
