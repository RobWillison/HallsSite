<?php
/**
 * Created by PhpStorm.
 * User: rob
 * Date: 7/31/16
 * Time: 2:22 PM
 */

namespace HallsApplication\Controller;

use HallsApplication\Service\HallsService;
use HallsApplication\Service\ImageService;
use HallsApplication\Service\UniversityService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class HallsController extends AbstractActionController
{
    private $hallsService;
    private $universityService;
    private $imageService;

    public function __construct(
        HallsService $hallsService,
        UniversityService $universityService,
        ImageService $imageService
    )
    {
        $this->hallsService = $hallsService;
        $this->universityService = $universityService;
        $this->imageService = $imageService;
    }

    public function getHallAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        $hallsEntities = $this->hallsService->getHall($id);

        $view = new JsonModel($hallsEntities);

        return $view;
    }

    public function getHallsAction()
    {
        $hallsEntities = $this->hallsService->getAll();

        $view = new JsonModel($hallsEntities);

        return $view;
    }

    public function postReviewAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');
        
        $request = $this->getRequest();
        $reviewArray = $request->getPost()->toArray();

        $imageNames = [];


        if (array_key_exists('uploadedImages', $reviewArray)) {
            foreach ($reviewArray['uploadedImages'] as $image) {
                $imageNames[] = $this->imageService->saveBase64Image($id, $image);
            }
            unset($reviewArray['uploadedImages']);
        }

        $this->hallsService->addReview($id, $reviewArray);

        $view = new JsonModel(['success' => true]);

        return $view;

    }
}