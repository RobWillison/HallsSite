<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace HallsApplication\Controller;

use HallsApplication\Service\HallsService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use HallsApplication\Table\HallsTable;

class PageController extends AbstractActionController
{
    private $hallsService;

    public function __construct(HallsService $hallsService)
    {
        $this->hallsService = $hallsService;
    }

    public function getHomePageAction()
    {
        $view = new ViewModel();
        $view->setTemplate('home');
        
        return $view;
    }

    public function getMapPageAction()
    {
        $view = new ViewModel();
        $view->setTemplate('map');

        return $view;
    }


    public function getHallProfilePageAction()
    {
        $view = new ViewModel();
        $view->setTemplate('hallProfile');

        return $view;
    }
    
    public function addReviewForHallAction()
    {
        $view = new ViewModel();
        $view->setTemplate('addReview');

        return $view;
    }

    public function addNewHallAction()
    {
        $view = new ViewModel();
        $view->setTemplate('addHall');

        return $view;
    }

    public function contactPageAction()
    {
        $view = new ViewModel();
        $view->setTemplate('contact');

        return $view;
    }
}
