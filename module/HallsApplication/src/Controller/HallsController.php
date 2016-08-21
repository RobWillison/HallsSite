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
use Ramsey\Uuid\Uuid;
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

    /**
     * @return UniversityService
     */
    public function getUniversitiesAction()
    {
        $list = $this->universityService->getList();

        $view = new JsonModel($list);

        return $view;
    }

    public function addHallsAction()
    {

        $request = $this->getRequest();
        $hallArray = $request->getPost()->toArray();
        
        $id = $this->hallsService->addHall($hallArray);

        $view = new JsonModel(['id' => $id]);

        return $view;
        
    }
    
    public function searchHallsAction()
    {
        $searchTerm = $this->params()->fromQuery('term');

        $result = [];

        if ($searchTerm != '') {
            $result = $this->hallsService->search($searchTerm);
        }

        $view = new JsonModel($result);

        return $view;
    }

    public function contactAction()
    {
        $request = $this->getRequest();
        $contact = $request->getPost()->toArray();

        var_dump($contact);die;
    }
}