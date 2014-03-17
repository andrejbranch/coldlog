<?php

namespace ColdLog\Bundle\MainBundle\Controller\Division;

use ColdLog\Bundle\MainBundle\Controller\ColdLogController;
use Symfony\Component\HttpFoundation\Response;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;

class DivisionController extends ColdLogController
{
    public function getDivisionsAction($divisionId)
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    public function createDivisionsAction()
    {
        $dm = $this->getDocumentManager();

        $data = $this->getJsonRequestContent();;

        $freezer = $this->getDocumentManager()->getRepository('MainBundle:Freezer')->find($data->freezerId);

        $divisions = array();
        for ($i = 1; $i <= $data->quantity; $i++) {
            $division = new Division();
            $division->setName($data->name.' '.$i);
            $division->setFreezer($freezer);

            $divisions[] = $division;

            $dm->persist($division);
        }

        $freezer->addDivisions($divisions);

        $dm->flush();

        return $this->createJsonResponse(json_encode(array('success' => true)));
    }
}
