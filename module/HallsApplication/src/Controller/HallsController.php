<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 7/31/16
 * Time: 2:22 PM
 */

namespace HallsApplication\Controller;

use HallsApplication\Service\HallsService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class HallsController extends AbstractActionController
{
    private $hallsService;

    public function __construct(HallsService $hallsService)
    {
        $this->hallsService = $hallsService;
    }

    public function getHallAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        
        $hallsEntity = $this->hallsService->getHall($id);

        $view = new ViewModel(['halls' => $hallsEntity]);
        $view->setTemplate('hallsProfile');

        return $view;
    }
}