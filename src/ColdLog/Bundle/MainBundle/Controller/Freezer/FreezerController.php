<?php

namespace ColdLog\Bundle\MainBundle\Controller\Freezer;

use ColdLog\Bundle\MainBundle\Controller\ColdLogController;
use Symfony\Component\HttpFoundation\Response;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;

class FreezerController extends ColdLogController
{
    public function createFreezerAction()
    {
        $dm = $this->getDocumentManager();

        $data = $this->getJsonRequestContent();;

        $freezer = new Freezer();
        $freezer->setName($data->name);
        $freezer->setDescription($data->description);

        $dm->persist($freezer);
        $dm->flush();

        return $this->createJsonResponse(json_encode(array('success' => true, 'id' => $freezer->getId())));
    }

    public function getFreezerAction($id)
    {
        $freezer = $this->getDocumentManager()->getRepository('MainBundle:Freezer')->find($id);

        return $this->createJsonResponse(
            $this->container->get('serializer.freezer')->toJson($freezer)
        );
    }

    public function updateFreezerAction($id)
    {
        $data = $this->getJsonRequestContent();;

        $dm = $this->getDocumentManager();

        $freezer = $dm->getRepository('MainBundle:Freezer')->find($id);
        $freezer->setName($data->name);
        $freezer->setDescription($data->description);

        $dm->flush();

        return $this->createJsonResponse(
            $this->container->get('serializer.freezer')->toJson($freezer)
        );
    }

    public function deleteFreezerAction($id)
    {
        $dm = $this->getDocumentManager();

        $freezer = $dm->getRepository('MainBundle:Freezer')->find($id);
        $dm->remove($freezer);
        $dm->flush();

        return $this->createJsonResponse(json_encode(array('success' => true)));
    }

    public function getFreezersAction()
    {
        $freezers = $this->getDocumentManager()->getRepository('MainBundle:Freezer')->findAll();

        return $this->createJsonResponse(
            $this->getSerializerFactory()->toJson($freezers)
        );
    }

    public function getFreezerDivisionsAction($freezerId)
    {
        $divisions = $this->getDocumentManager()->getRepository('MainBundle:Freezer\Division')->findByFreezer($freezerId);

        return $this->createJsonResponse(
            $this->getSerializerFactory()->toJson($divisions)
        );
    }

    public function getFreezerBoxesAction($freezerId)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}