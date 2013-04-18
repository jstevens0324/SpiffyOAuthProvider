<?php
namespace SpiffyOAuthProvider;

use Zend\EventManager\Event,
    Zend\EventManager\StaticEventManager,
    Zend\Module\Consumer\AutoloaderProvider,
    Zend\Module\Manager;

class Module implements AutoloaderProvider
{
    
    public function init(Manager $moduleManager)
    {
        $events = StaticEventManager::getInstance();
        $events->attach('bootstrap', 'bootstrap', array($this, 'initProvider'), 1000);
    }
    
    public function initProvider(Event $e)
    {
        $app     = $e->getParam('application');
        $request = $app->getRequest();
        
        if ($request->query()->get('oauth_consumer')) {
            
        }
        
        require_once __DIR__ . '/vendor/OAuth.php';
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
        );
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/configs/module.config.php';
    }
}
