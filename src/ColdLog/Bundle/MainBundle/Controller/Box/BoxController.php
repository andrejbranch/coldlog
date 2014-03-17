<?php

namespace ColdLog\Bundle\MainBundle\Controller\Box;

use ColdLog\Bundle\MainBundle\Controller\ColdLogController;
use Symfony\Component\HttpFoundation\Response;
use ColdLog\Bundle\MainBundle\Document\Freezer;
use ColdLog\Bundle\MainBundle\Document\Freezer\Division;
use ColdLog\Bundle\MainBundle\Document\Box\TenByTenBox;

class BoxController extends ColdLogController
{
    public function createBoxAction()
    {
        $dm = $this->getDocumentManager();

        $data = $this->getJsonRequestContent();;

        $division = $dm->getRepository('MainBundle:Freezer\Division')->find($data->divisionId);

        $box = new TenByTenBox();
        $box->setDivision($division);
        $box->setName($data->name);

        $division->addBoxes(array($box));

        $dm->persist($box);
        $dm->flush();

        return $this->createJsonResponse(json_encode(array('success' => true, 'id' => $box->getId())));
    }

    public function getDivisionBoxesAction($divisionId)
    {
        $boxes = $this->getDocumentManager()->getRepository('MainBundle:Box\AbstractBox')->findByDivision($divisionId);

        return $this->createJsonResponse(
            $this->getSerializerFactory()->toJson($boxes)
        );
    }
}
