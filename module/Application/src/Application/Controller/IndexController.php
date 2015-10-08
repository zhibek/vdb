<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function insertAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $test = new \Application\Entity\Test();
        $test->name = 1;

        $em->persist($test);
        $em->flush();

var_dump(__METHOD__, $test);die;
    }

    public function updateAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');

        $testRepo = $em->getRepository('Application\Entity\Test');
        $test = $testRepo->find(1);
        $name = (int)$test->name;
        $name++;
        $test->name = $name;

        $em->persist($test);
        $em->flush();

var_dump(__METHOD__, $test);die;
    }

    public function auditAction()
    {
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $auditManager = $this->getServiceLocator()->get('AuditManager');
        $auditReader = $auditManager->createAuditReader($em);

        $history = $auditReader->findRevisionHistory();

var_dump(__METHOD__, $history);die;
    }

}