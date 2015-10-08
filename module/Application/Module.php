<?php
namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\EventManager;
use SimpleThings\EntityAudit\AuditConfiguration;
use SimpleThings\EntityAudit\AuditManager;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $this->bootstrapDoctrineEntityAudit($e);
    }

    private function bootstrapDoctrineEntityAudit($e)
    {
        $auditConfig = new AuditConfiguration();
        $auditConfig->setAuditedEntityClasses(array(
            'Application\Entity\Test',
        ));

        $auditConfig->setGlobalIgnoreColumns(array(
            'created_at',
            'updated_at'
        ));

        $auditManager = new AuditManager($auditConfig);
        $e->getApplication()->getServiceManager()->setService('AuditManager', $auditManager);
        $entityManager = $e->getApplication()->getServiceManager()->get('Doctrine\ORM\EntityManager');
        $eventManager = $entityManager->getEventManager();
        $auditManager->registerEvents($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}