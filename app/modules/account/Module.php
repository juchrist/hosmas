<?php

namespace Hms\Modules\Account;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Config;


class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
    
        $loader->registerNamespaces([
            'Hms\Modules\Account\Controllers' => __DIR__ . '/controllers/',
            'Hms\Modules\Account\Models' => APP_PATH . '/models/',
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Setting up the view component
         */
        $di->set('view', function () {
            
            $view = new View();
            $view->setViewsDir(__DIR__ . '/views/');
            $view->setLayoutsDir(APP_PATH . '/common/layouts/');
//            $view->setPartialsDir(APP_PATH . DIRECTORY_SEPARATOR . 'common' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR);
  //          $view->setTemplateAfter('main');
            
  //          $view->registerEngines([
//                '.volt'  => 'voltShared',
//                '.phtml' => PhpEngine::class
    //        ]);
            
            return $view;
        });
    }
}
