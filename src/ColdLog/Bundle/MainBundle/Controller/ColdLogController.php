<?php

namespace ColdLog\Bundle\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class ColdLogController extends Controller
{
    public function getRequest()
    {
        return $this->container->get('request');
    }

    public function getDocumentManager()
    {
        return $this->container->get('doctrine_mongodb.odm.document_manager');
    }

    public function getSerializerFactory()
    {
        return $this->container->get('serializer.factory');
    }

    public function createJsonResponse($content)
    {
        $response = new Response($content);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function getJsonRequestContent()
    {
        return json_decode($this->getRequest()->getContent());
    }
}
